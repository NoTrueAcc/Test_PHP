<?php
session_start();

if(isset($_GET['destroy']))
{
    session_destroy();
    header("Location: index.php");
}


echo "<h1>Вы успешно прошли регистрацию.</h1>";
echo "ВаШ логин: " . $_SESSION['login'];
echo "<br>";
echo "Ваш пароль: " . $_SESSION['password'];

echo "<a href='?destroy=true'>Destroy</a>";
?>