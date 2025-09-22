<?php 
require '../header.php';
require 'menu.php';
require '../connect.php';
?>

<form action="product.php" method="post">
商品検索
<input type="text" name="keyword">
<input type="submit" value="検索">
</form>
<hr>

<?php
$limit = 8;
if(!empty($_REQUEST['page']) ){
	$offset = ($_REQUEST['page'] -1) * $limit ;
} else{
	$offset = 0;
}
echo '<div class="container">
      <div class="row">';

if (isset($_REQUEST['keyword'])) {
	$query = "SELECT * FROM product 
	WHERE name LIKE ?
	LIMIT $limit OFFSET $offset 
	";
	$sql = $pdo->prepare($query);
	$sql->execute(['%'.$_REQUEST['keyword'].'%']);

} else {
	$query = "SELECT * FROM product 
	LIMIT $limit OFFSET $offset
	";
	$sql = $pdo->query($query);
}
foreach ($sql as $row) {
	$id = $row['id'];
	echo '<div class="col-6 col-sm-4 col-md-3">';
	echo "<p><img src='image/$id.jpg'></p>";
	echo '<p>商品番号: ', $id, '</p>';
	echo '<p>';
	echo '<a href="detail.php?id=', $id, '">商品名: ', $row['name'], '</a>';
	echo '</p>';
	echo '<p>価格: ', $row['price'], '</p>';
	echo '</div>';
  }
  echo '</div></div>';
	?>
	<hr>

<?php
	$query = "SELECT COUNT(*) AS count FROM product ";
  $sql = $pdo->query($query);
  $item_count = $sql->fetch()['count'];
  $page_count = ceil($item_count / $limit);

	$active_page = isset($_GET['page']) ? $_GET['page'] : "1"; 
	$link_html = '';

	for ($i = 1; $i <= $page_count; $i++ ){
	    $page_text = $i ;
			if($active_page == $i) {
				$link_html .= "<li class='page-item active'>
				<span class='page-link'> $i </span></li>";
				$current = $i;
			} else {
				$link_html .= "<li class='page-item'>
				<a class='page-link' href='?page=$i'>$i</a></li>";
			}}?>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?= $current==1 ? 'disabled':''?> ">
      <a class="page-link" href="?page=<?=$current-1?>" >Previous</a>
    </li>

	  <?= $link_html ?>
		
    <li class="page-item <?= $current>2 ? 'disabled':''?> ">
      <a class="page-link" href="?page=<?=$current+1?>">Next</a> 
			
			
    </li>
  </ul>
</nav>

<?php require '../footer.php'; ?>
