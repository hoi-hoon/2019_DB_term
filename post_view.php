<?php include ("header.php"); ?>
<?php include ("config.php"); ?>
<div class='container'>
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $post_id = $_GET["post_id"];
    $query = "select * from post where post_id = $post_id";

    $res = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($res);

    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }

    $query_reple = "select reple_author,reple_content from post natural join reple where $post_id = reple.post_id"; 
    $res_reple = mysqli_query($conn, $query_reple);


    ?>
    <div class='container'>
        <table style="width:100%;" border="1">
            <tr style="border : solid; align:center">
                <td>글 고유번호</td>
                <td><?php echo $post['post_id']?></td>
                <td>작성날짜</td>
                <td><?php echo $post['post_date']?></td>
            </tr>
            <tr>
                <td>제목</td>
                <td><?php echo $post['post_title']?></td>
                <td>작성자</td>
                <td><?php echo $post['post_author']?></td>
            </tr>
            <tr>
                <td colspan="4" style="padding:15px;"><?php echo $post['post_content']?></td>
            </tr>
        </table>
        <div style="float:right">
            <a href='post_write_update.php?post_id=<?php echo $post['post_id']?>'><button class='button primary small'>수정</button></a>
            <button onclick='javascript:deleteConfirm(<?php echo $post['post_id']?>)' class='button danger small'>삭제</button>
        </div>
    </div>
    <div class='container'>
        <br><br>
        <p>댓글작성</p>
        <form action="reple_create.php?post_id=<?php echo $post_id ?>" method="post">
            <table class="table reple">
                <tr>
                    <th scope="row"><input type="text" name="reple_author" placeholder="작성자"></th>
                    <td ><input style="width: 700px;"type="text" name="reple_content" placeholder="내용"></td>
                    <td><button type="submit" class="btnSubmit btn">작성</button></td>
                </tr>
            </table>
        </form>
    </div>
    <div class='container'>
        <table class="table reple">
            <?
            while ($row = mysqli_fetch_array($res_reple)) {
                echo "<tr>";
                echo "<th scope=\"row\">{$row['reple_author']}</th>";
                echo "<td>{$row['reple_content']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
<?php include ("footer.php"); ?>
<script>
    function deleteConfirm(post_id) {
            var check_pw = prompt('비밀번호를 입력하세요');
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "post_delete.php?post_id=" + post_id+"&post_pw="+ check_pw;
            }else{   //취소
                return;
            }
        }
</script>
<style>
.table.reple {
    border-collapse: separate;
    border-spacing: 1px;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    margin: 20px 10px;
}
.table.reple th {
    width: 80px;
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    border-bottom: 1px solid #ccc;
    background: #efefef;
}
.table.reple td {
    width: 720px;
    padding: 10px;
    vertical-align: top;
    border-bottom: 1px solid #ccc;
}
</style>