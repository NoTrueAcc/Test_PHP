<?php

    include_once "library/User.php";

    if(isset($_GET['action']) && $_GET['action'] == "logout")
    {
        session_start();
        unset($_SESSION['login']);
        unset($_SESSION['password']);

        header("Location: index.php");
        exit();
    }
    $user = User::getObject();
    $auth = $user->isAuth();

    if(isset($_POST['register']))
    {
        $user->regUser($_POST['login'], $_POST['password']);
    }
    elseif(isset($_POST['auth']))
    {
        $authUser = $user->loginUser($_POST['login'],$_POST['password']);
        if($authUser)
        {
            header("Location: index.php");
            exit();
        }
    }

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
<?php
    if($auth)
    {
        echo "<p>Добро пожаловать " . $_SESSION['login'] . "</p>";
        echo "<a href='?action=logout'>Выйти</a>";
    }
    else
    {
        echo "Войдите или зарегистрируйтесь!";
    }
?>
    <form action="index.php" method="post" name="register">
        <table>
            <tr>
                <td>Логин: </td>
                <td><input type="text" name="login" required="required"></td>
            </tr>
            <tr>
                <td>Пароль: </td>
                <td><input type="password" name="password" required="required"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="register" value="Зарегистрироваться"></td>
            </tr>
        </table>
    </form>
    <form action="index.php" method="post" name="auth">
        <table>
            <tr>
                <td>Логин: </td>
                <td><input type="text" name="login" required="required"></td>
            </tr>
            <tr>
                <td>Пароль: </td>
                <td><input type="password" name="password" required="required"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="auth" value="Войти"></td>
            </tr>
        </table>
    </form>
</body>
</html>
