<?php
class FileController extends Controller {
    public $files;
    function execute() {
        $this->files = glob('../data' . '/*');
        //foreach ($files as $file) {
        //    echo basename($file) . '<br>';
        //}
    }
}
?>
