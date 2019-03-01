<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, "name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST["name"];
$url = $_POST["url"];
$naiyou = $_POST["naiyou"];


//2. DB接続します ここはほぼそのまま使う MAMPはid=root pass=root
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "INSERT INTO gs_bm_table(name,url,naiyou,indate)VALUES(:name,:url,:naiyou,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（idなど数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sqlError($stmt);
} else {

//５．index.phpへリダイレクト
header("Location: index.php");
exit;

}
?>
