<fieldset>
    <legend>目前位置：首頁 > 問卷調查</legend>
    <table>
        <tr>
            <th>編號</th>
            <th width="60%">問卷題目</th>
            <th>投票總數</th>
            <th>結果</th>
            <th>狀態</th>
        </tr>
        <?php
        // OOP 概念：$Que 物件應為某個問卷相關的類別實例，使用 all 方法取得所有主題問卷資料
        $rows = $Que->all(['subject_id' => 0]);

        // 逐筆顯示問卷資料，$key 為索引，$row 為每筆問卷資料（陣列）
        foreach ($rows as $key => $row):
        ?>
            <tr>
                <td><?= $key + 1; ?></td> <!-- 顯示問卷編號（索引+1） -->
                <td><?= $row['text']; ?></td> <!-- 顯示問卷題目 -->
                <td><?= $row['vote']; ?></td> <!-- 顯示投票總數 -->
                <td><a href='?do=result&id=<?= $row['id']; ?>'>結果</td> <!-- 連結至該問卷結果頁 -->
                <td>
                    <?php
                    // session 功能：判斷使用者是否已登入（$_SESSION['login'] 是否存在）
                    if (isset($_SESSION['login'])):
                    ?>
                        <!-- 已登入可參與投票，連結至投票頁 -->
                        <a href="?do=vote&id=<?= $row['id']; ?>">參與投票</a>
                    <?php else: ?>
                        <!-- 未登入則提示先登入，連結至登入頁 -->
                        <a href="?do=login">請先登入</a>
                    <?php endif;   ?>
                </td>
            </tr>

        <?php
        endforeach;
        // 結束問卷資料迴圈
        ?>
    </table>
</fieldset>