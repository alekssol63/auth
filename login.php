<?php
define ('APP_NAME','auth');
include_once 'core.php';
include_once 'captchafunc.php';
if (isPost()){
	if($_POST['submit_user_data']>=5){
		if (login(getParam('login'),getParam('password'))&& checkCaptcha(getParam('captcha'))){
		header('Location: auth.php');// редирект
		die;
		}
	}	
	else{
		if(login(getParam('login'),getParam('password'))){
			header('Location: auth.php');// редирект
			die;
		}else{
			if($_POST['submit_user_data']<5){
			$_POST['submit_user_data']++;
			}
		}
	}
}
var_dump($_SESSION);
?>

<html>
<title>Вход в систему</title>
	<ul>
		<?php		foreach (getErrors() as $error){ ?>
		<li><?php echo $error; }?></li>
		<?php clearErrors($error);?>
	</ul>	
	<body>
		<form action="login.php" method="post">
		<input name="login" type="text" placeholder="admin">
		<input name="password" type="text" placeholder="pass">
		<?php if ($_POST['submit_user_data']>=5){ ?>
		<div>
		<img src="captcha.php" /><br/>
        <input id="captcha" name="captcha"><br/>
		</div>
		<?php };?>
		<button type="submit" name="submit_user_data" value="<?php echo $_POST['submit_user_data']; ?>">Отправить</button>
  </form>
	</body>
</html>