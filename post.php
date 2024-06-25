<div class="input_wrap">
    <h2>契約情報登録</h2>
    <form action="insert.php" method="post" class="input_form">
        <div class="input_item">
            <label for="sname">サービス名</label>
            <input type="text" name="sname" id="sname" class="inputarea">
        </div>
        <div class="input_item">
            <label for="url">サービスURL</label>
            <input type="url" name="url" id="url" class="inputarea">
        </div>
        <div class="input_item">
            <label for="mail">メールアドレス</label>
            <input type="email" name="mail" id="mail" class="inputarea">
        </div>
        <div class="input_item">
            <label for="plan">利用プラン</label>
            <input type="text" name="plan" id="plan" class="inputarea">
        </div>
        <div class="input_item">
            <label for="payment">支払有無</label>
            <select name="payment" id="payment" class="inputarea">
                <option value=""></option>
                <option value="無料">無料</option>
                <option value="月払い">月払い</option>
                <option value="年払い">年払い</option>
                <option value="その他">その他</option>
            </select>
        </div>
        <div class="input_item">
            <label for="note">補足</label>
            <input type="text" name="note" id="note" class="inputarea">
        </div>
        <div>
            <input type="submit" value="登録" class="submit_btn">
        </div>
    </form>
</div>