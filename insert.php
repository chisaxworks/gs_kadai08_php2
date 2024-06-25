<?php

//1. POSTデータ取得
$sname = $_POST["sname"];
$url = $_POST["url"];
$mail = $_POST["mail"];
$plan = $_POST["plan"];
$payment = $_POST["payment"];
$note = $_POST["note"];


//2. PHPからDB接続します
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=chisaxworks_gs_kadai_php;charset=utf8;host=mysql635.db.sakura.ne.jp','chisaxworks','gs_kadai08_php2');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }

//３．データ登録SQL作成

  // 1. SQL文を用意
  $stmt = $pdo->prepare('INSERT INTO
    gs_kadai_php(id, sname, url, mail, plan, payment, note)
    VALUES(NULL, :sname, :url, :mail, :plan, :payment, :note)');

  //  2. バインド変数を用意
  // Integer 数値の場合 PDO::PARAM_INT
  // String文字列の場合 PDO::PARAM_STR

  $stmt->bindValue(':sname', $sname, PDO::PARAM_STR);
  $stmt->bindValue(':url', $url, PDO::PARAM_STR);
  $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
  $stmt->bindValue(':plan', $plan, PDO::PARAM_STR);
  $stmt->bindValue(':payment', $payment, PDO::PARAM_STR);
  $stmt->bindValue(':note', $note, PDO::PARAM_STR);

  //  3. 実行
  $status = $stmt->execute();

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}

?>
<?php include("head.html");?>
<div class="write_wrap">
    <h2>以下の内容で登録しました</h2>
    <div class="item_wrap">
        <div class="item">
            <p class="sname">サービス名:<?=$sname?></p>
            <p>サービスURL:<?=$url?></p>
            <p>メール:<?=$mail?></p>
            <p>利用プラン:<?=$plan?></p>
            <p>支払有無:<?=$payment?></p>
            <p>備考:<?=$note?></p>
        </div>
    </div>
    <a class="back_btn" href="index.php">戻る</a>
</div>
<?php include("foot.html");?>