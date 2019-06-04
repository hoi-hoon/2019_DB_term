<?php include ("config.php"); 
$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$post_id = $_GET['post_id'];
$post_pw = $_GET['post_pw'];

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
    $ret = mysqli_query($conn, "delete from post where post_id = '$post_id'");
    echo "<script>alert(\"글이 삭제되었습니다.\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=free_board.php'>";
}

?>
