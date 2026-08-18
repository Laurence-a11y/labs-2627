<?php
// ========================================
// PDF, AUDIO, IMAGE, AND VIDEO FILE UPLOAD HANDLER - combined from pdf-file-upload, audio-file-upload, image-file-upload, and video-file-upload branches
// This file processes and displays .pdf, .mp3, image, and .mp4 files
// ========================================

$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

ob_start();

// Handle PDF File
if (!empty($_FILES['pdf_file']['name'])) {
    $uploaded_pdf_file = $upload_directory . basename($_FILES['pdf_file']['name']);
    $temporary_pdf_file = $_FILES['pdf_file']['tmp_name'];

    if (move_uploaded_file($temporary_pdf_file, $uploaded_pdf_file)) {
        $pdf_relative = $relative_path . basename($_FILES['pdf_file']['name']);
        ?>
        <div class="result-card">
            <h3>PDF File</h3>
            <embed src="<?php echo $pdf_relative; ?>" width="100%" height="500" type="application/pdf">
        </div>
        <?php
    } else {
        echo '<p class="error">Failed to upload PDF file</p>';
    }
}

// Handle Audio File
if (!empty($_FILES['audio_file']['name'])) {
    $uploaded_audio_file = $upload_directory . basename($_FILES['audio_file']['name']);
    $temporary_audio_file = $_FILES['audio_file']['tmp_name'];

    if (move_uploaded_file($temporary_audio_file, $uploaded_audio_file)) {
        $audio_relative = $relative_path . basename($_FILES['audio_file']['name']);
        ?>
        <div class="result-card">
            <h3>Audio File</h3>
            <audio controls>
                <source src="<?php echo $audio_relative; ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
        <?php
    } else {
        echo '<p class="error">Failed to upload audio file</p>';
    }
}

// Handle Image File
if (!empty($_FILES['image_file']['name'])) {
    $uploaded_image_file = $upload_directory . basename($_FILES['image_file']['name']);
    $temporary_image_file = $_FILES['image_file']['tmp_name'];

    if (move_uploaded_file($temporary_image_file, $uploaded_image_file)) {
        $image_relative = $relative_path . basename($_FILES['image_file']['name']);
        ?>
        <div class="result-card">
            <h3>Image File</h3>
            <img src="<?php echo $image_relative; ?>" alt="Uploaded image">
        </div>
        <?php
    } else {
        echo '<p class="error">Failed to upload image file</p>';
    }
}

// Handle Video File
if (!empty($_FILES['video_file']['name'])) {
    $uploaded_video_file = $upload_directory . basename($_FILES['video_file']['name']);
    $temporary_video_file = $_FILES['video_file']['tmp_name'];

    if (move_uploaded_file($temporary_video_file, $uploaded_video_file)) {
        $video_relative = $relative_path . basename($_FILES['video_file']['name']);
        ?>
        <div class="result-card">
            <h3>Video File</h3>
            <video width="100%" controls>
                <source src="<?php echo $video_relative; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <?php
    } else {
        echo '<p class="error">Failed to upload video file</p>';
    }
}

$results = ob_get_clean();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Uploaded Files</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: #0d0d0d;
            color: #e6e6e6;
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 40px 20px;
        }
        .container { max-width: 900px; margin: 0 auto; }
        h4 {
            display: inline-block;
            color: #fff;
            border-bottom: 2px solid #ff1e3c;
            padding-bottom: 10px;
            margin-bottom: 30px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .result-card {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-left: 4px solid #ff1e3c;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .result-card h3 {
            color: #ff1e3c;
            margin-bottom: 12px;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        embed, img, video { border-radius: 6px; border: 2px solid #ff1e3c; max-width: 100%; }
        audio { width: 100%; margin-top: 5px; }
        .error { color: #ff1e3c; font-weight: bold; margin-bottom: 15px; }
        a.back-link {
            color: #ff1e3c;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            border: 1px solid #ff1e3c;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background .2s, color .2s;
        }
        a.back-link:hover { background: #ff1e3c; color: #fff; }
        pre {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 6px;
            padding: 15px;
            overflow: auto;
            color: #999;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <h4>Uploaded Files</h4>
    <?php echo $results; ?>
    <a class="back-link" href="index.php">&larr; Upload More Files</a>
    <pre><?php var_dump($_FILES); ?></pre>
</div>
</body>
</html>