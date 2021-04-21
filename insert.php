<?php session_start()?>
<!DOCTYPE html>
<html>
    <head><title>Telefonkönyv</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"></head>
    <body>
        <div class="container">
            <div class="col-6">
                <h1>Új telefonszám</h1>
                <form action="insert.php" method="post">           <!--a felhaználói kényelem érdekében abban az esetben ha nem megfelelő a telefonszám formátuma--> 
                <div class="mb-3">                                  <!--//előre kitöltjük neki a már megdott adataival, hogy azokat ne kelljen újra beírnia-->
                    <label for="exampleInputEmail1" class="form-label">Név </label>
                    <input type="text" class="form-control" value="<?php if(isset($_POST['nev'])) echo $_POST['nev'];?>" name="nev" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Telefonszám</label>
                    <input type="text" class="form-control" value="<?php if(isset($_POST['szam'])) echo $_POST['szam'];?>" name="szam" >
                    <?php if(isset($_SESSION["error"])) echo "<div style=\"color:crimson\">A megadott telefonszám nem megfelelő </div>";?>  <!--//valamint ha nem megefelelő a telszám, felhívjuk ráa felhasználó figyelmét--> 
                    
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Cím</label>
                    <input type="text" class="form-control" value="<?php if(isset($_POST['cim'])) echo $_POST['cim'];?>" name="cim">
                </div>
                <button type="submit" value="Elküld" name="uj" class="btn btn-primary">Elküld</button>
                </form>
            </div>
        </div>
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>

    </body>
</html>

<?php 
include 'db.php';
if (isset($_POST['uj']) and isset($_POST['nev']) and isset($_POST['szam']) and isset($_POST['cim'])){
    $link = open_db();
    $nev = $_POST['nev'];
    $szam = $_POST['szam'];
    $cim = $_POST['cim'];

   //regexel ellenőrízzük, hogy a telefonszámok megfelelő formátumúak-e
    if(preg_match("/^[0-9]{2}-[0-9]{3}-[0-9]{3}$/", $szam)  or preg_match("/^[+]{1}[0-9]{2}-[0-9]{2}-[0-9]{7}$/", $szam)){
       
        //ha igen, akkor mentjük az adatbázisba
        $query = sprintf("INSERT INTO telefonkonyv (nev, szam, cim) VALUES ('%s', '%s', '%s')", mysqli_real_escape_string($link, $nev), mysqli_real_escape_string($link, $szam), mysqli_real_escape_string($link, $cim));

        mysqli_query($link, $query);
        mysqli_close($link);
        unset($_SESSION["error"]);      //ha elsőre nem adta meg jól a telszám formátumát, itt töröljük a hibaüzenetet
        $_SESSION["succes"]="added";
        header("Location: index.php");
        }
    else {
        mysqli_close($link);
        unset($_POST['szam']);
        $_SESSION["error"]="szam";
    }

    
}
    
?>