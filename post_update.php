<?php
include "config.php";    //데이터베이스 연결 설정파일
include "common.php";
$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$post_id = $_GET['post_id'];

$post_pw = $_POST['post_pw'];
$post_title = $_POST['post_title'];
$post_content = $_POST['post_content'];

$cmp = mysqli_query($conn, "select count(*) as cnt from post where post_id = '$post_id' and 
                            post_pw = password('$post_pw')");

$cmp_str = mysqli_fetch_assoc($cmp);
if($cmp_str['cnt'] == 0)
{
    echo "<script>alert(\"비밀번호가 일치하지 않습니다.\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=free_board.php'>";
}
else
{
    $upd = mysqli_query($conn, "update post SET post_title='$post_title', post_content='$post_content' where post_id = '$post_id'");
    if(!$upd)
    {
        echo mysqli_error($conn);
        msg('Query Error : '.mysqli_error($conn));
    }
    else
    {
        echo "<meta http-equiv='refresh' content='0;url=free_board.php'>";
    }
}
?>
