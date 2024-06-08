<div class="content-wrapper">
<!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Cari Dokter</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Data Dokter</div>
                            </div>
                            <div class="ibox-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Tingkat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
            $no=1;
            foreach ($nelson as $clara ) {
?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $clara->id_dokter ?></td>
                                            <td><?= $clara->nama ?></td>
                                            <td><?= $clara->tingkat ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Pilih Dokter</div>
                            </div>
                            <div class="ibox-body">
                                <form class="form-inline" action="<?= base_url('home/aksi_cari') ?>" method="post">
                            <label class="sr-only" for="ex-email">Dokter</label>
                            <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-email" name="id_dokter" type="Text" placeholder="ID Dokter">
                            <label class="sr-only" for="ex-email">Pasien</label>
                            <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-email" name="id_pasien" type="Text" value="<?=session()->get('id')?>" readonly>
                            
                            <button class="btn btn-success" type="submit">Pilih</button>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                
                
                
            </div>
            