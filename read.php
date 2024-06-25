<?php
//1.  DB接続します
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=gs_kadai_php;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_kadai_php');
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);

}else{
    //whileで1件ずつ取得
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<a class="item" target="_blank" href="';
        $view .= $result['url'];
        $view .= '">';
        $view .= '<p>';
        $view .= $result['sname'];
        $view .= '</p>';
        $view .= '<p>';
        $view .= $result['plan'];
        $view .= '</p>';
        $view .= '</a>';
    }

}
?>

<div class="display_wrap">
    <h2>契約一覧</h2>
    <div class="item_wrap">
        <?= $view ?>
    </div>
</div>