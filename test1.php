<?php 
session_start();
if (!isset($_SESSION['count'])) {
    // キー'count'が登録されていなければ、1を設定
    $_SESSION['count'] = 1;
} else {
    //  キー'count'が登録されていれば、その値をインクリメント
    $_SESSION['count']++;
}
$q_count=$_SESSION['count'];
try {
  $db = new PDO('mysql:dbname=utubyo_check;host=localhost;charset=utf8','root','root');
  #echo '接続OK！' . '<br>';
} catch (PDOException $e) {
  echo 'DB接続エラー！: ' . $e->getMessage();
}
//対象のテーブルを変数に格納
$data = utubyo_check2;
// 対象テーブルを選択しSELECT文を変数tableへ格納

$table = "SELECT * FROM $data WHERE Q_NUM=$q_count;";
// queryを実行し、結果を変数に格納
$sql = $db->query($table);

$q_count = $q_count + 1;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" charset="UTF-8">
</head>
<body>
<?php foreach ($sql as $row) { ?>
	<?php echo "質問".$row['Q'];?>
	<form method="get" action="regist.php">
	<input type="radio" name="<?= "Q" . $q_count; ?>" value="いいえ"> いいえ
	<input type="radio" name="<?= "Q" . $q_count; ?>" value="ときどき"> ときどき
	<input type="radio" name="<?= "Q" . $q_count; ?>" value="しばしば"> しばしば
	<input type="radio" name="<?= "Q" . $q_count; ?>" value="つねに"> つねに
	<p><input type="submit" value="送信する"></p>
	</form>
<?php }?>
</body>
</html>