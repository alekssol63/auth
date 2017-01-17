<?php
define ('APP_NAME','auth');
include_once 'core.php';
mb_internal_encoding("UTF-8");
$ext=array("json");
$uploaded=false;
//Инициализация filelist.php
$file='filelist.php';
//if (!file_exists($file)){file_put_contents($file,"<h1>files</h1></br>");};
if (isGuest())
{
	header('Доступ запрещен',true,403);
	die;
}
if(!file_exists($file)){file_put_contents($file,"files");};
if(!empty($_POST['submit_file'])){
if(!empty($_FILES))
{
	$name_f="!".$_FILES['test']['name']."?";
	if ($list=file_get_contents($file))
	{
      $file_name=substr($_FILES['test']['name'],0,strpos($_FILES['test']['name'],'.'));
      $tv=mb_strpos($list,$file_name);
      if(!$tv)
      {
        $uploaddir =__DIR__.'\files\\';
        $uploadfile = $uploaddir . basename($_FILES['test']['name']);
        $file_ext=substr($_FILES['test']['name'],strpos($_FILES['test']['name'],'.')+1);
        if(!in_array($file_ext, $ext)){die('НЕДОПУСТИМОЕ РАСШИРЕНИЕ ФАЙЛА');};
        if (move_uploaded_file($_FILES['test']['tmp_name'],$uploadfile))
        {
          echo "Файл успешно загружен</br>";
		  
        }
        else { die('НЕ УДАЛОСЬ ЗАГРУЗИТЬ'); };

        if (file_put_contents($file, $name_f, FILE_APPEND))echo "Файл ".$_FILES['test']['name']." сохранен в list.php";
      }
      else {
              echo "Файл уже был загружен";
           }
	}
  else {echo "Не удается получить данные из list.php";};
  $uploaded=true;
}
}

function fedit($file,$value)//убирает строку из файла
{
	$fname=file_get_contents($file);
	$tmp=substr_replace($fname,'',strpos($fname,$value)-1,strlen($value)+2);
	file_put_contents($file,$tmp);
}
function rfile($file){
$fname=file_get_contents($file);
if (strpos($fname,'!')){
	while($fname){
		$tmp=substr($fname,strpos($fname,'!')+1,(strpos($fname,'?')-strpos($fname,'!'))-1);
		$name[]=$tmp;
		$fname=substr($fname,strpos($fname,'?')+1);
	};
	return $name;
	die;
}
else{
	return array();
}
}
if(!empty($_REQUEST)){
foreach($_REQUEST as $key=>$value){
	if (is_int($key)) {
	if(file_exists(__DIR__.'\\files\\'.$value)){
	unlink(__DIR__.'\\files\\'.$value);
	fedit($file,$value);
	}	
}
}
}
if (isPost()){
	if (getParam('gotest')){
		header('Location: user.php');
	}
}
	
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
</head>
<body>
<form action="list.php" method="post"enctype="multipart/form-data">
<h3>Загрузить файл</h3>
<input name="test" type="file" >
<button type="submit" name="submit_file" value="ok">Отправить</button>
</br>
<h3>Список файлов</h3>
</br>
<?php
 $name=rfile($file);
 ?>
 <?php
 foreach($name as $key=>$value)
{?>
<input type="checkbox" name="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php echo $value; ?></br>
<?php };?>
<button type="submit" name="check">Удалить</button></br>
<div><button type="submit" name="gotest" value="ok">Перейти к выпоолнению тестов</button></div>
</form>
</body>
</html>