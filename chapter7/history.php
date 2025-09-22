<?php
session_start(); 
require '../header.php';
require 'menu.php';
require '../connect.php';

if (isset($_SESSION['customer'])) {
	//元の文
	/*
	$sql_purchase=$pdo->prepare(
		'SELECT * FROM purchase 
		WHERE customer_id=? ORDER BY id DESC'
	);
	$sql_purchase->execute([$_SESSION['customer']['id']]);
	
	foreach ($sql_purchase as $row_purchase) {
		$sql_detail=$pdo->prepare(
			'SELECT * FROM purchase_detail,product 
			 WHERE purchase_id=? 
			 AND product_id=id');
		$sql_detail->execute([$row_purchase['id']]);
		
		echo '<table>';
		echo '<tr><th>商品番号</th><th>商品名</th>', 
			'<th>価格</th><th>個数</th><th>小計</th></tr>';
		$total=0;
		foreach ($sql_detail as $row_detail) {
			echo '<tr>';
			echo '<td>', $row_detail['id'], '</td>';
			echo '<td><a href="detail.php?id=', 
			      $row_detail['id'], '">', 
				    $row_detail['name'], '</a></td>';
			echo '<td>', $row_detail['price'], '</td>';
			echo '<td>', $row_detail['count'], '</td>';
			     $subtotal = $row_detail['price'] * 
			     $row_detail['count'];
			     $total += $subtotal;
			echo '<td>', $subtotal, '</td>';
			echo '</tr>'; 
			*/

	//修正した文
	//顧客名がいらないのでcustomerは繋げなくていい
	$sql_purchase = $pdo->prepare(
		'SELECT `product_id` , p.name, count, `price`,
		`price` * count AS subtotal
		FROM `purchase_detail`
		LEFT JOIN `product` AS p ON p.id = `product_id`
		LEFT JOIN `purchase` AS c ON c.id = `purchase_id`
		WHERE customer_id = ? ORDER BY c.id DESC'
		);
	//一人の顧客IDで絞り込む
	$sql_purchase->execute([$_SESSION['customer']['id']]);

	  echo '<table>';
	  echo '<tr><th>商品番号</th><th>商品名</th>', 
			   '<th>価格</th><th>個数</th><th>小計</th></tr>';
		$total = 0;
		//行だけ回せばいいのでループは1回
		foreach ($sql_purchase as $row) {
			echo '<tr>';
			echo '<td>' , $row['product_id'],'</td>';
			echo '<td><a href = "detail.php?id=' , $row['product_id'],'">',
			     $row['name'], '</a></td>';
			echo '<td>', $row['price'], '</td>';
			echo '<td>', $row['count'], '</td>';
			$subtotal = $row['price'] * $row['count'];
			echo '<td>', $subtotal,'</td>';
			echo '</tr>';

			$total += $subtotal;
		}

		echo '<tr><td colspan="4">合計</td>
		      <td>', $total, '</td></tr>';
		echo '</table>'; 
		echo '<hr>';
	} else {
	  echo '購入履歴を表示するには、ログインしてください。';
	}

require '../footer.php'; ?>
