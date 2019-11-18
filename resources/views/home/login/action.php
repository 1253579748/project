<?php
//接收输入的手机验证码
$checkcode = $_POST['checkcode'];
session_start();
$code = $_SESSION['code'];
//把生成发送的验证码和用户手机收到的验证码进行比对
if ($code == $checkcode) {
    echo 'ok';
}else{
    echo 'no';
}