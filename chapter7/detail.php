<?php
session_start(); 
require '../header.php';
require 'menu.php';
require '../connect.php';

echo '<div class="container">
      <div class="text-center">';

$sql=$pdo->prepare('select * from product where id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql as $row) {
  echo '<p><img  alt="image" src="image/', $row['id'], '.jpg" class="w-50"></p>';
  echo '<form action="cart-insert.php" method="post">';
  echo '<p>商品番号:',$row['id'],'</p>';
  echo '<p>商品名:',$row['name'],'</p>';
  echo '<p>価格:',$row['price'],'</p>';
  echo '<p>個数:<select name="count">';
  for ($i=1; $i<=10; $i++) {
    echo '<option value="',$i, '">', $i,'</option>';
  }
  echo '</select></p>';
  echo '<input type="hidden" name="id" value="',$row['id'],'">';
  echo '<input type="hidden" name="name" value="',$row['name'],'">';
  echo '<input type="hidden" name="price" value="',$row['price'],'">';
  echo '<p><input type="submit" value="カートに追加"></p>';
  echo '</form>'; 
//ログイン判定
if (isset($_SESSION['customer'])) {
  //登録済み判定
  $query = 'SELECT COUNT(*) AS count FROM favorite
  WHERE customer_id = ? 
  AND product_id = ? ';
  $sql = $pdo->prepare($query);
  $sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
  $registered = $sql->fetch()['count'];
  //ver_dump($registered);  0か1

  if($registered) {# code...
   echo '<p>すでにお気に入りに登録されています</p>'; 
  } else { 
     //登録していない
    echo '<p><a href="favorite-insert.php?id=',$row['id'],'">お気に入りに追加</a></p>';
  }

 } else { 
  //ログインしてない 
    echo '<p>お気に入りに登録するにはログインしてください｡</p>';
 }
}
echo '</div></div>';
?>
<hr>
<?php require '../footer.php'; ?>