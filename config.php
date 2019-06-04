<?php
    $host = "localhost";
    $dbid = "db2015410038";                    // 자신의 DB ID
    $dbpass = "wjdghlgns95@naver.com";                  // 자신의 DB Password
    $dbname = "db2015410038";                  // 해당 프로젝트에서 사용하는 DB명

    function dbconnect($host, $id, $pass, $db)  //데이터베이스 연결
    {
    $conn = mysqli_connect($host, $id, $pass, $db);

    if ($conn == false) {
        die('Not connected : ' . mysqli_error());
    }

    return $conn;
    }
?>