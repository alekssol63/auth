<?php
define ('APP_NAME','auth');
include_once 'core.php';

if (isGuest())
{
	header('Location:login.php');
	die;
}
else
{
	if (isPost())
	{
		if (getParam('edit_files')){header('Location: list.php');}
	}
}		
?>

<b><?php echo getCurrentLogin()?>, Добро пожаловать, вы можете добавлять или удалять тесты</b></br>
<form action="auth.php" method="post" enctype="multipart/form-data">
<button type="submit" name="edit_files" value="ok">Редактировать файлы</button>
</br>
<a href="logout.php">Выйти</a>