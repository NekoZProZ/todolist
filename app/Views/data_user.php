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
                                <h5 class="card-title">Data User</h5>
                                <div class="table-responsive">
                                <a href="<?= base_url('home/tambah_user')?>">
                                          <button type="button" class="btn btn-success m-2">Tambah</button>
                                          </a>
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Level</th>
                                                <th>Aksi</th>
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
                                        <td><?= $nelson->username ?></td>
                                        <td><?= $nelson->level ?></td>
                                        <td>
                                          <a href="<?= base_url('home/edit_user/'.$nelson->id_user)?>">
                                          <button type="button" class="btn btn-info m-2">Edit</button>
                                          </a>
                                          <a href="<?= base_url('home/delete_user/'.$nelson->id_user)?>">
                                          <button type="button" class="btn btn-danger m-2">Delete</button>
                                          </a>
                                        </td>
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




            



