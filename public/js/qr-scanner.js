document.addEventListener("DOMContentLoaded", function () {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    
    scanner.addListener('scan', function (content) {
        alert('QR Code Terdeteksi: ' + content);
        window.location.href = content; // Redirect ke URL dari QR Code
    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('Tidak ada kamera yang terdeteksi');
        }
    }).catch(function (e) {
        console.error(e);
    });
});
