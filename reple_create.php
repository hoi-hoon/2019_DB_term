<?php
include "config.php";    //데이터베이스 연결 설정파일

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$post_id = $_GET['post_id'];
$reple_author = $_POST['reple_author'];
$reple_content = $_POST['reple_content'];

$ret = mysqli_query($conn, "insert into reple (post_id, reple_author, reple_content, reple_date) 
        values('$post_id', '$reple_author', '$reple_content', NOW())");

if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}

else
{
    echo "<meta http-equiv='refresh' content='0;url=post_view.php?post_id=$post_id'>";
}

?>

