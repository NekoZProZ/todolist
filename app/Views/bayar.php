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
                                <div class="ibox-title">Bayar</div>
                            </div>
                            
                            
                            <div class="ibox-body">
                                <form action="<?= base_url('home/aksi_bayar/'.$tran) ?>" method="post">
                                    <div class="form-group">
                                        <div class="input-group-icon right">
                                            Waktu
                                            <input class="form-control" type="text" name="biaya" placeholder="Biaya Konsultasi" value="<?= $nelson->waktu ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group-icon right">
                                            Keterangan
                                            <input class="form-control" type="text" name="biaya" placeholder="Biaya Konsultasi" value="<?= $nelson->keterangan ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group-icon right">
                                            Harga
                                            <input class="form-control" type="number" name="biaya" placeholder="Biaya Konsultasi" value="<?= $nelson->harga ?>" autocomplete="off" id="harga" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group-icon right">
                                            Bayar
                                            <input class="form-control" type="number" name="bayar" placeholder="Bayar" autocomplete="off" onchange="kembalianganti()" id="bayar">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group-icon right">
                                            Kembalian
                                            <input class="form-control" type="number" name="kembalian" placeholder="Kembalian" autocomplete="off" id="kembalian" readonly>
                                        </div>
                                    </div>
                                    <button class="btn btn-info" type="submit">Bayar</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
                
                
                
            </div>
            <script>
                function kembalianganti() {
    const hargainput = document.getElementById("harga");
    const bayarinput = document.getElementById("bayar");
    const kembalianinput = document.getElementById("kembalian");

    const harga = hargainput.value;
    const bayar = bayarinput.value;
    const akhir = bayar - harga;

    //if (akhir !== undefined) {
      kembalianinput.value = akhir;
    // } else {
    //   kembalianinput.value = ''; // Clear the harga obat if the nama obat is not found
    // }
  }
            </script>