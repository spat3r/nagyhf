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
        //  p\.id, p\.usr, p\.psw, p\.wt, p\.wtg, p\.ht, p\.g, h\.gr, h\.date, h\.blds_id, m\.prot, m\.carb, m\.fat 
        $query = "SELECT *  FROM profil p ";
        $query .=" inner join profil_has_meal h on p.id = h.profil_id";
        $query .=" inner join meal m on m.id = h.meal_id";
        $eredmeny = mysqli_query($link, $query);

        ?>
                
        <div class="container justify-content-start">
        <div class="row justify-content-start">
            <h1>Telefonkönyv</h1>
        <div class="col-10">
        <table class="table table-hover table-bordered">
            <tr>
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
                <th scope="col">gramms</th>
                <th scope="col">prot</th>      
                <th scope="col">carb</th>      
                <th scope="col">fat</th> 

            </tr> 
            <?php while ($row = mysqli_fetch_array($eredmeny)): ?>
                <tr>
                <th scope=""> <?=$row['id']?> </th>
                <th scope=""> <?=$row['usr']?> </th>
                <th scope=""> <?=$row['psw']?> </th>
                <th scope=""> <?=$row['wt']?> </th>
                <th scope=""> <?=$row['wtg']?> </th>
                <th scope=""> <?=$row['ht']?> </th>
                <th scope=""> <?=$row['g']?> </th>
                <th scope=""> <?=$row['gr']?> </th>
                <th scope=""> <?=$row['date']?> </th>
                <th scope=""> <?=$row['name']?> </th>
                <th scope=""> <?=$row['blds_id']?> </th>
                <th scope=""> <?=$row['prot']?> </th>
                <th scope=""> <?=$row['carb']?> </th>
                <th scope=""> <?=$row['fat']?> </th>

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

