<?php
require 'function.php';
require 'cek.php';
$publisher = query1("SELECT * FROM publisher");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="MuhammadSyahrulRamadhan_2310512153" content="" />
        <title>Data Publisher</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="index.php">Toko Buku</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Buku
                            </a>
                            <a class="nav-link" href="publisher.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Publisher
                            </a>
                            <a class="nav-link" href="penulis.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Penulis
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Publisher</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Publisher Baru
                               </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Publisher</th>
                                                <th>Alamat</th>
                                                <th>Tahun Berdiri</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach($publisher as $row_pub) : ?>
                                            <?php 
                                                $tanggal_mentah = strtotime($row_pub['tahun_berdiri']);
                                                $tgl_fix = date("d - m - Y", $tanggal_mentah);
                                            ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $row_pub["nama_publisher"] ?></td>
                                                <td><?= $row_pub["alamat"] ?></td>
                                                <td><?= $tgl_fix; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning mb-2 mr-2" data-toggle="modal" data-target="#updatepublisher<?= $row_pub["id_publisher"]?>">Update</button>
                                                    <input type="hidden" name="idpublisheryangdihapus" value="<?= $row_pub["id_publisher"]?>">
                                                    <button type="button" class="btn btn-danger mb-2 mr-2" data-toggle="modal" data-target="#deletepublisher<?= $row_pub["id_publisher"]?>">Delete</button>
                                                </td>
                                            </tr>
                                            <!-- Update Modal -->
                                            <div class="modal fade" id="updatepublisher<?= $row_pub["id_publisher"]?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Publisher</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" name="nama_publisher" value="<?= $row_pub["nama_publisher"]?>" class="form-control w-100" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <input type="text" name="alamat" value="<?= $row_pub["alamat"]?>" class="form-control w-100" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <input type="date" name="tahun_berdiri" value="<?= $row_pub["tahun_berdiri"]?>" class="form-control w-100" required>
                                                                </div>
                                                                <input type="hidden" name="id_publisher" value="<?= $row_pub["id_publisher"]?>">
                                                                <button type="submit" class="btn btn-primary" name="updatepublisher">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                             <!-- Delete Modal -->
                                            <div class="modal fade" id="deletepublisher<?= $row_pub["id_publisher"]?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Publisher?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="POST">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus <?= $row_pub["nama_publisher"] ?>?
                                                                <input type="hidden" name="id_publisher" value="<?= $row_pub["id_publisher"]?>">
                                                                <button type="submit" class="btn btn-danger mt-3 mb-3 ml-3" name="deletepublisher">Hapus</button>
                                                            </div>
                                                    </form>
                                                  </div>
                                                </div>
                                            </div>
                                            <?php $no++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Footer -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2310512153_Muhammad Syahrul Ramadhan 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
    <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Publisher</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <form method="POST">
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <input type="text" name="nama_publisher" placeholder="Nama Publisher" class="form-control w-100" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="alamat" placeholder="Alamat" class="form-control w-100" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="date" name="tahun_berdiri" class="form-control w-100" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="tambahpublisher">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</html>