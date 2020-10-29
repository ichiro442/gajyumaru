<!-- gajyumaruに飛ばす正解code -->
<?php
session_start();
ini_set("display_errors", "1");


if (isset($_SESSION["user"])) {
    header('location: gajyumaru.php');
    exit();
} elseif (!empty($_POST["user"])) {
    // get values passefrom
    $user = $_POST['user'];
    
    //まずはデータベースへ接続します
    $dsn = "mysql:dbname=php_tools;host=localhost;charset=utf8mb4";
    $username = "root";
    $password = "root";
    $options = [];
    $pdo = new PDO($dsn, $username, $password, $options); 
    // pdoはデータベース
    $sql = "SELECT * FROM Users WHERE userName = '$user'";
    // selectはデータベースから取ってくる
    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    // fetchAllは配列にする
    if(count($result) > 0){
        // if(count($result) > 0)は該当するやつが１つでもあればって意味
        $_SESSION["user"] = $_POST["user"];
        header('location: gajyumaru.php');
        exit();
    }
}
$title = "Login";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <!-- 初期設定 -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title><?=$title?></title>
  <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div class="container flex">
        <div class="login-box flex">
            <!-- タイプライター -->
            <div id="app">
                <span id="typewriter"></span>
            </div>
                <!-- <h1 class="login-ttl">LoginPage</h1> -->
            <form class="login-form flex" action="login.php" method="post">
                <div class="form-group flex">
                <label>Your Name</label>
                <input type="text" name="user" />
                </div>
                <button type="submit">Entering a room</button>
            </form>
            <a href="signUp.php">Sign Up</a>
            <!-- <input type="submit" value="SIGN UP"> -->
                    <canvas class="background"></canvas>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script>
        </div>
    </div>
        <!-- <script src="./particles.js"></script> -->
        <script src="./login.js"></script>
        <script src="./gajyumaru.js"></script>
</body>
</html>