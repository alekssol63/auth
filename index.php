<?php
define ('APP_NAME','auth');
include_once 'core.php';
if(isPost()){
	if (getParam('user')){
		header('Location: auth.php');
	}
}
if(isPost()){
	if (getParam('guest')){
		$_SESSION['user_name']=$_POST['user_name'];
		header('Location: user.php');
	}
}
?>
<html>
<form action="index.php" method="post">
<label for="submit">Войти как администратор</label>
<button type="submit" name="user" value="guest">ОК</button></br>
<label for="name">Войти как гость</label>
<input name="user_name" type="text" placeholder="Фамилия, Имя">
<button type="submit" name="guest" value="guest">ОК</button>
</form>
</html>