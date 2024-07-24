<!DOCTYPE html>
<html>

<head>
    <title>QR Code Scanner</title>
    <style>
        #reader {
            width: 500px;
            height: 400px;
            margin: auto;
        }

        .button-container {
            text-align: center;
        }
    </style>
    <!-- Include html5-qrcode library -->
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <!-- Include jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="reader"></div>
    <div class="button-container">
        <button id="scanButton">Scan QR Code</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('scanButton').addEventListener('click', function() {
                if (typeof Html5Qrcode === 'undefined') {
                    alert('Html5Qrcode is not loaded. Please check the script URL.');
                    return;
                }

                const html5QrCode = new Html5Qrcode("reader");
                html5QrCode.start({
                            facingMode: "environment"
                        }, // Use rear camera
                        {
                            fps: 10, // Optional, frame per second for qr code scanning
                            qrbox: 250 // Optional, if you want bounded box UI
                        },
                        qrCodeMessage => {
                            // handle the scanned code as you like
                            alert(`QR Code detected: ${qrCodeMessage}`);

                            // AJAX call to store QR code result
                            $.ajax({
                                url: '/qr-code-result',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    result: qrCodeMessage
                                },
                                success: function(response) {
                                    alert(response.success);
                                },
                                error: function(xhr) {
                                    alert('An error occurred while storing the QR code result.');
                                }
                            });

                            html5QrCode.stop().then(ignore => {
                                // QR Code scanning is stopped.
                            }).catch(err => {
                                // Stop failed
                            });
                        },
                        errorMessage => {
                            // parse error
                        })
                    .catch(err => {
                        // Start failed
                    });
            });
        });
    </script>
</body>

</html>