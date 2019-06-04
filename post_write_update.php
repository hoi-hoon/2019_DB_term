<?php include ("header.php"); ?>
<?php include ("config.php"); ?>
<?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $post_id = $_GET["post_id"];
    $query = "select * from post where post_id = $post_id";

    $res = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($res);

    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
?>
<div class='container'>

<form action="post_update.php?post_id=<?php echo $post_id ?>" method="post">
    <table style="width:100%">
        <caption>글 수정하기</caption>
        <tbody>
            <tr>
                <th scope="row"><label for="post_author">글쓴이</label></th>
                <td class="author"><input type="text" name="post_author" id="post_author" disabled value="<?php echo $post['post_author']?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="post_pw">비밀번호</label></th>
                <td class="pw"><input type="password" name="post_pw" id="post_pw"></td>
            </tr>
            <tr>
                <th scope="row"><label for="post_title">제목</label></th>
                <td class="title"><input type="text" name="post_title" id="post_title" value="<?php echo $post['post_title']?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="post_content">내용</label></th>
                <td class="content"><textarea style="height:300px" name= "post_content" id="post_content"><?php echo $post['post_content']?></textarea></td>
            </tr>
        </tbody>
    </table>
    <div name= "post_id" id="post_id" value="post_id" style="display:none;"></div>
    <div style="float:right;">
        <button type="submit" class="btnSubmit btn">수정</button>
    </div>
</form>
</div>
<?php include ("footer.php"); ?>