<?php 
header("Location: main.php")
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Telefonkönyv</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">    </head>
    <body>
        <?php
        include 'db.php';
        $link=open_db();

        $eredmeny = mysqli_query($link, "SELECT id, nev, szam, cim FROM telefonkonyv");

        ?>
        <!--Ha sikeres a hozzáadás, megmutatunk egy bezárható ablakot, hogy a hozzáadás sikeres-->
        <div class="container mt-4 <?php if(!isset($_SESSION["succes"])) echo "visually-hidden"; ?> ">
		<div class="row justify-content-center">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Sikeres hozzáadás
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        </div>

        
        <div class="container justify-content-start">
        <div class="row justify-content-start">
            <h1>Telefonkönyv</h1>
        <div class="col-10">
        <table class="table table-hover table-bordered">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Név</th>
                <th scope="col">Telefon</th>      
                <th scope="col">Cím</th>      
                <th scope="col"></th>      
            </tr> 
                <tr>
                <th scope="row"> <?=$row['id']?> </th>
                <th scope="row"> <?=$row['nev']?> </th>
                <th scope="row"> <?=$row['szam']?> </th>                <!--Plusz oszlop a címnek, valamint szép gomb a törléshez-->
                <th scope="row"> <?=$row['cim']?> </th>                 
                <th scope="row"> <i class="far fa-trash-alt"></i> <a href="delete.php?id=<?=$row['id']?>"> Törlés</a></th>
                </tr> 
        </table>
        <p><a href="insert.php" >Új elem beszúrása</a></p>
        </div>
        </div>
        </div>
        
        <?php mysqli_close($link)?>
        
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>

    </body>
</html>

