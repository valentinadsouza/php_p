<?php
include "db.php";
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $user_id=$_SESSION["id"];
    $sql=$conn->prepare("DELETE from blogs where id=? and user_id=?");
    $sql->bind_param("ii",$id,$user_id);
    if($sql->execute()){
        header("Location:dashboard.php");
    }
}

?>