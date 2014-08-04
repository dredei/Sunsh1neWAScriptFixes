<?php

$password = "qwerty"; //укажите свой пароль, для ограничения доступа

//Конец настоек

$file_name = $_GET['fname'];
$pass = $_GET['pass'];
$request_to_change = $_GET['rtc'];
$found = $_GET['found'];

if ($file_name<>'') {
if ($pass ==  $password) {
$all_txt_requests = file_get_contents($file_name);
$arr_requests = explode("\n", $all_txt_requests);
$k = 0;
for ($i = 0; $i <= count($arr_requests)-1; $i++) {
if (substr_count($arr_requests[$i],'{')>0) {
    
} else {
$arr_requests[$i] .= '{1,1}';
$k = $k+1;
}
}
if ($k>0) {
$new_str_requests = implode("\n", $arr_requests);
file_put_contents( $file_name,$new_str_requests);
echo $k.' requests changed'.'<br>';
}
if ((($request_to_change<>'') and ($found<>'')) and (($found=='0') or ($found=='1'))) {
$all_txt_requests = file_get_contents($file_name);
$arr_requests = explode("\n", $all_txt_requests);
list($left1,$right1) = explode("{",$arr_requests[$request_to_change]);
list($left2,$right2) = explode("}",$right1);
list($view,$clicks) = explode(",",$left2);
$arr_requests[$request_to_change] = $left1.'{'.($view+1).','.($clicks+$found).'}';     
$new_str_requests = implode("\n", $arr_requests);
file_put_contents( $file_name,$new_str_requests);
}
} else {
echo 'Incorrect password';
}
} else {
echo 'File name not found';
}
?>