<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
	$name=$address=$email=$login=$password = '';
	if (isset($_SESSION['customer'])) {
		$name=$_SESSION['customer']['name'];
		$address=$_SESSION['customer']['address'];
		$emali=$_SESSION['customer']['email'];
		$login=$_SESSION['customer']['login'];
	}

	$_SESSION['unique_id'] = uniqid();
  
?>

<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
      
<form action="customer-output.php" method="post" class="h-adr">
  <span class="p-country-name" style="display:none;">Japan</span>

  <input type='hidden' value="<?=$_SESSION['unique_id']?>" name='token'>

<style>
table {border-collapse: separate;border-spacing: 10px; /}
</style>


  <table align="center">
    <tr>
      <td>お名前</td>
      <td><input type="text" name="name" value="<?= $name?>" required></td>
    </tr>

    <tr>
      <td>〒</td>
      <td> <input type="text" class="p-postal-code" size="8" maxlength="8"></td>
    </tr>
    
    <tr>
      <td>ご住所</td>
      <td>
        <input type="text" class="p-region p-locality p-street-address p-extended-address"  name="address" value="<?= $address?>"  required>
      </td>
    </tr>

    <tr>
      <td>メール</td>
      <td>
        <input type="text" name="email" value="<?= $email?>"  required>
      </td>
    </tr>
    <tr>
      <td>ログイン名</td>
      <td><input type="text" name="login" value="<?= $login?>"  required></td>
    </tr>

    <tr>
      <td>パスワード</td>
      <td>
        <input type="password" name="password" class="pswd" size="13" maxlength="13" value="<?= $password?>"  required>
      </td>
    </tr>

        <tr>
          <td>パスワード確認</td>
          <td>
            <input type="password" name="password-c" class="pswd" size="13" value="<?= $password?>"  required> 
            <button id="show" type="button" class="btn"><i class="bi bi-eye"></i></button> 
          </td>
        </tr>
        <tr><td></td><td><input id="submit_btn" type="button" size="30" value="送信"></td></tr>
      </table>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

$('#show').click(function(){
    if ($(this).html() === `<i class="bi bi-eye"></i>`) {
        $('.pswd').attr('type','text');
        $(this).html(`<i class="bi bi-eye-slash"></i>`);
    } else {
        $('.pswd').attr('type','password');
        $(this).html(`<i class="bi bi-eye"></i>`);
    }
})

    $('#submit_btn').click(function(){
        var pswd_1 = $('[name="password"]').val();
        var pswd_2 = $('[name="password-c"]').val();
        if(pswd_1 != pswd_2 ){
            $('.h-adr').append(
            `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>パスワードが違います!</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`);
        }else{
            $('.h-adr').submit()
        }
    })

    $('[name="password"],[name="password-c"]').focus(function(){
        $('#art').remove();
    });

</script>
<hr>
<?php require '../footer.php'; ?>