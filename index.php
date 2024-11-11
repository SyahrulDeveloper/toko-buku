<?php
require 'function.php';
require 'cek.php';
$buku = query("SELECT * FROM buku");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="MuhammadSyahrulRamadhan_2310512153" content="" />
        <title>Data Buku</title>
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
                        <h1 class="mt-4">Data Buku</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Buku Baru
                            </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul Buku</th>
                                                <th>Foto</th>
                                                <th>Isbn</th>
                                                <th>Tahun Terbit</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Nama Publisher</th>
                                                <th>Nama Penulis</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach( $buku as $row ) : ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $row["judul_buku"]?></td>
                                                <td><?= $row["foto"]?></td>
                                                <td><?= $row["isbn"]?></td>
                                                <td><?= $row["tahun_terbit"]?></td>
                                                <td><?= $row["harga"]?></td>
                                                <td><?= $row["stok"]?></td>
                                                <td><?= $row["nama_publisher"]?></td>
                                                <td><?= $row["nama_penulis"]?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning mb-2 mr-2" data-toggle="modal" data-target="#updatebuku<?= $row["id_buku"]?>">Update</button>
                                                    <input type="hidden" name="idbukuyangdihapus" value="<?= $row["id_buku"]?>">
                                                    <button type="button" class="btn btn-danger mb-2 mr-2" data-toggle="modal" data-target="#deletebuku<?= $row["id_buku"]?>">Delete</button>
                                                </td>
                                            </tr>
                                             <!-- Update Modal -->
                                            <div class="modal fade" id="updatebuku<?= $row["id_buku"]?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Update Buku</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" name="judul_buku" value="<?= $row["judul_buku"]?>" class="form-control w-100" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <input type="text" name="foto" value="<?= $row["foto"]?>" class="form-control w-100"  required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <input type="text" name="isbn" value="<?= $row["isbn"]?>" class="form-control w-100"  required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <input type="number" name="tahun_terbit" value="<?= $row["tahun_terbit"]?>" class="form-control w-100"  required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <input type="number" name="harga" value="<?= $row["harga"]?>" class="form-control w-100"  required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <input type="number" name="stok" value="<?= $row["stok"]?>" class="form-control w-100"  required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <select type="text" name="nama_publisher" value="<?= $row["nama_publisher"]?>" class="form-control w-100"  required>
                                                                        <option value=""><?= $row["nama_publisher"]?></option>
                                                                        <?php
                                                                        $query = mysqli_query($koneksi, "SELECT * FROM publisher");
                                                                        while($data =mysqli_fetch_assoc($query)) {
                                                                            echo "<option value=$data[nama_publisher]> $data[nama_publisher] </option>";
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <select type="text" name="nama_penulis" value="<?= $row["nama_penulis"]?>" class="form-control w-100"  required>
                                                                            <option value=""><?= $row["nama_penulis"]?></option>
                                                                            <?php
                                                                                $query = mysqli_query($koneksi, "SELECT * FROM penulis");
                                                                                while($data =mysqli_fetch_assoc($query)) {
                                                                                echo "<option value=$data[nama_penulis]> $data[nama_penulis] </option>";
                                                                                }
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                                    <input type="hidden" name="id_buku" value="<?= $row["id_buku"]?>">
                                                                    <button type="submit" class="btn btn-primary" name="updatebuku">Submit</button>
                                                            </div>
                                                    </form>
                                                  </div>
                                                </div>
                                            </div>

                                             <!-- Delete Modal -->
                                            <div class="modal fade" id="deletebuku<?= $row["id_buku"]?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Buku?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="POST">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus <?= $row["judul_buku"] ?>?
                                                                <input type="hidden" name="id_buku" value="<?= $row["id_buku"]?>">
                                                                <button type="submit" class="btn btn-danger mt-3 mb-3" name="deletebuku">Hapus</button>
                                                            </div>
                                                    </form>
                                                  </div>
                                                </div>
                                            </div>
                                            <?php $no++; ?>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
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
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
    <!-- Insert Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Buku</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
         <form method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <input type="text" name="judul_buku" placeholder="Judul Buku" class="form-control w-100" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="foto" placeholder="Upload" class="form-control w-100"  required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="isbn" placeholder="Isbn" class="form-control w-100"  required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" class="form-control w-100"  required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="harga" placeholder="Harga" class="form-control w-100"  required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="stok" placeholder="Stok" class="form-control w-100"  required>
                    </div>
                    <div class="form-group mb-3">
                        <select type="text" name="nama_publisher" value="<?= $row["nama_publisher"]?>" class="form-control w-100"  required>
                                <option value="">---</option>
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM publisher");
                                    while($data =mysqli_fetch_assoc($query)) {
                                    echo "<option value=$data[nama_publisher]> $data[nama_publisher] </option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select type="text" name="nama_penulis" value="<?= $row["nama_penulis"]?>" class="form-control w-100"  required>
                                <option value="">---</option>
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM penulis");
                                    while($data =mysqli_fetch_assoc($query)) {
                                    echo "<option value=$data[nama_penulis]> $data[nama_penulis] </option>";
                                    }
                                ?>
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary" name="tambahbuku">Submit</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</html>
