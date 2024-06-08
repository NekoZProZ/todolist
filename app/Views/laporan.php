<div class="content-wrapper">
<!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Laporan</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Laporan Excel</div>
                            </div>
                            <div class="ibox-body">
                                <form id="login-form" action="<?= base_url('home/print_excel') ?>" method="post">
                                <label class="font-normal">Tanggal Dari</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="text" name="tgl_darie" value="2024-05-24">
                                    </div>
                                <label class="font-normal">Tanggal Sampai</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="text" name="tgl_sampe" value="2024-05-24">
                                    </div>
                                    <div style="margin-top: 5%;"><button class="btn btn-info btn-block" type="submit">Print</button></div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Laporan Print</div>
                            </div>
                            <div class="ibox-body">
                                <form id="login-form" action="<?= base_url('home/print_print') ?>" method="post">
                                <label class="font-normal">Tanggal Dari</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="text" name="tgl_darip" value="2024-05-24">
                                    </div>
                                <label class="font-normal">Tanggal Sampai</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="text" name="tgl_sampp" value="2024-05-24">
                                    </div>
                                    <div style="margin-top: 5%;"><button class="btn btn-info btn-block" type="submit">Print</button></div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Laporan PDF</div>
                            </div>
                            <div class="ibox-body">
                                <form id="login-form" action="<?= base_url('home/print_pdf') ?>" method="post">
                                <label class="font-normal">Tanggal Dari</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="text" name="tgl_darif" value="2024-05-24">
                                    </div>
                                <label class="font-normal">Tanggal Sampai</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="text" name="tgl_sampf" value="2024-05-24">
                                    </div>
                                    <div style="margin-top: 5%;"><button class="btn btn-info btn-block" type="submit">Print</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
                
                
                
            </div>
