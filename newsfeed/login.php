<?php
session_start();
include("inc/header.php");
?>
<div id="allPage">
    <?php include("inc/top.php"); ?>
    <div id="content">
        <div id="body">
<?php
// Variable set start! :D
if (isset($_POST['user'])) {
    $user = $link->real_escape_string($_POST['user']);
} else {
    $user = "";
}
if (isset($_POST['pass'])) {
    $pass = $_POST['pass'];
} else {
    $pass = "";
}
?>
<div class="posting">
	<div id="login-text">
    <h1 class="postHeader" style="color: #000 !important;">Login</h1>
	</div>
    <form class="form-group" method="post">
        <input type="text" class="form-control" placeholder="User" name="user" value="<?php echo $user;?>" required>
        <br>
        <input type="password" class="form-control" placeholder="Password" name="pass" required>
        <br>
        <input type="submit" class="btn btn-default" value="Login" name="submit">
    </form>
<?php
// Start the verification :v
if (isset($_POST['submit'])) {
    $query = "SELECT
        *
    FROM
        admins
    WHERE
        user='$user'";
    $row = $link->query($query)->fetch_array();
    if ($row && password_verify($pass, $row['password'])) {
        $_SESSION['name'] = $row['name'];
        header("Location:index.php");
    } else {
		echo '<div id="login-text">';
        echo '<h3 class="postHeader" style="color: #000 !important;">Probeer het opnieuw</h3>';
		echo "</div>";
    }
}
?>
</div>
<?php include("inc/footer.php"); ?>
<?php
include("inc/header.php");
// Variable set start! :D
if (isset($_POST['user'])) {
    $userInput = $_POST['user'];
} else {
    $userInput = "";
}
if (isset($_POST['user'])) {
    $user = mysqli_real_escape_string($link, $_POST['user']);
} else {
    $user = "";
}
if (isset($_POST['pass'])) {
    $pass = md5($_POST['pass']);
} else {
    $pass = "";
}
?>
<div class="posting">
	<div id="login-text">
    <h1 style="color: #000 !important; padding: 15px !important;">Login</h1>
	</div>
    <form class="form-group" method="post">
        <input type="text" class="form-control" placeholder="User" name="user" value="<?php echo $userInput;?>" required>
        <br>
        <input type="password" class="form-control" placeholder="Password" name="pass" required>
        <br>
        <input type="submit" class="btn btn-default" value="Start!" name="submit">
    </form>
</div>
<?php
// Start the verification :v
$query = "SELECT
    *
FROM
    admins
WHERE
    user='$user'
AND
    password='$pass'
";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);
if ($row) {
    $_SESSION['name'] = $row['name'];
    header("Location:index.php");
} else if (isset($_POST['submit'])) {
	echo '<div id="login-text">';
    echo '<h3 style="color: #000 !important;">Probeer het opnieuw</h3>';
	echo "</div>";
}
?>

<?php include("inc/footer.php"); ?>
