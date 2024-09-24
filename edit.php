<?php

// 他のPHPファイルを読み込む
require_once __DIR__ . '/functions/user.php';

// これを忘れない
session_start();

if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
  header('Location: ./login.php');
  exit();
}

$id = $_SESSION['id'] ?? $_COOKIE['id'];

$user = getUser($id);

// フォームが送信されたかチェックする
if (isset($_POST['submit-button'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // 連想配列を作成
    $user = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'birthdate' => $birthdate,
        'phone' => $phone,
        'address' => $address,
    ];

    // 関数を呼び出す
    $user = editUser($user);

    // my-page に移動させる（リダイレクト）
    header('Location: ./my-page.php');
    exit();
}

?>
<html>
    <body>
        <h1>情報変更</h1>
        <form action="./register.php" method="post">
            <div>
                お名前<br>
                <input type="text" name="name" value="<?php echo $user['name']; ?>">
            </div>
            <div>
                メールアドレス<br>
                <input type="email" name="email" value="<?php echo $user['email']; ?>">
            </div>
            <div>
                パスワード<br>
                <input type="password" name="password">
            </div>
            <div>
                生年月日<br>
                <input type="date" name="birthdate" value="<?php echo $user['birthdate']; ?>">
            </div>
            <div>
                電話番号<br>
                <input type="tel" name="phone" value="<?php echo $user['phone']; ?>">
            </div>
            <div>
                住所<br>
                <input type="text" name="address" value="<?php echo $user['address']; ?>">
            </div>
            <div>
                <!-- <button type="submit">登録</button> -->
                <input type="submit" value="登録" name="submit-button">
            </div>
        </form>
        <?php include __DIR__ . '/includes/footer.php' ?>
    </body>
</html>
