<?php require '../header.php'; ?>
<table>
<tr><th>商品番号</th><th>商品名</th><th>価格</th><th></th></tr>
<?php require '../connect.php'; ?>
<?php
$sql=$pdo->prepare('delete from product where id=?');
if ($sql->execute([$_REQUEST['id']])) {
echo '消去に成功しました｡';
} else{
  echo '消去に失敗しました';
}
?>
<?php require '../footer.php'; ?>
