<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $nama = $_POST['nama'];
    $district = $_POST['district'];
    $kecamatan = $_POST['kecamatan'];
    $alamat = $_POST['alamat'];
    $pmotor = $_POST['parkir_motor'];
    $pmobil = $_POST['parkir_mobil'];

    $sql = "INSERT INTO tempat (namatempat,latitude,longitude,jalan,kecamatan,kabupaten,provinsi,fee_parkir_motor,fee_parkir_mobil) 
    VALUES ('" . $nama . "', " . $lat . ", " . $long . ", '" . $alamat . "', '" . $kecamatan . "', '" . $district . "', 'Jawa Barat', " . $pmotor . " , " . $pmobil . "); ";
    if (mysqli_query($conn, $sql)) {
        echo  '<script>alert("Data berhasil ditambahkan")</script>';
    } else {
        echo  '<script>alert("Error: ' . $sql . ' <br>' . mysqli_error($conn) . ' ")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
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
            justify-content: space-around;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>
                    <button type="button" id="myBtn">Tambah Data</button>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nama Mall</th>
                                        <th>Alamat Lengkap</th>
                                        <th>Kota / Kabupaten</th>
                                        <th>Kecamatan</th>
                                        <th>Parkir Motor per Jam</th>
                                        <th>Parkir Mobil per Jam</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getData = $conn->query("SELECT * FROM tempat");
                                    while ($result = $getData->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $result['namatempat'] ?></td>
                                            <td><?php echo $result['jalan'] ?></td>
                                            <td><?php echo $result['kabupaten'] ?></td>
                                            <td><?php echo $result['kecamatan'] ?></td>
                                            <td><?php echo $result['fee_parkir_motor'] ?></td>
                                            <td><?php echo $result['fee_parkir_mobil'] ?></td>
                                            <td><?php echo $result['latitude'] ?></td>
                                            <td><?php echo $result['longitude'] ?></td>
                                            <td>
                                                <a href="edit.php?id=<?php echo $result['id']; ?>"><button>Edit</button></a>
                                                <a href="delete.php?id=<?php echo $result['id']; ?>"><button>Delete</button></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="tables.php" method="POST">
                <div class="flex-row">
                    <p><label for="">Latitude</label><br>
                        <input type="text" name="lat">
                    </p>
                    <p><label for="">Longitude</label><br>
                        <input type="text" name="long">
                    </p>
                </div>
                <div class="flex-row">
                    <p><label for="">Nama Mall</label><br>
                        <input type="text" name="nama">
                    </p>
                    <p><label for="">Kota/Kabupaten</label><br>
                        <input type="text" name="district">
                    </p>
                </div>
                <p style="margin-left: 42px;"><label for="">Kecamatan</label><br>
                    <input type="text" name="kecamatan">
                </p>
                <p style="margin-left: 42px;"><label for="">Alamat Lengkap</label><br>
                    <textarea type="text" name="alamat"></textarea>
                </p>
                <div class="flex-row">
                    <p><label for="">Parkir Motor per Jam</label><br>
                        <input type="text" name="parkir_motor">
                    </p>
                    <p><label for="">Parkir Mobil per Jam</label><br>
                        <input type="text" name="parkir_mobil">
                    </p>
                </div>
                <button name="submit">Submit</button>
            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>