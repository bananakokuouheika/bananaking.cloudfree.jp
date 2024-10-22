<?php

$target_dir = "uploads/";

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $successMessage = '';
    $errorMessage = '';
    $messages = [];

    if (isset($_FILES["fileToUpload"]) && is_array($_FILES["fileToUpload"]["error"])) {
        foreach ($_FILES["fileToUpload"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $originalFileName = basename($_FILES["fileToUpload"]["name"][$key]);
                $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
                $target_file = $target_dir . $originalFileName;

                if (file_exists($target_file)) {
                    if (file_get_contents($target_file) == file_get_contents($_FILES["fileToUpload"]["tmp_name"][$key])) {
                        $uploaded_file_url = "http://" . $_SERVER['HTTP_HOST'] . "/" . $target_file;
                        $successMessage .= "ファイル " . $originalFileName . " がアップロードされました。ファイルのURL: <a href='" . $uploaded_file_url . "' target='_blank'>" . $uploaded_file_url . "</a><br>";
                        continue;
                    } else {
                        $i = 1;
                        while (file_exists($target_file)) {
                            $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $i . '.' . $imageFileType;
                            $target_file = $target_dir . $newFileName;
                            $i++;
                        }
                    }
                }

                if ($_FILES["fileToUpload"]["size"][$key] > 50000000) {
                    $messages[] = "ファイル " . $originalFileName . " が大きすぎます。50MB以下のファイルのみ許可されています。";
                    continue;
                }

                $allowed_extensions = array("jpg", "jpeg", "png", "gif", "webp", "svg", "heic", "mp4", "mp3", "m4a", "html", "pdf", "php", "txt");
                if (!in_array($imageFileType, $allowed_extensions)) {
                    $messages[] = "ファイル " . $originalFileName . " は許可された拡張子ではありません。";
                    continue;
                }

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
                    $uploaded_file_url = "http://" . $_SERVER['HTTP_HOST'] . "/" . $target_file;
                    $successMessage .= "ファイル " . basename($target_file) . " がアップロードされました。ファイルのURL: <a href='" . $uploaded_file_url . "' target='_blank'>" . $uploaded_file_url . "</a><br>";
                } else {
                    $messages[] = "ファイル " . basename($target_file) . " のアップロード中にエラーが発生しました。";
                }
            } else {
                $messages[] = "ファイルが選択されていません。";
            }
        }
    } else {
        $errorMessage = "ファイルが選択されていません。";
    }

    if ($messages) {
        $errorMessage = implode("<br>", $messages);
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ファイルアップローダー</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .uploader-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        input[type="file"] {
            display: none;
        }

        .drag-area {
            border: 2px dashed #007bff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .drag-area.dragover {
            background-color: #f0f8ff;
            border-color: #007bff;
        }

        .drag-area.dragdrop {
            background-color: #e6ffed;
            border-color: #28a745;
        }

        .message {
            margin-top: 20px;
            font-size: 14px;
        }

        .message.success {
            color: #28a745;
        }

        .message.error {
            color: #dc3545;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        #file-name {
            margin-top: 10px;
            color: #555;
        }

        .upload-btn {
            background: linear-gradient(135deg, #007bff 0%, #00c9ff 100%);
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
            margin-top: 20px;
        }

        .upload-btn:hover {
            background: linear-gradient(135deg, #0066cc 0%, #00bfff 100%);
            transform: translateY(-2px);
        }

        .upload-btn:active {
            transform: translateY(0);
        }

        .preview-container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .preview {
            margin-top: 10px;
            max-width: 100%;
            max-height: 200px;
        }

        video {
            max-width: 100%;
            max-height: 200px;
        }
    </style>
</head>
<body>

<div class="uploader-container">
    <h1>ファイルアップローダー</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="drag-area" id="drag-area">
            ファイルを選択、またはドラッグ＆ドロップしてください
        </div>
        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
        <div id="file-name"></div>
        <button type="submit" class="upload-btn">アップロード</button>
    </form>

    <div class="preview-container" id="preview-container"></div>

    <?php if (!empty($successMessage)): ?>
        <div class="message success"><?= $successMessage ?></div>
    <?php elseif (!empty($errorMessage)): ?>
        <div class="message error"><?= $errorMessage ?></div>
    <?php endif; ?>
</div>

<script>
    const dragArea = document.getElementById('drag-area');
    const fileInput = document.getElementById('fileToUpload');
    const fileNameDisplay = document.getElementById('file-name');
    const previewContainer = document.getElementById('preview-container');

    dragArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dragArea.classList.add('dragover');
    });

    dragArea.addEventListener('dragleave', () => {
        dragArea.classList.remove('dragover');
    });

    dragArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dragArea.classList.remove('dragover');
        dragArea.classList.add('dragdrop');
        const files = e.dataTransfer.files;
        fileInput.files = files;

        displayFileNames(files);
        displayFilePreviews(files);
    });

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        displayFileNames(files);
        displayFilePreviews(files);
        dragArea.classList.add('dragdrop');
    });

    dragArea.addEventListener('click', () => {
        fileInput.click();
    });

    function displayFileNames(files) {
        const fileNames = Array.from(files).map(file => file.name);
        fileNameDisplay.textContent = "選択されたファイル: " + fileNames.join(", ");
    }

    function displayFilePreviews(files) {
        previewContainer.innerHTML = ''; // 既存のプレビューをクリア
        Array.from(files).forEach(file => {
            const fileURL = URL.createObjectURL(file);
            const fileType = file.type.split('/')[0];

            if (fileType === 'image') {
                const img = document.createElement('img');
                img.src = fileURL;
                img.classList.add('preview');
                previewContainer.appendChild(img);
            } else if (fileType === 'video') {
                const video = document.createElement('video');
                video.src = fileURL;
                video.controls = true;
                video.classList.add('preview');
                previewContainer.appendChild(video);
            }
        });
    }
</script>

</body>
</html>