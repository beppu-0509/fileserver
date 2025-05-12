<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>画像の一括アップロード</title>
</head>
<body>
    <h1>複数の画像をアップロード</h1>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        <label for="image-upload">画像を選択：</label>
        <input type="file" id="image-upload" name="images" accept="image/*" multiple>
        <br><br>
        <button type="submit">アップロード</button>
    </form>

    <h2>選択された画像プレビュー</h2>
    <div id="preview"></div>
</body>
</html>
