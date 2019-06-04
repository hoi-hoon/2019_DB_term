<?php include ("header.php"); ?>
<?php include ("config.php"); ?>
<?php
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$query = "select * from type";
$res = mysqli_query($conn, $query);

?>
<div class='container'>

<form action="post_create.php" method="post">
    <table style="width:100%">
        <caption>자유게시판 글쓰기</caption>
        <tbody>
            <tr>
                <th scope="row"><label for="post_author">글쓴이</label></th>
                <td class="author"><input type="text" name="post_author" id="post_author"></td>
            </tr>
            <tr>
                <th scope="row"><label for="post_pw">비밀번호</label></th>
                <td class="pw"><input type="password" name="post_pw" id="post_pw"></td>
            </tr>
            <tr>
                <th scope="row"><label for="post_type">글 분류</label></th>
                <td class="type">
                    <select name="post_type">
                    <?
                        while ($row = mysqli_fetch_array($res)) {
                            echo "<option value='{$row['type']}'>{$row['type']}</option>";
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="post_title">제목</label></th>
                <td class="title"><input type="text" name="post_title" id="post_title"></td>
            </tr>
            <tr>
                <th scope="row"><label for="post_content">내용</label></th>
                <td class="content"><textarea style="height:300px" name= "post_content" id="post_content"></textarea></td>
            </tr>
        </tbody>
    </table>
    <div style="float:right;">
        <button type="submit" class="btnSubmit btn">작성</button>
    </div>
</form>
</div>
<?php include ("footer.php"); ?>