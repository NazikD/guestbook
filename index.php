git init<?php
require_once("config.php");
if (empty($_SESSION['user_id'])) {
    header("location: /login.php");
}

// if (!empty($_POST['comment'])) {
//     $stmt = $dbConn->prepare("INSERT INTO comments(`user_id`, `comment`) VALUE (:user_id, :comment)");
//     $stmt->execute(array('user_id' => $_SESSION['user_id'], 'comment' => $_POST['comment']));
// }
// $stmt = $dbConn->prepare("SELECT * FROM comments ORDER BY id DESC");
// $stmt->execute();
// $comments = $stmt->fetchAll();


$comment = new Comment();
if (!empty($_POST['comment'])) {
    $comment->comment = $_POST['comment'];
    $comment->userId = $_SESSION['user_id'];
    $comment->save();
}
$comments = $comment->findAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
</head>

<body>
    <div id="comments-header">
        <h1>Страница комментариев</h1>
    </div>
    <div id="comments-form">
        <h3>Please add your comment</h3>
        <form method="POST">
            <div>
                <label>Coment</label>
                <textarea name="comment">

                </textarea>
            </div>
            <div>
                <input type="submit" name="submit" value="Save">
            </div>
        </form>
    </div>
    <div id="ciments-panel">
        <h3>Comments</h3>
        <?php foreach ($comments as $comment) : ?>
            <p <?php if ($comment['user_id'] == $_SESSION['user_id']) echo "stile='fon-weght: bolt;'"; ?>>
                <?php echo $comment['comment']; ?>
                <span>(<?php echo $comment['created_at']; ?>)
                </span>
            </p>
        <?php endforeach ?>
    </div>
</body>

</html>