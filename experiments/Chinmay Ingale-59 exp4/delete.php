<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc','root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ( isset($_POST['delete']) && isset($_POST['eid']) ) {
    $sql = "DELETE FROM employee WHERE eid = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['eid']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: /exp4/index' ) ;
    return;
}

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

?>
<p>Confirm: Deleting <?= htmlentities($row['enm']) ?></p>

<form method="post">
<input type="hidden" name="eid" value="<?= $row['eid'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="/exp4/index">Cancel</a>
</form>

