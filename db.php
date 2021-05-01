<?php 


function open_db(){
    $link = mysqli_connect("localhost", "root", "") or die("connection error:" . mysqli_error($link));
    mysqli_select_db($link, "gymsite");
    mysqli_query($link, "set characterset_set_results='utf-8'");
    return $link;
}





?>