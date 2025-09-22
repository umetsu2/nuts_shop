<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php require '../connect.php'; ?>
<?php

if (isset($_SESSION['customer'])) {
  $sql=$pdo->prepare('insert into favorite values(?,?)');
  $sql->execute([$_SESSION['customer']['id'],$_REQUEST['id']]);
echo '<p>お気に入りに商品を追加しました｡';
echo '<hr>';
require 'favorite.php';
} else {
  echo 'お気に入りに商品を追加するには､ログインしてください｡';
}
?>
<?php require '../footer.php'; ?>

<!-- 重複エラーを直すために detail.php の方を直した -->