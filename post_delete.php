<?php include ("config.php"); 
$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$post_id = $_GET['post_id'];
$post_pw = $_GET['post_pw'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

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
    if(!$ret){
        mysqli_query($conn, "rollback"); // query 수행 실패. 수행 전으로 rollback
	    echo mysqli_error($conn);
        msg('Query Error : '.mysqli_error($conn));
    }
    else{
        mysqli_query($conn, "commit"); // query 수행 성공. 수행 내역 commit
        echo "<script>alert(\"글이 삭제되었습니다.\");</script>";
        echo "<meta http-equiv='refresh' content='0;url=free_board.php'>";
    }
}

?>
