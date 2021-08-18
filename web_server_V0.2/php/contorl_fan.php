<?php
###i2511控制風扇專區###
$name=['i2511','i2512'];//方便多間時 使用
if($_POST['mode']=='i2511_on'){
        $on="sudo curl http://172.31.255.25/lun_forclass/contorl_fan.php -d 'mode=".$name[0]."_on'";
        shell_exec($on);
}
else if($_POST['mode']=='i2511_off'){
        $off="sudo curl http://172.31.255.25/lun_forclass/contorl_fan.php -d 'mode=".$name[0]."_off'";
        shell_exec($off);

}
###i2512控制風扇專區###
if($_POST['mode']=='i2512_on'){
        $on="sudo curl http://172.31.255.25/lun_forclass/contorl_fan.php -d 'mode=".$name[1]."_on'";
        shell_exec($on);
      
}
else if($_POST['mode']=='i2512_off'){
        $off="sudo curl http://172.31.255.25/lun_forclass/contorl_fan.php -d 'mode=".$name[1]."_off'";
        shell_exec($off);
}
###i2511控制數值專區###
if($_POST['mode']=='i2511_modify'){
        
        $temp=$_POST['temp'];
        $co2=$_POST['co2'];
        $voc=$_POST['voc'];
        $modify="sudo curl http://172.31.255.25/lun_forclass/contorl_fan.php -d 'mode=".$name[0]."_modify&temp='$temp'&co2='$co2'&voc='$voc";
        $myfile = fopen("/var/www/html/php/i2511_modify.txt", "w");
        $txt = round($temp,2)." ";
        fwrite($myfile, $txt);
        $txt = round($co2,2)." ";
        fwrite($myfile, $txt);
        $txt = round($voc,2);
        fwrite($myfile, $txt);
        fclose($myfile);
        shell_exec($modify);
        
}
###i2512控制數值專區###
else if($_POST['mode']=='i2512_modify'){
       
        $temp=$_POST['temp'];
        $co2=$_POST['co2'];
        $voc=$_POST['voc'];
        $modify="sudo curl http://172.31.255.25/lun_forclass/contorl_fan.php -d 'mode=".$name[1]."_modify&temp='$temp'&co2='$co2'&voc='$voc";
        shell_exec($modify);
        $myfile = fopen("/var/www/html/php/i2512_modify.txt", "w");
        $txt = round($temp,2)." ";
        fwrite($myfile, $txt);
        $txt = round($co2,2)." ";
        fwrite($myfile, $txt);
        $txt = round($voc,2);
        fwrite($myfile, $txt);
        fclose($myfile);
}
if($_POST['mode']=='all_modify'){
        $temp=$_POST['temp'];
        $co2=$_POST['co2'];
        $voc=$_POST['voc'];
        if($co2=='' && $voc=='' && $temp=='' ){
                echo '全空';
        }
        if($co2!='' && $voc!='' && $temp!=''){
                for ($i=0; $i < count($name) ; $i++) { 
                        $myfile = fopen("/var/www/html/php/".$name[$i]."_modify.txt", "w");
                        $txt = round($temp,2)." ";
                        fwrite($myfile, $txt);
                        $txt = round($co2,2)." ";
                        fwrite($myfile, $txt);
                        $txt = round($voc,2);
                        fwrite($myfile, $txt);
                        fclose($myfile);
                       $modify="sudo curl http://172.31.255.25/lun_forclass/contorl_fan.php -d 'mode=".$name[$i]."_modify&temp='$temp'&co2='$co2'&voc='$voc";
                       shell_exec($modify);
               }
               echo '我是all';
              }
    
        
}

if ($_POST['mode']=='ai_temp') {
        $ai_temp=$_POST['ai_temp'];
        $modify="sudo curl http://172.31.255.25/lun_forclass/contorl_fan.php -d 'mode=ai_temp&ai_temp='$ai_temp";
        shell_exec($modify);
}
?>
