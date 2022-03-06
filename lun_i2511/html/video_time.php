<?php
$start="sudo sh /root/shell_i2511/webhood.sh";
     $files = glob('/var/lib/motion/cam1/*.mp4' , GLOB_BRACE);
     $time=array();
     //$result=array();
     $tt=array();
     $ttt=array();
     for ($i=0; $i < count($files); $i++) {
         # code...
         $result = exec('ffmpeg -i '.$files[$i].' 2>&1 | grep Duration | cut -d " " -f 4 | sed s/,//');        
          array_push($time,$result);
#       var_dump(substr($time[$i],3,-6));
     }
    for ($i=0; $i < count($time); $i++) {
            $tt[$i]=substr($time[$i],3,-6);
            $ttt[$i]=substr($time[$i],6,-3);
                    if($tt[$i]>00||$ttt[$i]>05){
                            shell_exec($start);
                            return;
            }
     var_dump($ttt[$i]);
 }
?>
