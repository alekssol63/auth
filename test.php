<?php
define ('APP_NAME','auth');
include_once 'core.php';
if (!empty($_SESSION['num'])){
$outstr = get_data_from_file($_SESSION['num']);
$test_start=true;
};
?>
<?php
if (!empty($_POST["end_test"])){
$_SESSION['points']=0;
$outstr=get_data_from_file($_POST["end_test"]);
if($outstr){	 
foreach ($_POST as $key => $value){
if(is_int($key)){
if($outstr[1][$key]["A"]==$value){$_SESSION['points']++;}
}
}
//createImage($_SESSION['user_name'].", вы набрали ".$_SESSION['points']." ".get_word($points));
$test_start=false;
$result=true;
}
else{ echo"Файл с таким именем не существует";}
}

?>
<?php if ($test_start){?>
<form action="test.php" method="post">
<?php 
	foreach ($outstr as $key => $value)
	{
		foreach ($value as $k => $v)
		{				
			if(is_array($v))
			{
				echo $v["Q"];
				echo "</br>";
				foreach ($v["Version"] as $kkk => $vvv){?>
				<p><input name="<?php echo $k;?>" type="radio" value="<?php echo $vvv;?>"> <?php echo $vvv; ?></p>
				<?php } echo "</br>";
			}
			else{echo "<h2>".$v."</h2></br>";
			}
		}
	}
} ?>
<button type="submit" name="end_test" value="<?php echo $_SESSION['num'];?>">Готово</button>
</form>
<?php if ($result){?>
<form>
<img src="getcard.php">
<div>
<a href="getcard.php?is_save=1">Сохранить на компьютер<a>
</div>
</form>
<?php } ?>