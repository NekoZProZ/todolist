
<!-- START PAGE CONTENT-->
            
                                <div class="ibox-title">List Transaksi</div>
                            
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
                            

            