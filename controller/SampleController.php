<?php
class SampleController extends Controller {
    public $data;
    function execute() {
        echo "MyExecutor 実行中\n";
        $this->data = "abcdefg";
    }
}
?>
