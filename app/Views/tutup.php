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
                                <div class="ibox-title">Transaksi</div>
                            </div>
                            
                            <div class="ibox-body">
                                <form action="<?= base_url('home/aksi_tutup/'.$group) ?>" method="post">
                                    <div class="form-group">
                                        <div class="input-group-icon right">
                                            <input class="form-control" type="number" name="biaya" placeholder="Biaya Konsultasi" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group-icon right">
                                            <input class="form-control" type="text" name="keterangan" placeholder="Keterangan">
                                        </div>
                                    </div>
                                    <button class="btn btn-info" type="submit">Send</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
                
                
                
            </div>
            