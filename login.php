<?php
include("DB/conn.php");
session_start();
extract($_POST);
$sql = "SELECT * FROM user WHERE user_email='$email' AND user_password='$password'";
$res = mysqli_query($connect, $sql);
$data = mysqli_num_rows($res);
if($data>0)
{
    $user = mysqli_fetch_assoc($res);
    $_SESSION['user_id'] = $user['user_id'];
    header("location:pages/category_list.php");
}
else
{
    ?>
    <script>
        alert("Invalid Details");
        location.href = "index.php";
    </script>
    <?php
}
?>