<?php
session_start();
if ( isset($_POST['cancel'] ) ) {
    header("Location: /exp4/index");
    return;
}

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc','root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ( isset($_POST['enm']) && isset($_POST['address']) && isset($_POST['eid']) ) {

    // Data validation
    if($_POST['enm'] == "" || $_POST['address'] == "" ){
        $_SESSION['error'] = "All fields are required";
        header("Location: /exp4/edit");
        return;
    }else{
        $sql = "UPDATE `employee` SET `enm`= :enm,`address`= :address WHERE `eid`= :eid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':enm' => $_POST['enm'],
            ':address' => $_POST['address'],
            ':eid' => $_POST['eid'])
        );
        $_SESSION['success'] = 'Record updated.';
        header( 'Location: /exp4/index' ) ;
        return;
    }
}

// Guardian: enm sure that eid is present
if ( ! isset($_GET['eid']) ) {
  $_SESSION['error'] = "Missing eid";
  header('Location: /exp4/index');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM employee where eid = :xyz");
$stmt->execute(array(":xyz" => $_GET['eid']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for eid';
    header( 'Location: /exp4/index' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$mk = htmlentities($row['enm']);
$ml = htmlentities($row['address']);
$eid = $row['eid'];
?>
<h1>Editing Automobile</h1>
<form method="post">
<p>Name:
<input type="text" name="enm" value="<?= $mk ?>"></p>
<p>Address:
<input type="text" name="address" value="<?= $ml ?>"></p>
<input type="hidden" name="eid" value="<?= $eid ?>">
<input type="submit" value="Save">
<input type="submit" name="cancel" value="Cancel">
</form>
