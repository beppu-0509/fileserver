<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>fileserver</title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="image-container">
        <?php 
            foreach ($controller->files as $image) {
                echo '<div class="image-item">
                        <img src="' . $image . '" alt="画像">
                        <input type="checkbox" class="image-checkbox" data-src="' . $image . '">
                    </div>';
            }
        ?>
        <button id="downloadBtn">選択した画像をダウンロード</button>
    </div>
    <div class="bottom-nav">
        <a href="../request/file.php">
            <i class="fas fa-image"></i>
        </a>
        <a href="#">
            <i class="fas fa-video"></i>
        </a>
        <form id="uploadForm" action="../request/upload.php" method="post" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="media[]" style="display:none;" accept="image/*,video/*" multiple>
                <a href="#"  id="uploadButton">
                    <i class="fas fa-plus"></i>
                </a>
            <button type="submit" id="submitBtn" style="display:none;">Submit</button>
        </form>
    </div>
    <script>


        // アップロードボタンがクリックされたときに、ファイル選択ダイアログを開く
        document.getElementById("uploadButton").addEventListener("click", function(event) {
            event.preventDefault();  // aタグのデフォルト動作を防止
            document.getElementById("fileInput").click();  // ファイル選択ダイアログを開く
        });

        // ファイルが選択されたら、自動でフォームを送信
        document.getElementById("fileInput").addEventListener("change", function() {
            if (this.files.length > 0) {
                document.getElementById("submitBtn").click();  // submitボタンをクリックしてフォーム送信
            }
        });
        
        
        /*document.getElementById("downloadSelectedBtn").addEventListener("click", function() {
            // 選択された画像のURLを取得
            var selectedImages = [];
            document.querySelectorAll('.image-checkbox:checked').forEach(function(checkbox) {
                selectedImages.push(checkbox.getAttribute('data-src'));
            });

            if (selectedImages.length === 0) {
                alert("画像が選択されていません");
                return;
            }

            // 画像を順番にダウンロード
            selectedImages.forEach(function(imageUrl) {
                var link = document.createElement('a');
                link.href = imageUrl;
                link.download = imageUrl.split('/').pop(); // ダウンロード名を設定
                link.click();
            });
        });*/
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>

<script>
    document.getElementById('downloadBtn').addEventListener('click', function() {
        var zip = new JSZip();
        var count = 0;
        var zipFilename = "images.zip";
        
        // 選択された画像を取得
        var selectedImages = document.querySelectorAll('.image-checkbox:checked');

        if (selectedImages.length === 0) {
            alert("画像を選択してください");
            return;
        }

        // 画像をZIPに追加
        selectedImages.forEach(function(checkbox) {
            var imageUrl = checkbox.getAttribute('data-src');
            var filename = imageUrl.split('/').pop();

            // 画像をBase64で取得
            fetch(imageUrl)
                .then(response => response.blob())
                .then(blob => {
                    zip.file(filename, blob);

                    // すべての画像を追加した後にZIPを生成
                    count++;
                    if (count === selectedImages.length) {
                        // ZIPを生成してダウンロード
                        zip.generateAsync({ type: "blob" }).then(function(content) {
                            saveAs(content, zipFilename);  // FileSaver.jsを使用してZIPをダウンロード
                        });
                    }
                });
        });
    });
</script>
</body>
</html>
<style>
    /* 下部メニューのスタイル */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: white;
        color: white;
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 10%;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000; /* メニューが常に最前面に表示される */
        opacity: 0.96;
    }

    /* メニューアイテム */
    .bottom-nav a {
        color: darkgray;
        text-decoration: none;
        font-size: 48px;
        padding: 5px;
        text-align: center;
    }
    
    /* グリッドレイアウト設定 */
    .image-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* デスクトップで5列表示 */
        gap: 10px; /* 画像間のスペース */
        width: 100%; /* 親要素の幅に合わせる */
        padding-bottom: 16%;
    }

    /* 画像の正方形にするための親要素 */
    .image-item {
        position: relative;
        padding-top: 100%; /* 高さを幅の100%にすることで正方形 */
        overflow: hidden; /* 画像がはみ出さないように */
        position: relative;
    }

    .image-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%; /* 親要素の幅に合わせる */
        height: 100%; /* 高さも親要素に合わせる */
        object-fit: cover; /* 画像が枠内で切り取られずに収まるように調整 */
        border: 2px solid #ccc;
        border-radius: 8px;
    }

    .image-checkbox {
        position: absolute;
        bottom: 10px; /* 画像の下から10px */
        right: 10px; /* 画像の右から10px */
        background-color: rgba(255, 255, 255, 0.7); /* 半透明の背景 */
        border: none;
        padding: 5px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
