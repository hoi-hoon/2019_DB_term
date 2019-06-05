<?php
include "config.php";    //데이터베이스 연결 설정파일

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$post_author = $_POST['post_author'];
$post_pw = $_POST['post_pw'];
$post_title = $_POST['post_title'];
$post_content = $_POST['post_content'];
$post_type = $_POST['post_type'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "insert into post (post_author, post_pw, post_title, post_content, post_type, post_date) 
        values('$post_author', password('$post_pw'), '$post_title', '$post_content', '$post_type',NOW())");

if(!$ret)
{
    mysqli_query($conn, "rollback"); // query 수행 실패. 수행 전으로 rollback
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    mysqli_query($conn, "commit"); // query 수행 성공. 수행 내역 commit
    echo "<meta http-equiv='refresh' content='0;url=free_board.php'>";
}

?>

