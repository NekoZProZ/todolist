<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Absen</h4>
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
                                <h5 class="card-title">Absen</h5>
                                <div class="table-responsive">
                                <!-- <a href="<?= base_url('home/tambah_barang')?>">
                                          <button type="button" class="btn btn-success m-2">Absen</button>
                                          </a> -->
                                          <div id="my-qr-reader" style="width:500px;">

        </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                    <div class="modal-dialog" role="document ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Bayar sesuai dengan harganya
                                                <li>No. Virtual Account BCA : 123456789</li>
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

            <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        // CHECK IF DOM IS READY
        function domReady(fn) {
            if (document.readyState === "complete" || document.readyState === "interactive") {
                setTimeout(fn,1)
            }else{
                document.addEventListener("DOMContentLoaded",fn)
            }
        }

        domReady(function() {
            var myqr = document.getElementById('you-qr-result')
            var lastResult,countResults = 0;

            // IF FOUND YOUR QR
            function onScanSuccess(decodeText,decodeResult) {
                if (decodeText !== lastResult) {
                    ++countResults;
                    lastResult = decodeText;

                    // ALERT YOUR QR CODE
                    // alert("your qr is : " + decodeText,decodeResult)
                    // myqr.innerHTML = ` you scan ${countResults} : ${decodeText}`
                    // Send the data to the server via AJAX
                fetch('/home/aksi_absensi', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        decodeText: decodeText,
                        decodeResult: decodeResult
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Success:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                alert("Absensi Berhasil")
                }
            }
            // AND LAST RENDER YOUR CAMERA QR
            var htmlscanner = new Html5QrcodeScanner(
                "my-qr-reader",{fps:10,qrbox:250})

                htmlscanner.render(onScanSuccess)
        })
    </script>




            



