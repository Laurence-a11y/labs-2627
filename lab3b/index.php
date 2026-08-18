<!-- ======================================== -->
<!-- IMAGE FILE UPLOAD ONLY - image-file-upload branch -->
<!-- This version only accepts image files -->
<!-- ======================================== -->
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: #0d0d0d;
            color: #e6e6e6;
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 40px 20px;
        }
        .container { max-width: 900px; margin: 0 auto; }
        .header-wrap { text-align: center; margin-bottom: 40px; }
        .header-wrap img { height: 60px; margin-bottom: 20px; }
        h4 {
            display: inline-block;
            color: #fff;
            border-bottom: 2px solid #ff1e3c;
            padding-bottom: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .card {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-left: 4px solid #ff1e3c;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: border-color .2s, transform .2s;
        }
        .card:hover { border-color: #ff1e3c; transform: translateY(-2px); }
        .card h3 {
            color: #ff1e3c;
            margin-bottom: 12px;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            background: #0d0d0d;
            border: 1px solid #333;
            border-radius: 5px;
            color: #ccc;
        }
        input[type="file"]::file-selector-button {
            background: #ff1e3c;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            margin-right: 12px;
            cursor: pointer;
            transition: background .2s;
        }
        input[type="file"]::file-selector-button:hover { background: #c4001f; }
        button {
            background: #ff1e3c;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            display: block;
            margin: 10px auto 0;
            transition: background .2s;
        }
        button:hover { background: #c4001f; }
        .footer-logo { display: block; margin: 40px auto 0; max-height: 120px; opacity: 0.9; }
    </style>
</head>

<body>
<div class="container">

    <div class="header-wrap">
        <img src="https://www.auf.edu.ph/home/images/logo2.png" alt="Angeles University Foundation">
        <h4>Image File Upload</h4>
    </div>

    <form method="post" action="uploaded.php" enctype="multipart/form-data">

        <!-- This input only accepts image files -->
        <div class="card">
            <h3>Image File</h3>
            <input type="file" name="image_file" accept="image/*" />
        </div>

        <button type="submit">Upload</button>
    </form>

    <img class="footer-logo" src="https://www.auf.edu.ph/home/images/mascot/CCS.png" alt="College of Computing Studies">
</div>
</body>
</html>
