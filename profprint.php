<?php
$profils = mysqli_query($link, "SELECT *  FROM profil p");

echo "<table class=\"table table-dark table-bordered\"><tr>";
echo "  <thead>
    <th scope=\"col\">ID</th>
    <th scope=\"col\">username</th>
    <th scope=\"col\">password</th>
    <th scope=\"col\">age</th>
    <th scope=\"col\">weight(kg)</th>
    <th scope=\"col\">weightgoal(kg)</th>
    <th scope=\"col\">height</th>
    <th scope=\"col\">male/female</th>
    <th scope=\"col\">alter</th></thead><tbody >";
foreach ($profils as $profil) {
    echo "
    <tr>
    <form action=\"db_printer.php\" method=\"post\">
    <td>{$profil['id']}</td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['usr']}\" name=\"usr\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['psw']}\" name=\"psw\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['age']}\" name=\"age\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['wt']}\" name=\"wt\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['wtg']}\" name=\"wtg\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['ht']}\" name=\"ht\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['g']}\" name=\"g\"></input></td>
    <td style=\"width: 100px; white-space: nowrap \">
    <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
    <input type=\"text\" style=\"height: 0px; width: 0px;\"class=\"invisible p-0 m-0\" value=\"{$profil['id']}\" name=\"id\" ></input>
    <a href=\"db_printer.php?id={$profil['id']}&del=profil\" class=\"btn btn-danger\">Delete</a></td>
    </form>
    </tr>";
}
echo "</tbody></table>   ";

?>