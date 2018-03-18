<?php
    
    require_once 'Mobile_Detect.php';
    $detect = new Mobile_Detect;
    if ($detect->isMobile()){
        header("location:mobile.php");
        exit;
    }else{
        header("location:pc.php");
        exit;
    }
    
    
    if($detect->isTablet()){
        header("location:mobile.php");
        exit;
    }else{
        header("location:pc.php");
        exit;
    }
    
?>
