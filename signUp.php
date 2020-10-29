<?php
    //まずはデータベースへ接続します
    $dsn = "mysql:dbname=php_tools;host=localhost;charset=utf8mb4";
    $username = "root";
    $password = "root";
    $options = [];
    $pdo = new PDO($dsn, $username, $password, $options);
    //追加ボタンが押された時の処理を記述します。
    if (null !== $_POST["username"]) { //追加ボタンが押され方どうかを確認
        if($_POST["username"] != ""){ //メモが入力されているかを確認
            //メモの内容を追加するSQL文を作成し、executeで実行します。
            $stmt = $pdo->prepare("INSERT INTO Users(userName) VALUE (:username)"); //SQL文の骨子を準備
            $stmt->bindvalue(":username", $_POST["username"]); //:titleをpost送信されたtitleの内容に置換
            $stmt->execute(); //SQL文を実行
            // 登録されればgajyumaruに飛ばしたい
              header('location: gajyumaru.php');
              exit();
      
        }
    }
    
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>SignUp</title>
   <link rel="stylesheet" href="./signUp.css">
 </head>
 <body>
 <div class="container flex">
      <!-- タイプライター -->
         <div id="app">
          <span id="typewriter"></span>
        </div>
        <!-- 入力 -->
      <form class="form flex" action="signUp.php" method="post">
        <label>Your name</label>
        <input type="text" name="username">
        <button type="submit">Sign Up!</button>
      </form>
    </div>
    <canvas class="background"></canvas>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script>
      <script src="./signUp.js"></script>
      <script src="./gajyumaru.js"></script>


 </body>
</html>


