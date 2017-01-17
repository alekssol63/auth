<?php
include_once 'core.php';
include_once 'functions.php';
$isSave=(bool)getParam('is_save',false);
if (isSave){
	header('Content-Dicposition: filename="card.png"');
}
createImage($_SESSION['user_name'].", вы набрали ".$_SESSION['points']." ".get_word($points));

?>