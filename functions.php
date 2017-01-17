<?php
define('USER_LOGIN', 'admin');
define('USER_PASSWORD','pass');
session_start();
function isGuest()
{
	return !isset($_SESSION['login']);
}
function logout()
{
	return session_destroy();   
}
function login($login, $password)
{
	if ($login==USER_LOGIN && $password==USER_PASSWORD)
	{	
		$_SESSION['login']=USER_LOGIN;
		$_SESSION['client_ip']= $_SERVER['REMOTE_ADDR'];
		return true;
	}
		setError('Неверный логин и пароль');

	return false;
}
function getCurrentLogin()
{
	if (isset($_SESSION['login'])) {
	return $_SESSION['login'];
	die;
	}
	else{
	return "ничего не работает";
	}
}
function isPost()
{
	return !empty($_POST);
}
function getParam($paramName, $default=null)
{	
	return !empty($_REQUEST[$paramName])?$_REQUEST[$paramName]:$default;
}	
function getErrors()
{
	return isset($_SESSION['errors'])?$_SESSION['errors']:array();
}
function clearErrors($error)
{
	unset($_SESSION['errors']);
}
function setError($error)
{
	$_SESSION['errors'][]=$error;
}
function createImage($text)
{
	header('Content-Type: image/png');
    $im = imagecreatetruecolor(800, 600);
    $bc = imagecolorallocate($im, 100, 100, 221);
    $textColor = imagecolorallocate($im, 133, 14, 91);
    $boxPath = realpath(__DIR__ . '\res\flowers.png');
    $box = imagecreatefrompng($boxPath);
    $fontPath = realpath(__DIR__ . '\res\Mistral-Regular_.ttf');
    imagefill($im, 0, 0, $bc);
    imagettftext($im, 50, 0, 150, 250, $textColor, $fontPath, $text);
    imagecopy ($im, $box, 460,370,0,0,300,189); 
    imagepng($im);
    imagedestroy($im);
    imagedestroy($box);
}
function createCard($name)
{
    $canvas = imagecreatetruecolor(800, 600);
    $im = imagecreatetruecolor(800, 600);
    $bc = imagecolorallocate($im, 100, 100, 221);
    $textColor = imagecolorallocate($im, 133, 14, 91);
    $boxPath = realpath(__DIR__ . '/flowers.png');
    $box = imagecreatefrompng($boxPath);
    $fontPath = realpath(__DIR__ . '/Mistral-Regular_.ttf');
    imagefill($im, 0, 0, $bc);
    imagettftext($im, 50, 0, 150, 250, $textColor, $fontPath, $name);
    imagecopy ($im, $box, 460,370,0,0,300,189); 
    imagepng($im);
    imagedestroy($im);
    imagedestroy($box);
}

//my_functions
function get_word($points)
{
	if($points==0) $word="баллов";
	elseif($points==1)$word="балл";
	elseif($points>1&& $points<5)$word="балла";
	else{$word= "баллов";};
	return $word;
}
function get_data_from_file($num)
{
	$path=__DIR__.'/files/'.$num.'.json';
	if (file_exists($path)) {
	$j_str=  file_get_contents($path); 
	$outstr=json_decode($j_str,true);
	return $outstr;
	}
	else{header(404);
	die('Файл не найден');
	}
}
function saveCard($fileName, $name) {
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    createCard($name);
}
?>