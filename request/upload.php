<?php
require '../FrontController.php';
$front = new FrontController();
$front->dispatch(pathinfo(__FILE__, PATHINFO_FILENAME));
?>