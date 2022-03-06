<?php
header('Access-Control-Allow-Origin:*');
$on="sudo python3 /root/shell_i2511/on.py";
$off="sudo python3 /root/shell_i2511/off.py";
#$off="sudo /bin/sh /root/shell_i2511/realoff.sh";
if($_POST['mode']=='on'){
	shell_exec($on);
 }
if($_POST['mode']=='off'){
	 shell_exec($off);
}
if($_POST['mode']=='i2511_modify'){
	$temp=$_POST['temp'];
	$voc=$_POST['voc'];
	$co2=$_POST['co2'];
#	$for_server="sudo curl http://120.114.142.22/php/modify.php -d 'mode=i2511_modify&temp='$temp'&voc='$voc'&co2='$co2";
#	        shell_exec($for_server);
	        $myfile = fopen("/var/www/html/i2511_modify.txt", "w");
		        $txt = round($temp,2)." ";
		        fwrite($myfile, $txt);
		         $txt = round($co2,2)." ";
		        fwrite($myfile, $txt);
		        $txt = round($voc,2);
#				        echo $temp+' '+$voc+' '+$co2;
		        fwrite($myfile, $txt);
		        fclose($myfile);
}
if($_POST['mode']=='ai_temp'){
	        $ai_temp=$_POST['ai_temp'];
	        $myfile = fopen("/var/www/html/ai_temp.txt", "w");
	        $txt = round($ai_temp,2)." ";
	        fwrite($myfile, $txt);
	        fclose($myfile);
}

?>
