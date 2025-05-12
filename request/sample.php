//インポート
//front->controller->view処理(標準出力処理
//frontにリターンしてリクエスト属性データ格納view表示orシンプルcontroller->view
//クラスとしてコントローラーから出力用関数を呼び出したら、全部htmlを埋め込まないといけなくなる
//インポートともうひつとつで使い方違う気がする
//クラスの読み込みと、そのまま取り込みみたいな？だから変数のスコープが違うかも だめだった。
//処理からviewにどうやってデータを受け渡す？？？
//リダイレクトでリクエスト属性にデータ格納して受け渡す
<?php
// User.php をインポート
require 'User.php'; // または include 'User.php';

$hen = "test";

// User クラスを使ってオブジェクトを作成
$user = new User('Taro', 'taro@example.com');

// メソッドを呼び出してデータを取得
echo '名前: ' . $user->getName() . '<br>';
echo 'メール: ' . $user->getEmail();
?>
表示処理