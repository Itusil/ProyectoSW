<?php session_start();
?>
<?php
$_SESSION['tema'] = $_POST['tema'];
$tema = $_SESSION['tema'];
echo "<script>window.location.href = 'play.php';</script> ";
?>