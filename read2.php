<?php
// OGP用情報取得関数
function getOgpImg($url) {
    // URLからHTMLを取得
    $html = file_get_contents($url);
    if ($html === false) {
        throw new Exception('Error fetching the URL');
    }

    // DOMDocumentを使用してHTMLを解析
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    
    $metaTags = $doc->getElementsByTagName('meta');
    foreach ($metaTags as $meta) {
        if ($meta->getAttribute('property') == 'og:image') {
            $ogpImg = $meta->getAttribute('content');
        }
    }
    
    return $ogpImg;
}


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

        $url = $result['url'];
        $ogpImg = getOgpImg($url);

        $view .= '<div class="item ';
        $view .= $result['color'];
        $view .= '">';
        $view .= '<p class="sname">';
        $view .= $result['sname'];
        $view .= '</p>';
        $view .= '<img class="ogpImg" src="';
        $view .= getOgpImg($url);
        $view .= '" alt="">';
        $view .= '<div class="details"><p><span>プラン</span>';
        $view .= $result['plan'];
        $view .= '</p><p><span>メール</span>';
        $view .= $result['mail'];
        $view .= '</p><p><span>支払有無</span>';
        $view .= $result['payment'];
        $view .= '</p><p><span>補足</span>';
        $view .= $result['note'];
        $view .= '</p><a href="';
        $view .= $url;
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