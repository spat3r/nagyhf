<?php session_start()?>
<!DOCTYPE html>
<html>
    <head>
        <title>Telefonkönyv</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">    </head>
    <body>
        <?php
        include 'db.php';
        $link=open_db();
        
        $query = "SELECT p\.id, p\.username, p\.password, p\.weight, p\.weightgoal, p\.height, p\.gender, h\.gramms, h\.date, h\.blds_id, m\.prot, m\.carb, m\.fat  FROM profil p";
        $query .=" inner join profil_has_meal h on p\.id = h\.profil_id";
        $query .=" inner join meal m on m\.id = h\.meal_id";
        $eredmeny = mysqli_query($link, $query);

        ?>
                
        <div class="container justify-content-start">
        <div class="row justify-content-start">
            <h1>Telefonkönyv</h1>
        <div class="col-10">
        <table class="table table-hover table-bordered">
            <tr>
            <th scope="col">ID</th>
                <th scope="col">id</th>
                <th scope="col">uname</th>      
                <th scope="col">psw</th>      
                <th scope="col">w</th> 
                <th scope="col">wg</th>
                <th scope="col">h</th>
                <th scope="col">m/f</th>      
                <th scope="col">gramm</th>      
                <th scope="col">date</th> 
                <th scope="col">meal</th>
                <th scope="col">meal</th>
                <th scope="col">prot</th>      
                <th scope="col">carb</th>      
                <th scope="col">fat</th> 

            </tr> 
            <?php while ($row = mysqli_fetch_array($eredmeny)): ?>
                <tr>
                <th scope="row"> <?=$row['id']?> </th>
                <th scope="row"> <?=$row['username']?> </th>
                <th scope="row"> <?=$row['password']?> </th>
                <th scope="row"> <?=$row['weight']?> </th>
                <th scope="row"> <?=$row['weightgoal']?> </th>
                <th scope="row"> <?=$row['height']?> </th>
                <th scope="row"> <?=$row['gender']?> </th>
                <th scope="row"> <?=$row['gramms']?> </th>
                <th scope="row"> <?=$row['date']?> </th>
                <th scope="row"> <?=$row['blds_id']?> </th>
                <th scope="row"> <?=$row['prot']?> </th>
                <th scope="row"> <?=$row['carb']?> </th>
                <th scope="row"> <?=$row['fat']?> </th>

                </tr> 
            <?php endwhile; ?>        
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

