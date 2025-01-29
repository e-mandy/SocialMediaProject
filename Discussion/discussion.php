<?php
require 'discuss_functions.php';
    if(isset($_REQUEST["id"]) && !empty($_REQUEST["id"])){
    $allDiscuss = Discussion::getAll($_REQUEST["id"]);
    }
?>
