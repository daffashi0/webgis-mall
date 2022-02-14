<?php

include 'config.php';

if (isset($_GET['id'])) {
    $delete = $conn->query("DELETE FROM tempat WHERE id=$_GET[id]");

    if ($delete === TRUE) {
        header("Location: tables.php");
    } else {
        echo '<script>alert("Error")</script>';
    }
}
