<?php
    session_destroy();
    session_start();
    $_SESSION['connected']=0;
    
    header("Location: php/accueil.php");
?>

