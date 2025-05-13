<?php
// フロントコントローラー
class FrontController {
    public function dispatch($controllerName) {
        foreach (glob(__DIR__ . "/controller/*Controller.php") as $file) {
            require_once $file;
        }
        // コントローラー名を大文字小文字に関係なく受け取る
        $controllerClass = ucfirst($controllerName) . "Controller";

        // クラスが存在する場合のみ処理を実行
        if (class_exists($controllerClass)) {
            // コントローラーをインスタンス化
            $controller = new $controllerClass();
            // executeメソッドを実行
            $controller->execute();
            // ★★★インスタンス.変数名でアクセスできるのでは？
            // ただし、コントローラークラスのフィールドを作成する
            include __DIR__ . '/view/' . ucfirst($controllerName) . "View.php";
            //なんかここでエラーでてる
        } else {
            echo "コントローラーが見つかりません";
        }
    }
}
?>
