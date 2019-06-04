<?php include ("header.php"); ?>
<?php include ("config.php"); ?>
<div class='container'>
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from archive";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
        <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>과목</th>
            <th>글쓴이</th>
            <th>파일이름</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['related_course']}</td>";
            echo "<td>{$row['uploader']}</td>";
            echo "<td><a href='archive_download.php?filename={$row['name_og']}'>{$row['name_og']}</a></td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
        <a href='archive_upload.php'><button class='button primary small'>자료업로드</button></a>
        </table>
</div>
<?php include ("footer.php"); ?>