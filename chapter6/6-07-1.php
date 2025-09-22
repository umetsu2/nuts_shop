<?php require '../header.php'; ?>
<table>
<tr><th>商品番号</th><th>商品名</th><th>価格</th><th></th></tr>
<?php require '../connect.php'; ?>
<?php
foreach ($pdo->query('select * from product') as $row) {
	echo '<tr>';
	echo '<td>', htmlspecialchars($row['id']), '</td>';
	echo '<td>', htmlspecialchars($row['name']), '</td>';
	echo '<td>', htmlspecialchars($row['price']), '</td>';
	echo '<td>';
	echo '<a href="6-07-2.php?id=', $row['id'],'">消去</a>';
	echo '</td>';
	echo '</tr>';
	echo "\n";
}
?>
</table>
<?php require '../footer.php'; ?>
