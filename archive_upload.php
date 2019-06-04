<?php include ("header.php"); ?>
<?php include ("config.php"); ?>
<?php
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$query = "select * from course";
$res = mysqli_query($conn, $query);

?>
<div class='container'>
    <form name="uploadForm" id="uploadForm" method="post" action="archive_upload_process.php" enctype="multipart/form-data">
        <div>
            <label for="uploader">작성자</label>
            <input type="text" name="uploader" id="uploader" />
            <br>
            <label for="course_name">과목</label>
            <select name="course_name">
                        <?
                            while ($row = mysqli_fetch_array($res)) {
                                echo "<option value='{$row['course_name']}'>{$row['course_name']}</option>";
                            }
                        ?>
            </select>
            <br>
            <label for="upfile">첨부파일</label>
            <input type="file" name="upfile" id="upfile" />
        </div>
        <input style="float:right;"type="submit" value="업로드" />
    </form>
</div>
<?php include ("footer.php"); ?>