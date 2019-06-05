<?php include ("config.php"); ?>
<?
$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$allowed_ext = array('jpg','jpeg','png','gif','txt','pdf');
$name = $_FILES['upfile']['name'];
$uploads_dir = './data/'.$name;

$ext = array_pop(explode('.', $name));

$uploader = $_POST['uploader']; 
$course_name = $_POST['course_name'];

if( !in_array($ext, $allowed_ext) ) {
	echo "<script>alert(\"허용되지 않는 확장자 입니다.\");</script>";
        echo "<meta http-equiv='refresh' content='0;url=archive.php'>";
        exit;
}

$res_m = move_uploaded_file( $_FILES['upfile']['tmp_name'], "$uploads_dir");

if($res_m){
        echo "성공";
       // exit;
}
else{
        echo "실패";
        echo $_FILES['upfile']['tmp_name'];
        echo "에러는";
        echo $_FILES['upfile']['error'];
        exit;
}

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$query = "INSERT INTO archive(uploader,name_og,time,related_course) VALUES('$uploader','$name', NOW(),'$course_name')";
        
$res = mysqli_query($conn, $query);

if(!$res){
        mysqli_query($conn, "rollback"); // query 수행 실패. 수행 전으로 rollback
        echo "<script>alert(\"업로드 실패.\");</script>";
        echo "<meta http-equiv='refresh' content='0;url=archive.php'>";
}
else{
        mysqli_query($conn, "commit"); // query 수행 성공. 수행 내역 commit
        echo "<script>alert(\"업로드 성공.\");</script>";
        echo "<meta http-equiv='refresh' content='0;url=archive.php'>";
}
?>
