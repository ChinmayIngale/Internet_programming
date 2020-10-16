<?php
session_start();
    if ( isset($_POST['cancel'] ) ) {
        header("Location: /exp4/index");
        return;
    }

    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc','root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ( isset($_POST['ename']) && isset($_POST['address'])) {
        if($_POST['ename'] == "" || $_POST['address'] == ""){
            $_SESSION['error'] = "All fields are required";
            header("Location: /exp4/add");
            return;
        }else{
            $stmt = $pdo->prepare('INSERT INTO employee
                (enm, address) VALUES ( :nm, :ad)');
            $stmt->execute(array(
                ':nm' => $_POST['ename'],
                ':ad' => $_POST['address'])
            );
            $_SESSION['success'] = "Record added.";
            header("Location: /exp4/index");
            return;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Chinmay Ingale</title>
</head>
<body>
<div class="container">
<h1>Add Employee</h1>
<?php
if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>
<form method="post">
<p>Name:
<input type="text" name="ename" size="60"/></p>
<p>Address:
<input type="text" name="address" size="60"/></p>

<input type="submit" value="Add">
<input type="submit" name="cancel" value="Cancel">
</form>
</div>
</body>
</html>