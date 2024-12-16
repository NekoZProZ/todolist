<?php
require_once APPPATH . 'Libraries/phpqrcode/qrlib.php';

function generateQRCode($data, $filePath = null, $size = 10, $margin = 2) {
    if (!$filePath) {
        $filePath = ROOTPATH . 'public/qr/' . uniqid('qrcode_', true) . '.png';
    }
    \QRcode::png($data, $filePath, QR_ECLEVEL_L, $size, $margin);
    return $filePath;
}
