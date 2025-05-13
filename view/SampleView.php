<!-- view/SampleView.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample View</title>
</head>
<body>

    <h1>Welcome to the Sample View</h1>
    
    <!-- コントローラーから渡されたデータを表示 -->
    <p>データ: <?php echo $controller->data; ?></p>

</body>
</html>
