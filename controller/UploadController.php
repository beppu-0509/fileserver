<?php
class UploadController extends Controller {
    public $files;

    function execute() {
        // アップロードされたファイルの保存先ディレクトリ
        $uploadDir = '../data/';

        // ファイルが送信されているか確認
        if (isset($_FILES['media'])) {
            $fileArray = $_FILES['media'];
            
            // 各ファイルを処理
            foreach ($fileArray['name'] as $key => $fileName) {
                // ファイルが選択されている場合
                if ($fileArray['error'][$key] === UPLOAD_ERR_OK) {
                    // ファイルの拡張子を取得
                    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                    // ランダムなファイル名を生成
                    $newFileName = uniqid('file_') . '.' . $fileExt;

                    // アップロードされたファイルのMIMEタイプを確認
                    $fileType = mime_content_type($fileArray['tmp_name'][$key]);
                    $allowedTypes = [
                        'image/jpeg', 'image/png', 'image/gif', // 許可する画像のMIMEタイプ
                        'video/mp4', 'video/avi', 'video/mkv', 'video/webm', // 許可する動画のMIMEタイプ
                    ];

                    // 許可されていないファイルタイプの場合はエラーメッセージ
                    if (!in_array($fileType, $allowedTypes)) {
                        echo "不正なファイルタイプです: $fileName<br>";
                        continue; // 次のファイルへ
                    }

                    // 保存先パス
                    $uploadFilePath = $uploadDir . $newFileName;

                    // ファイルを保存
                    if (move_uploaded_file($fileArray['tmp_name'][$key], $uploadFilePath)) {
                        echo "ファイル '$fileName' をアップロードしました。<br>";
                    } else {
                        echo "ファイル '$fileName' のアップロードに失敗しました。<br>";
                    }
                } else {
                    echo "ファイル '$fileName' にエラーが発生しました。<br>";
                }
            }
        } else {
            echo "ファイルが選択されていません。<br>";
        }

        // アップロード後にリダイレクト
        header('Location: ../request/file.php');  // 任意のURLにリダイレクト
        exit(); 
    }
}
?>
