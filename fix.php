<?php
// koneksi
$conn=new mysqli("localhost","root","r4h4514ku","p_c45");


$yes=$no=0;
$loop=$ulang=1;
$wroot=$selanjutnya=$selanjutnya2="";
$aturan="(";
while ($loop==1)
{	
  $d=0;
  //////////////////////////// langkah 1
  //entropy total dinamis
  $jtot=$conn->query("SELECT * from data $selanjutnya")->num_rows;
  $jtotY=$conn->query("SELECT * from data where play=1 $selanjutnya2")->num_rows;
  $jtotT=$jtot-$jtotY;
  $ET=((-$jtotY/$jtot)*log(($jtotY/$jtot),2))+((-$jtotT/$jtot)*log(($jtotT/$jtot),2));
  $val=0;
  // select kolom dinamis
  $data=$conn->query("show columns from data $wroot");
  $awalfield=($conn->query("show columns from data $wroot")->num_rows)-1;
  while($row=$data->fetch_assoc())
  {
	//field pertama tidak dipakai  
	
	if ($d>0 and $d<$awalfield)
	{	
	echo "<b>".$row['Field']."</b>";
	  $f=$row['Field'];//nama field
	  $E=0; //nilai awal entropy field 
	  $Sel=$conn->query("Select distinct ($f) from data");
	  while($row2=$Sel->fetch_assoc())
	  {
		  echo "<br>select * from data where $f ='".$row2[$f]."' $selanjutnya2 </br>";
		  $jum=$conn->query("select * from data where $f ='".$row2[$f]."' $selanjutnya2")->num_rows;
		  $jumYa=$conn->query("select * from data where $f ='".$row2[$f]."' and play=1 $selanjutnya2")->num_rows;
		  $jumTdk=$jum-$jumYa;
		  echo "<br>".$row2[$f]."[ ".$jum." ] [ Ya-".$jumYa." ] [ Tdk-".($jum-$jumYa)." ] <br>";
		  if($jum==0){$en=0;}else{$en=((-$jumYa/$jum)*log(($jumYa/$jum),2))+((-$jumTdk/$jum)*log(($jumTdk/$jum),2));}
		  // root atau bukan
		  if($ulang==1)
		  {			  
		   $in=$conn->query("INSERT INTO dt_field VALUES ('','$f','".$row2[$f]."','$jum','$jumYa','$jumTdk')");
		  }
		  else
		  {
			$up=$conn->query("UPDATE dt_field SET total='$jum',yes='jumYa',no='$jumTdk' WHERE nama_field='$f' and nama_jenis='".$row2[$f]."'");
		  }
		  //akhir
		  if(is_nan($en)){$en=0;
		  }else{$en=$en;}
	      echo $en;
		  $E=$E+($jum/$jtot)*$en;
		   
	  }
	 $G[$f]=$ET-$E;
	 echo "<br> Gain ".$f." = ".$G[$f];
	 //cek terbesar menentukan akar
	 if ($G[$f]>$val){$root=$f;$val=$G[$f];}
	 //
	}
	
	$d++;
	echo "<hr>";
}
//cabang lama

// menentukan hasil dan turunan
$cabang=$conn->query("select nama_jenis as nj from dt_field where nama_field='$root' and no=0")->fetch_assoc();
$cabang2=$conn->query("select nama_jenis as nj from dt_field where nama_field='$root' and no<total and no>0")->fetch_assoc();
$adacabang=$conn->query("select nama_jenis as nj from dt_field where nama_field='$root' and no<total and no>0")->num_rows;
//berhenti looping
if($adacabang==0){$loop=0;
$aturan.=" $$root=='".$cabang['nj']."')";
}
//
else{
if($ulang==1){$selanjutnya.="WHERE $root='".$cabang2['nj']."'";}else{$selanjutnya.="and $root='".$cabang2['nj']."'";}
$selanjutnya2.="AND $root='".$cabang2['nj']."'";
$aturan.=" $$root=='".$cabang['nj']."') OR ($cabanglama $$root=='".$cabang2['nj']."' AND ";
$wroot="WHERE field <> '$root'";
$cabanglama="$$root=='".$cabang2['nj']."' AND ";
//echo $selanjutnya;
}
//$aturan.=" $$root=".$cabang['nj']." OR ($$root=".$cabang2['nj']." AND ";
$aturan1.="$$root=".$cabang2['nj'];
echo $aturan."<br>";

$ulang++;
}

//cek hasil
$f="";
// role aturan
$handlefile = fopen("role.txt", 'w') or die('Gagal akses:  role.txt');
$datae=$aturan;
fwrite($handlefile,$datae);
//create file
$my_file = 'fungsic45.php';
$data=$conn->query("show columns from data WHERE field<>'no' and field<>'play' ");
while($row=$data->fetch_assoc())
{$f.='$'.$row['Field'].",";}
$x="x";
$f.="$$x=''";
// pembuatan fungsi role dari algoritma c4.5
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = '
<?php
function c45('.$f.')
{
	if('.$aturan.')
	{
		return true;
	}
    else{return false;} 	
}
?>
';
fwrite($handle, $data);

?>
