<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
 
<style>
table {border-collapse: separate;border-spacing: 10px; /}
</style>
<form action="login-output.php" method="post">

<table align="center">
  <tr>
    <td> ログイン名 <input type="text" name="login"></td></tr>
    <tr>
      <td> パスワード <input type="password" name="password"></td></tr>
      <tr>
       <td><input type="submit" value="ログイン"></td>
</tr>
</form>
</table>
<hr>
<?php require '../footer.php'; ?>