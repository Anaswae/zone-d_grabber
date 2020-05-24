<?php
//
// Coded by Zeerx7
// XploitSec ID
///
// mau record ya? izin gan :v
// zeerx7@gmail.com <> 0895320325423
//
$G  = "\e[92m";
$R  = "\e[91m";
$Y  = "\e[93m";
$B  = "\e[94m";
$P  = "\e[35m";
$C  = "\e[36m";
$end = $P."\n\n-----------$R End $P-----------\n";
$preg = [
  "archive" => "#\"><td>(.+?)<td>#",
  "special" => "#3;<td>(.+?)<td>#",
  "attacker1" => "#3;<td>(.+?)<td>#",
  "attacker2" => "#\"><td>(.+?)<td>#"
];
pausi();
echo $B."\nOption:\n$Y"."1. Grab From Archive \n2. Grab From Special \n3. Grab From attacker ID\n$G"."Pilih-> ";
$pilih = trim(fgets(STDIN));
$mirror = "https://zone-d.org/mirror";
if($pilih == 1){
  $pausi = $preg['archive'];
  $n = "archive";
}elseif($pilih == 2){
  $pausi = $preg['special'];
  $n = "special";
}elseif($pilih == 3){
  attacker();
}else{
  echo $R."Error Input !!\n\n";
  exit;
}
$q = curl("$mirror/$n");
preg_match("#<span>Page 1 of (.+?): </span>#",$q,$z);
echo "Total ".$z[1]." Page \nGrab berapa page?\n=>";
$pa = trim(fgets(STDIN));
$simpan = "result/$n.txt";
echo $C."List web akan tersimpan di $simpan\n";
$sep = fopen($simpan,"w");
$i = 1;
while ($i <= $pa){
  echo $G."\n\n-------$R Grab Page $i $G-------\n";
  $f = curl("$mirror/$n/$i");
  preg_match_all($pausi,$f,$p);
  foreach ($p[1] as $ganteng){
   $ganteng = parse($ganteng);
   echo $B.$ganteng."\n";
   fwrite($sep,$ganteng."\n");
  }
  $i=$i+1;
}
echo $end;
echo $C."Result tersimpan di $simpan\n";
fclose($sep);
//echo $f;
function curl($url){
$agent = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0";
$header = array('Content-Type: application/x-www-form-urlencoded');
$timeout = 10;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, $agent);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  curl_setopt($ch, CURLOPT_ENCODING, '');
  $_ = curl_exec($ch);
//  echo $_;
  curl_close($ch);
 return $_;
}function parse($url){
  if(!preg_match("%^http://|^https://%",$url)){
   $gans = "http://".$url;
  }
  $wow = parse_url($gans);
  $wow = $wow['host'];
  return $wow;
}function attacker(){
global $C;
global $R;
global $B;
global $G;
global $P;
global $end;
global $preg;
echo "\nMasukan ID Attacker\nEx:https://zone-d.org/attacker/id/573\n\nId=>> ";
  $idatt = trim(fgets(STDIN));
  $mirror = "https://zone-d.org/attacker/id";
  $pausi = $preg['attacker1'];
  $pausi2= $preg['attacker2'];
  $n = $idatt;
  $q = curl("$mirror/$n");
  preg_match("#<span>Page 1 of (.+?): </span>#",$q,$z);
echo "Total ".$z[1]." Page \nGrab berapa page?\n=>";
$pa = trim(fgets(STDIN));
$simpan = "result/$n.txt";
echo "List web akan tersimpan di $simpan\n";
$sep = fopen($simpan,"w");
$i = 1;
  while ($i <= $pa){
  echo $G."\n\n-------$R Grab Page $i $G-------\n";
  $f = curl("$mirror/$n/$i");
  preg_match_all($pausi,$f,$p);
  preg_match_all($pausi2,$f,$e);
  foreach ($p[1] as $ganteng){
   $ganteng = parse($ganteng);
   echo $B.$ganteng."\n";
   fwrite($sep,$ganteng."\n");
  }
  foreach ($e[1] as $ganteng){
   $ganteng = parse($ganteng);
   echo $B.$ganteng."\n";
   fwrite($sep,$ganteng."\n");
  }
  $i=$i+1;
}
echo $end;
echo $C."Result tersimpan di $simpan\n";
fclose($sep);
exit;
}function pausi(){
global $R;
global $Y;
global $G;
echo "$R
/! -- $G  Zone-D Grabber$R -- !/
--$Y Coded by Zeerx7(pausi)$R --
--  $Y     XploitSec-ID    $R --
/! -- /-/-/-/-/-/-/-/- -- !/
";
}
?>
