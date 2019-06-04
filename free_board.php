<?php include ("header.php"); ?>
<?php include ("config.php"); ?>
<div class='container'>
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from post";

    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where post_title like '%$search_keyword%' or post_author like '%$search_keyword%'";
    }

    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>분류</th>
            <th>제목</th>
            <th>글쓴이</th>
            <th>작성일</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['post_type']}</td>";
            echo "<td><a href='post_view.php?post_id={$row['post_id']}'>{$row['post_title']}</a></td>";
            echo "<td>{$row['post_author']}</td>";
            echo "<td>{$row['post_date']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
        <a href='post_write.php'><button class='button primary small'>글쓰기</button></a>
        <form action="free_board.php" method="post">
            <div style="float:right;">
                <input type="text" name="search_keyword" placeholder="게시글 검색">
            </div>
        </form>
     </table>
</div>
<?php include ("footer.php"); ?>