<?php
//if($_POST['mode']=='ai_temp'){
    $myfile = fopen("/var/www/html/php/test.txt", "w");
    fwrite($myfile, '222');
    fclose($myfile);
//}
// $old_url = $_SERVER["REQUEST_URI"];
// $check = strpos($old_url, '?');
// if($check !== false)
// {
//     $temp=$_REQUEST['temp'];

//     $myfile = fopen("/var/www/html/php/test.txt", "w");
//     $txt = $temp;
//     fwrite($myfile, $txt);
//     fclose($myfile);
// }
// else{
//     echo "讀取中";
// }
?>
