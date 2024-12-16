<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="you-qr-result"></div>
    <h1>Scanner</h1>
    <div style="display: flex; justify-content: center;">
        <div id="my-qr-reader" style="width:500px;">

        </div>
    </div>

    <!-- LOAD LIBRARY -->
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
                    alert("your qr is : " + decodeText,decodeResult)
                    myqr.innerHTML = ` you scan ${countResults} : ${decodeText}`
                }
            }
            // AND LAST RENDER YOUR CAMERA QR
            var htmlscanner = new Html5QrcodeScanner(
                "my-qr-reader",{fps:10,qrbox:250})

                htmlscanner.render(onScanSuccess)
        })
    </script>
</body>
</html>