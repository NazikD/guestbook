<?php
require_once("config.php");

use Guestbook\Classes\User;

if (!empty($_SESSION['user_id'])) {
    header("location: /index.php");
}
$errors = [];
$isRegistered = 0;
if (!empty($_GET['registration'])) {
    $isRegistered = 1;
}
if (!empty($_POST)) {
    if (empty($_POST['user_name'])) {
        $errors[] = 'Введите корректный пароль';
    }
    if (empty($_POST['password'])) {
        $errors[] = 'введите пароль';
    }
    if (empty($errors)) {
        // $stmt = $dbConn->prepare('SELECT id FROM users WHERE (username = :username or email = :username) and password = :password');
        // $stmt->execute(array('username' => $_POST['user_name'], 'password' => sha1($_POST['password'] . SALT)));
        // $id = $stmt->fetchColumn();

        // if (!empty($id)) {
        //     $_SESSION['user_id'] = $id;
        //     echo 'вы успешно авторизированы';
        // } else {
        //     $errors[] = '';
        // }
        $user = new User();
        $user = $user->checkLogin($_POST['user_name'], sha1($_POST['password'] . SALT));
        if (!empty($user->id)) {
            $_SESSION['user_id'] = $user->id;
            header("location: /index.php");
        } else {
            $errors[] = 'Please enter valid credentails';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if (!empty($isRegistered)) : ?>
        <h2>Вы успешно зарегистрировались</h2>
    <?php endif ?>
    <h1>Log in Page</h1>
    <div>
        <form action="" method="POST">
            <div style="color: red">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
            <div>
                <label for="">User name / Email</label>
                <div>
                    <input type="text" name="user_name" value="<?php echo (!empty($_POST['user_name']) ? $_POST['user_name'] : ''); ?>" />
                </div>
            </div>
            <div>
                <label for="">Password</label>
                <div>
                    <input type="password" name="password" value="">
                </div>
            </div>
            <div>
                <input type="submit" name="submit">
            </div>
        </form>
    </div>
</body>

</html>