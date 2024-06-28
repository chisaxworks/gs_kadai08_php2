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
        $view .= '<div class="item ';
        $view .= $result['color'];
        $view .= '">';
        $view .= '<p class="sname">';
        $view .= $result['sname'];
        $view .= '</p>';
        $view .= '<div class="details2"><p><span>プラン</span>';
        $view .= $result['plan'];
        $view .= '</p><p><span>メール</span>';
        $view .= $result['mail'];
        $view .= '</p><p><span>支払有無</span>';
        $view .= $result['payment'];
        $view .= '</p><p><span>補足</span>';
        $view .= $result['note'];
        $view .= '</p><a href="';
        $view .= $result['url'];
        $view .= '" target="_blank" class="open_btn">開く</a></div></div>';
    }

}
?>

<div class="display_wrap">
    <h2>契約一覧</h2>
    <div class="item_wrap">
        <?= $view ?>
    </div>
</div>