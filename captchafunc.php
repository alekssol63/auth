<?php
define('CAPTCHA_PATH', __DIR__ . '/captcha.json');
/*function isPOST()
{
    return !empty($_POST);
}*/
/*function getParam($paramName, $default = null) {
    return !empty($_REQUEST[$paramName]) ? $_REQUEST[$paramName] : $default;
}*/
function createCaptcha()
{
    $text = generateRandomString(6);
    saveCaptcha($text);
    $im = imagecreatetruecolor(100, 30);
    $backColor = imagecolorallocate($im, 255, 255, 255);
    $textColor = imagecolorallocate($im, 129, 15, 90);
    $fontPath = __DIR__ . '/res/Mistral-Regular_.ttf';
    imagefill($im, 0, 0, $backColor);
    imagettftext($im, 14, 0, 20, 20, $textColor, $fontPath, $text);
    imagepng($im);
    imagedestroy($im);
}
function checkCaptcha($text){
    if (file_exists(CAPTCHA_PATH)) {
        $data = json_decode(file_get_contents(CAPTCHA_PATH), true);
        $clientIp = getClientIp();
        return isset($data[$clientIp]) && $data[$clientIp] == $text;
    }	
    return false;
}
function getClientIp()
{
    return $_SERVER['REMOTE_ADDR'];
}
function saveCaptcha($text)
{
    $data = array();
    if (file_exists(CAPTCHA_PATH)) {
        $data = json_decode(file_get_contents(CAPTCHA_PATH), true);
        if (!$data) {
            $data = array();
        }
    }
    $data[getClientIp()] = $text;
    return file_put_contents(CAPTCHA_PATH, json_encode($data));
}
function generateRandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}