<!-- Other Elements Start -->
<style>
        .form-control {
            width: 50%;
        }
        .form-select {
            width: 50%;
        }
        
    </style>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    
                    
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            
                            
                            
                                
                            <form id="myForm" action="<?= base_url('home/aksi_bayar/'.$clara->sewa_id) ?>" method="post">
                        <div class="form-floating mb-3">
                            Nomor Kendaraan = <?= $clara->nomor_kendaraan ?><br>
                            Tipe Kendaraan = <?= $clara->tipe_kendaraan ?><br>
                            Warna Kendaraan = <?= $clara->warna_kendaraan ?><br>
                            Harga Kendaraan = <?= $clara->harga_kendaraan ?><br>
                            Lama Sewa = <?= $clara->lama_sewa ?><br>
                            Total Harga = <?= $clara->total_harga ?><br>
                            Status = <?= $clara->status ?>
                        </div>

                        <input type="text" class="form-control" id="total_harga" value="<?= $clara->total_harga ?>" hidden>
                        
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="bayar" name="bayar" min="0" oninput="updateHarga()">
                            <label for="floatingPassword">Bayar</label>
                        </div>
                        
                            <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="kembalian" name="kembalian" readonly>
                            <label for="floatingPassword">Kembalian</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            
                            
                        </div>
                        <button type="submit" class="btn btn-primary m-2">Bayar</button>
                        </form>
                                
                                
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Other Elements End -->
            <script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        const kembalianInput = document.getElementById('kembalian');
        const kembalianValue = parseFloat(kembalianInput.value);

        if (kembalianValue < 0) {
            event.preventDefault(); // Prevent form submission
            alert('Kembalian Tidak Boleh Negative');
        }
    });
</script>
<script>

  function updateHarga() {
    const total_harga = document.getElementById("total_harga");
    const total_hargaValue = parseFloat(total_harga.value);
    const bayar = document.getElementById("bayar");
    const bayarValue = parseFloat(bayar.value);
    //const lama = document.getElementById("lama");
    const kembalian = document.getElementById("kembalian");
    //console.log("Selected harga:", harga);

    const akhir = bayarValue - total_hargaValue;


    if (akhir !== undefined) {
      kembalian.value = akhir;
    } else {
      kembalian.value = ''; // Clear the harga obat if the nama obat is not found
    }
  }



</script>