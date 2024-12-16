<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Data User</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Data Barang</h5>
                                <div class="table-responsive">
                                <!-- <a href="<?= base_url('home/tambah_barang')?>">
                                          <button type="button" class="btn btn-success m-2">Tambah</button>
                                          </a> -->
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama User</th>
                                                <th>Waktu Absen</th>
                                                <!-- <th>Harga Akhir</th>
                                                <th>Nama Petugas</th>
                                                <th>Status</th>
                                                <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
      $no=1;
      foreach ($clara as $nelson ) {
?>
                                            <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $nelson->nama_user ?></td>
                                        <td><?php if (is_null($nelson->waktu_absen)): ?>
        <!-- Leave it empty if the data is null -->
    <?php else: ?>
        <?php
        $time = new DateTime($nelson->waktu_absen); // Convert waktu_absen to DateTime object
        $cutoffTime = new DateTime(date('Y-m-d') . ' 07:30:00'); // Set the cutoff time
        ?>

        <?php if ($time > $cutoffTime): ?>
            <span style="color: red;">
                <?= $nelson->waktu_absen ?> (terlambat)
            </span>
        <?php else: ?>
            <?= $nelson->waktu_absen ?>
        <?php endif; ?>
    <?php endif; ?></td>
                                        
                                    </tr>
                                    <?php } ?>
                                            
                                        </tbody>
                                        
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->




            



