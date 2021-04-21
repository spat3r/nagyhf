<?php 
include 'db.php';
if (isset($_GET['id'])) {
    $link = open_db();

    $query = "DELETE FROM telefonkonyv WHERE id=" . mysqli_real_escape_string($link, $_GET['id']);

    mysqli_query($link, $query);
    mysqli_close($link);
    
}


header("Location: index.php");
?>