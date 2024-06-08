<div class="content-wrapper">
<!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Konsultasi</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">List Chat</div>
                            </div>
                            <div class="ibox-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
            $no=1;
            foreach ($nelson as $clara ) {
?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $clara->nama_pasien ?></td>
                                            <td><?= $clara->nama_dokter ?></td>
                                            <td>
                                                <a href="<?= base_url('home/chat/'.$clara->id_group)?>">
                                                    <button class="btn btn-info">Chat</button>
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
                
                
                
            </div>
            