<?php
    //まずはデータベースへ接続します
    $dsn = "mysql:dbname=php_tools;host=localhost;charset=utf8mb4";
    $username = "root";
    $password = "root";
        $options = [];
    $pdo = new PDO($dsn, $username, $password, $options);
    //追加ボタンが押された時の処理を記述します。
    if (null !== $_POST["create"]) { //追加ボタンが押され方どうかを確認
        if($_POST["title"] != "" OR $_POST["contents"] != ""){ //メモが入力されているかを確認
            //メモの内容を追加するSQL文を作成し、executeで実行します。
            $stmt = $pdo->prepare("INSERT INTO gajyumaru(title,contents) VALUE (:title,:contents)"); //SQL文の骨子を準備
            $stmt->bindvalue(":title", $_POST["title"]); //:titleをpost送信されたtitleの内容に置換
            $stmt->bindvalue(":contents", $_POST["contents"]); //:contentsをpost送信されたcontentsの内容に置換
            $stmt->execute(); //SQL文を実行
        }
    }
      //変更ボタンが押された時の処理を記述します。
      if (null !== $_POST["update"]) { //変更ボタンが押され方どうかを確認
        $stmt = $pdo->prepare("UPDATE gajyumaru SET title=:title, contents=:contents WHERE ID=:id");
        $stmt->bindvalue(":title", $_POST["title"]);
        $stmt->bindvalue(":contents", $_POST["contents"]);
        $stmt->bindvalue(":id", $_POST["id"]);
        $stmt->execute();
    }
    //削除ボタンが押された時の処理を記述します。
    if (null !== $_POST["delete"]) { //削除ボタンが押され方どうかを確認
        $stmt = $pdo->prepare("DELETE FROM gajyumaru WHERE ID=:id");
        $stmt->bindvalue(":id", $_POST["id"]);
        $stmt->execute();
    }
    $title = "Chat";





// session_start();
// ini_set("display_errors", "1");


// if (empty($_SESSION["user"])) {
//   header('location: login.php');
//   exit();
// } else {
//   $user = $_SESSION["user"]; 
// }
?>

      <!DOCTYPE html>
      <html lang="ja">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title><?=$title?></title>
          <link rel="stylesheet" href="./gajyumaru.css">
          <link href="https://fonts.googleapis.com/css?family=Amatic+SC:700" rel="stylesheet">
      </head>
      <body id="particles-js">
          <!-- logout -->
          <!-- <div class="wrapper"> -->
      <div class="container flex">
            <div class="box flex">
                <!-- メモの新規作成フォーム -->
                <form class="basic_form flex" action="gajyumaru.php" method="post">
                    <!-- <p>create</p> -->
                    <br>
                    <p> Title</p>
                    <input type="text" name="title" size="20"></input><br>
                    <p>Contents</p>
                    <textarea name="contents" style="width:300px; height:100px;"></textarea><br>
                    <input type="submit" name="create" value="submit">
                </form>
            </div>
        </div>

      <!-- <div class="space"></div> -->
      <a href="./logout.php">Log Out</a>
    <main>
      <!-- Particle -->
        <!-- 以下にメモ一覧を追加 -->
        <?php
            //gajyumaruテーブルからデータを取得
            $stmt = $pdo->query("SELECT * FROM gajyumaru");
            //foreachを使ってデータを１つずつ順番に処理していく
            foreach ($stmt as $row):
        ?>
       
        <div class="container_memo">
            <form class="made_form" action="gajyumaru.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row[0]?>"></input>
                Title<br>
                <input type="text" name="title" size="20" value="<?php echo $row[1]?>"></input><br>
                Contents<br>
                <textarea name="contents" style="width:300px; height:100px;"><?php echo $row[2]?></textarea><br>
                <input type="submit" name="update" value="update">
                <input type="submit" name="delete" value="delete">

            </form>
            <?php endforeach; ?>
        </div>
    </main>
    <!-- <canvas class="background"></canvas></div> -->
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script> -->
            <!-- <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> -->

        <script src="./gajyumaru.js"></script>
      </body>
      </html>  
        
        
   
