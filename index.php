<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Message App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .key-container {
            width: 100vw;
            height: 100vh;
            background-image: linear-gradient(#FF71CD, #8B93FF);
        }

        .key-form-container {
            background-color: white;
            box-shadow: 4px 4px 11px 2px #ddddddb3;
            border-radius: 10px;
            padding: 40px;
        }

        .form-control {
            border: none !important;
            border-radius: 0px!important;
            outline: none !important;
            border-bottom: 1px solid #dee2e6!important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="key-container d-flex flex-column justify-content-center align-items-center">
        <div class="key-form-container">
            <h3 class="text-center mb-3">Welcome to Secure Message App</h3>
            <div>
                <a href="/routes/web.php?page=set-key" class="btn btn-primary">Set Key</a>
                <a href="/routes/web.php?page=send-message" class="btn btn-primary">Send Message</a>
                <a href="/routes/web.php?page=read-messages" class="btn btn-primary">Read Message</a>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
