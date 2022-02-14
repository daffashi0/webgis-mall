<?php

include 'config.php';

$id = $_GET['id'];

if (isset($id)) {
    $getMall = $conn->query("SELECT * FROM tempat WHERE id=$id");
    $dataMall = $getMall->fetch_assoc();
}

if (isset($_POST['edit'])) {

    $update = $conn->query("UPDATE tempat
    SET latitude=$_POST[lat],
    longitude=$_POST[long],
    namatempat='$_POST[nama]',
    kabupaten='$_POST[district]',
    kecamatan='$_POST[kecamatan]',
    jalan='$_POST[alamat]',
    fee_parkir_motor=$_POST[parkir_motor],
    fee_parkir_mobil=$_POST[parkir_mobil]
    WHERE id=$id");

    if ($update === TRUE) {
        header("Location: tables.php");
    } else {
        echo '<script>alert("Error")</script>';
    }
}

?>

<html>

<head>
    <title>Edit Data</title>
    <style>
        .modal {
            display: block;
            position: fixed;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .flex-row {
            display: flex;
            flex-direction: row;
            margin-left: 42px;
        }

        .margin-right {
            margin-right: 200px;
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="edit.php?id=<?php echo $id; ?>" method="POST">
                <div class="flex-row">
                    <p class="margin-right"><label for="">Latitude</label><br>
                        <input type="text" name="lat" value="<?php echo $dataMall['latitude'] ?>">
                    </p>
                    <p><label for="">Longitude</label><br>
                        <input type="text" name="long" value="<?php echo $dataMall['longitude'] ?>">
                    </p>
                </div>
                <div class="flex-row">
                    <p class="margin-right"><label for="">Nama Mall</label><br>
                        <input type="text" name="nama" value="<?php echo $dataMall['namatempat'] ?>">
                    </p>
                    <p><label for="">Kota/Kabupaten</label><br>
                        <input type="text" name="district" value="<?php echo $dataMall['kabupaten'] ?>">
                    </p>
                </div>
                <p style="margin-left: 42px;"><label for="">Kecamatan</label><br>
                    <input type="text" name="kecamatan" value="<?php echo $dataMall['kecamatan'] ?>">
                </p>
                <p style="margin-left: 42px;"><label for="">Alamat Lengkap</label><br>
                    <textarea type="text" name="alamat"><?php echo $dataMall['jalan'] ?></textarea>
                </p>
                <div class="flex-row">
                    <p class="margin-right"><label for="">Parkir Motor per Jam</label><br>
                        <input type="text" name="parkir_motor" value="<?php echo $dataMall['fee_parkir_motor'] ?>">
                    </p>
                    <p><label for="">Parkir Mobil per Jam</label><br>
                        <input type="text" name="parkir_mobil" value="<?php echo $dataMall['fee_parkir_mobil'] ?>">
                    </p>
                </div>
                <center><button name="edit">Edit</button></center>
            </form>
        </div>
</body>

</html>