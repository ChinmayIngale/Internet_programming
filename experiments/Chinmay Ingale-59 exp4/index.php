<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc','root', '');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<!DOCTYPE html>
<html>
<head>
<title>Chinmay Ingale</title>
</head>
<body>
<div class="container">
<h2>Welcome to the Employee Database</h2>
<?php
        if ( isset($_SESSION['error']) ) {
            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
            unset($_SESSION['error']);
        }
        if ( isset($_SESSION['success']) ) {
            echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
            unset($_SESSION['success']);
        }
        
        $stmt = $pdo->query("SELECT * FROM employee");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ( count($rows) == 0) {
            echo ("<p>No rows found</p>");
        }
        else{
            echo('<table border="1">'."\n");
            echo('<thead><tr>');
            echo('<th>Nmae</th>');
            echo('<th>Address</th>');
            echo('<th>Action</th>');
            echo('</tr></thead><tbody>');

            foreach( $rows as $row ) {
                echo "<tr><td>";
                echo(htmlentities($row['enm']));
                echo("</td><td>");
                echo(htmlentities($row['address']));
                echo("</td><td>");
                echo('<a href="edit/'.$row['eid'].'">Edit</a> / ');
                echo('<a href="delete/'.$row['eid'].'">Delete</a>');
                echo("</td></tr>\n");
            }
            echo('</tbody></table>');
        }
    echo('<p><a href="add">Add New Entry</a></p>');

    
?>
</div>
</body>
</html>