<?php

$meals = mysqli_query($link, "SELECT *  FROM  meal m;");
echo "<input class=\"form-control mb-2\" id=\"myInput\" type=\"text\" placeholder=\"Search..\">";
echo "<table class=\"table table-dark table-bordered  mb-0\"><tr>";
echo "<thead>
    <th scope=\"col\">fogás</th>
    <th scope=\"col\">protein</th>
    <th scope=\"col\">szénhidrát</th>
    <th scope=\"col\">zsír</th>
    <th scope=\"col\">alter</th></thead><tbody>";
foreach ($meals as $meal) {
    echo "
    <tr>
    <form action=\"db_printer.php\" method=\"post\">
    <td><textarea class=\"form-control\" name=\"name\" id=\"exampleFormControlTextarea1\" rows=\"1\">{$meal['name']}</textarea></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['prot']}\"name=\"prot\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['carb']}\"name=\"carb\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['fat']}\"name=\"fat\" id=\"\"></input></td>
    <td style=\"width: 100px; white-space: nowrap \">
    <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
    <input type=\"text\" style=\"height: 0px; width: 0px;\"class=\"invisible p-0 m-0\" value=\"{$meal['id']}\" name=\"id\" ></input>
    <a href=\"db_printer.php?id={$meal['id']}&del=meal\" class=\"btn btn-danger\">Delete</a>
    </td>
    </form>
    </tr><tr>";
}
echo "</td></tr></tbody></table>   ";

?>