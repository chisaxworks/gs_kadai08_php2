<?php
//1.  DB接続します
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=chisaxworks_gs_kadai_php;charset=utf8;host=mysql635.db.sakura.ne.jp','chisaxworks','gs_kadai08_php2');
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
        $view .= '<a class="item ';
        $view .= $result['color'];
        $view .= '" target="_blank" href="';
        $view .= $result['url'];
        $view .= '">';
        $view .= '<p class="sname">';
        $view .= $result['sname'];
        $view .= '</p>';
        $view .= '<p class="normal">';
        $view .= $result['plan'];
        $view .= '</p>';
        $view .= '<div class="icon_wrap"><div class="paytype">';
        $view .= $result['payment'];
        $view .= '</div><div class="mailtype">';
        $view .= $result['mail'];
        $view .= '</div></div>';
        $view .= '<p class="normal">';
        $view .= $result['note'];
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