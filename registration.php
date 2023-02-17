<?php
require_once("config.php");

use Guestbook\Classes\User;
use Guestbook\Classes\Validator;
use Guestbook\Classes\DB;

if (!empty($_SESSION['user_id'])) {
    header("location: /index.php");
}


// создаем массив с ошибками валидации формы
$errors = [];
if (!empty($_POST)) {
    // if (empty($_POST['user_name'])) {
    //     $errors[] = 'Please enter User Name';
    // }
    // if (empty($_POST['email'])) {
    //     $errors[] = 'Please enter email';
    // }
    // if (empty($_POST['first_name'])) {
    //     $errors[] = 'Please enter First Name';
    // }
    // if (empty($_POST['last_name'])) {
    //     $errors[] = 'Please enter Last Name';
    // }
    // if (empty($_POST['password'])) {
    //     $errors[] = 'Please enter password';
    // }


    $validator = new Validator(new DB());
    foreach ($_POST as $k => $v) {
        $validator->checkEmpty($k, $v);
    }


    // if (strlen($_POST['uwer_name']) > 100) {
    //     $errors[] = 'Большое количество символов';
    // }
    // if (strlen($_POST['first_name']) > 50) {
    //     $errors[] = 'Большое количество символов';
    // }
    // if (strlen($_POST['last_name']) > 50) {
    //     $errors[] = 'Большое количество символов';
    // }
    // if (strlen($_POST['password']) < 6) {
    //     $errors[] = 'Большое количество символов';
    // }
    // if ($_POST['password'] !== $_POST['confirm_password']) {
    //     $errors[] = 'Укажите одинаковые пароли';
    // }


    $validator->checkMaxLength('user_name', $_POST['user_name'], 'users', 'username');
    $validator->checkMaxLength('first_name', $_POST['first_name'], 'users', 'first_name');
    $validator->checkMaxLength('last_name', $_POST['last_name'], 'users', 'last_name');
    $validator->checkMinLength('password', $_POST['passwors'], 6);
    $validator->checkMatch('password', $_POST['password'], 'confirm_password', $_POST['confirm_password']);
    $errors = $validator->errors;

    if (empty($errors)) {


        // добавляем нашего пользователя в базу дынных

        //     $stmt->execute(array('username' => $_POST['user_name'], 'email' => $_POST['email'], 'password' => sha1($_POST['password'] . SALT), 'first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name']));
        // }
        // header("location: /login.php?registration=1");

        $user = new User();
        $user->userName = $_POST['user_name'];
        $user->email = $_POST['email'];
        $user->password = sha1($_POST['password'] . SALT);
        $user->firstName = $_POST['first_name'];
        $user->lastName = $_POST['last_name'];
        $user->save();
        // header("location: /login.php?registration=1");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
</head>

<body>
    <h1>Форма регистрации</h1>
    <div>
        <form action="" method="POST">
            <div style="color: red;">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
            <div>
                <label>User Name</label>
                <div>
                    <input type="text" name="user_name" value="<?php echo (!empty($_POST['user_name']) ? $_POST['user_name'] : '') ?>">
                </div>
            </div>
            <div>
                <label>Email</label>
                <div>
                    <input type="email" name="email" value="<?php echo (!empty($_POST['email']) ? $_POST['email'] : '') ?>">
                </div>
            </div>
            <div>
                <label>First Name</label>
                <div>
                    <input type="text" name="first_name" value="<?php echo (!empty($_POST['first_name']) ? $_POST['first_name'] : '') ?>">
                </div>
            </div>
            <div>
                <label>Last Name</label>
                <div>
                    <input type="text" name="last_name" value="<?php echo (!empty($_POST['last_name']) ? $_POST['user_name'] : '') ?>">
                </div>
            </div>
            <div>
                <label>Password</label>
                <div>
                    <input type="password" name="password" value="" />
                </div>
            </div>
            <div>
                <label>Confirm Password</label>
                <div>
                    <input type="password" name="confirm_password" value="" />
                </div>
            </div>
            <div>
                <br>
                <input type="submit" name="submit" />
            </div>
        </form>
    </div>
</body>

</html>