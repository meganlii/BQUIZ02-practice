<!-- reg -->
<fieldset>
    <legend>會員註冊</legend>
    <div class="ct" style="color:red">*請設定您要註冊的帳號及密碼(最⾧ 12 個字元)</div>
    <form action="">
        <table>
            <tr>
                <td>帳號</td>
                <td>
                    <input type="text" name="acc" id="acc">
                </td>
            </tr>
            <tr>
                <td>密碼</td>
                <td>
                    <input type="text" name="pw" id="pw">
                </td>
            </tr>
            <tr>
                <td>確認密碼</td>
                <td>
                    <input type="text" name="pw2" id="pw2">
                </td>
            </tr>
            <tr>
                <td>信箱</td>
                <td>
                    <input type="text" name="forgot" id="forgot">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="註冊" onclick="reg()">
                    <input type="reset" value="清除">
                </td>
                <td></td>
            </tr>
        </table>
    </form>
</fieldset>

<script>
    function reg(){
        let data={
            acc:$("#acc").val(),
            pw:$("#pw").val(),
            pw2:$("#pw2").val(),
            email:$("#email").val()
        }

        if (data.acc=='' || data.pw=='' || data.email=='') {
            alert('不可空白');
            
        }else if (data.pw != data.pw2) {
            alert('密碼錯誤');
        }

        

    }

</script>