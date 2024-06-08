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
                                <div class="ibox-title">Chat</div>
                            </div>
                            <div class="ibox-body">
                                
                                        <?php
            $no=1;
            foreach ($nelson as $clara ) {
?>
                                        <p><?= $clara->user ?> : <?= $clara->chat ?></p>
                                            
                                        <?php } ?>
                                    
                            </div>
                            <li class="dropdown-divider"></li>
                            <div class="ibox-body">
                                <form action="<?= base_url('home/aksi_send/'.$group) ?>" method="post">
                                    <input class="form-control" style="width: 20%;" type="text" name="nama" placeholder="Nama" autocomplete="off" value="<?=session()->get('nama')?>" readonly>
                                    <input class="form-control" type="text" name="chat" placeholder="Text" autocomplete="off">
                                    <button class="btn btn-info" type="submit">Send</button>
                                </form>
                                <?php if (session()->get('per')=='dokter') { ?>
                                    <a href="<?= base_url('home/tutup/'.$group)?>">
                                        <button class="btn btn-danger">Tutup</button>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
                
                
                
            </div>
            