<?php require '../header.php'; ?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
	'staff', 'password');
	
	
	if (empty($_REQUEST['name'])) {
		echo '商品名を入力してください。';
		
	} else if (!preg_match('/^[0-9]+$/', $_REQUEST['price'])) {
		echo '価格を整数で入力してください。';
		
	} else {
		
		try {  
			$pdo->beginTransaction();
			$sql=$pdo->prepare('INSERT INTO product VALUES(null, ?, ?)');

			$sql->execute([
				htmlspecialchars($_REQUEST['name']), 
				$_REQUEST['price']
			]);
			$product_id = $pdo->lastInsertId(); // A_Iの予約番号 
		
			//ここで画像を保存する
			if (is_uploaded_file($_FILES['file']['tmp_name'])) {
				// なければフォルダを作る
				if (!file_exists('../chapter7/image')) mkdir('../chapter7/image');
				
				// MIMEタイプを調べなければなりません
				if ($_FILES['file']['type']=="image/jpeg"){
					$file="../chapter7/image/$product_id.jpg" ;
					
				} else if($_FILES['file']['type']=="image/png") {
					$file="../chapter7/image/$product_id.png" ;
					
				} else {
					echo '対応していないファイル形式です。';
					exit();  //ここで中断
				}
				
				if(move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
					echo $file, 'のアップロードに成功しました。';
					echo '<p><img alt="image" src="', $file, '"></p>';
				} else {
					echo 'アップロードに失敗しました。';
				}

			} else {
				echo 'ファイルを選択してください。';
				//例外エラーを発生させる
			} // ファイル保存END

			$pdo->commit(); // 実行の確定
			echo '追加に成功しました。';

  
	} catch (Exception $e) {
		$pdo->rollBack();
		#DEBUG 
		echo "追加に失敗しました。" . $e->getMessage();
	}
}
?>
<?php require '../footer.php'; ?>
