<?php
    session_start();
    include("./captchaText.php");
    $captchatextObj = new phptextClass();
    $captchatextObj->phpcaptcha('#162453','#ffw',120,40,10,25);

?>