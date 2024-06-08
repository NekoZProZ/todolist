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
                                <div class="ibox-title">List Transaksi</div>
                            </div>
                            <div class="ibox-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pasien</th>
                                            <th>Keterangan</th>
                                            <th>Waktu</th>
                                            <th>Harga</th>
                                            <th>Bayar</th>
                                            <th>Kembalian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
            $no=1;
            foreach ($nelson as $clara ) {
?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $clara->nama ?></td>
                                            <td><?= $clara->keterangan ?></td>
                                            <td><?= $clara->waktu ?></td>
                                            <td><?= $clara->harga ?></td>
                                            <td><?= $clara->bayar ?></td>
                                            <td><?= $clara->kembalian ?></td>
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
            