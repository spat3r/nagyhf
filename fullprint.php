<?php
$profils = mysqli_query($link, "SELECT *  FROM profil p");
foreach ($profils as $profil) {
    $meals = mysqli_query($link, "SELECT *  FROM profil p  inner join profil_has_meal h on p.id = h.profil_id  inner join meal m on m.id = h.meal_id WHERE p.id = {$profil['id']};");
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
    <th scope=\"col\">alter</th></thead>";
    echo "<tbody  id=\"myTable\">
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
    </tr><tr><td  colspan=\"9\">";
    echo "<table class=\"table table-dark table-bordered mb-0\"><tr>";
    echo "<thead>
    <th scope=\"col\">fogás</th>
    <th scope=\"col\">tömeg</th>
    <th scope=\"col\">dátum</th>
    <th scope=\"col\">étkezés</th>
    <th scope=\"col\">protein</th>
    <th scope=\"col\">szénhidrát</th>
    <th scope=\"col\">zsír</th>
    <th scope=\"col\">alter</th></thead><tbody>";
    foreach ($meals as $meal) {
        echo "
    <tr>
    <form action=\"db_printer.php\" method=\"post\">
    <td><textarea class=\"form-control\" name=\"name\" id=\"exampleFormControlTextarea1\" rows=\"1\">{$meal['name']}</textarea></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['gr']}\"name=\"gr\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['date']}\"name=\"date\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['blds_id']}\"name=\"blds_id\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['prot']}\"name=\"prot\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['carb']}\"name=\"carb\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['fat']}\"name=\"fat\" id=\"\"></input></td>
    <td style=\"width: 100px; white-space: nowrap \">
    <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
    <input type=\"text\" style=\"height: 0px; width: 0px;\"class=\"invisible p-0 m-0\" value=\"{$meal['id']}\" name=\"id\" ></input>
    <input type=\"text\" style=\"height: 0px; width: 0px;\"class=\"invisible p-0 m-0\" value=\"{$meal['hid']}\" name=\"hid\" ></input>
    <a href=\"db_printer.php?id={$meal['id']}&del=meal\" class=\"btn btn-danger\">Delete</a>
    </td>
    </form>
    </tr><tr>";
    }
    echo "</td></tr></tbody></table>   ";
    echo "</tr></tbody></table>   ";
}
?>