<?

include 'system/common.php';    
include 'system/functions.php';
include 'system/user.php';
$title='Аукцион ресурсов';
include 'system/h.php';


if (isset($_SESSION['message'])){
echo "<div class='main'><center>$_SESSION[message]</center></div><div class='line'></div>";
$_SESSION['message']=NULL;
}

$idu=$user['id'];
$get=trim(htmlspecialchars($_GET['page']));
$sellres=20; //Продажа игрокам ресурсов
$buyres=20; // продажа игроками ресурсов скупщику.
$resname = array("NULL","Алмаз","Корунд","Обсидиан","Графит","Оникс","Амброзия","Мята","Аир","Рябина");
$sack=mysql_fetch_array(mysql_query("SELECT * FROM `sack` WHERE `user`='".$idu."'"));
if(!$sack){
	mysql_query("INSERT INTO `sack` SET `user`='".$idu."'");
}
$bazaar=mysql_fetch_array(mysql_query("SELECT * FROM `bazaar` WHERE `id`='1'"));


switch ($get){
	default;
	?>
	<div class='main block'/>
	<center>
		 <img src='/rusalc/auk.jpg' width='100%' alt='*'/>
	</center>
	</div>
	<div class='mini-line'/></div>
	<div class='main block'>
		<center>
			Добро пожаловать на аукцион ресурсов!
		</center>
	</div>
	<div class='mini-line'/></div>
	
	<?
echo "<table style='width:100%;'><tr>";
echo'<td style="25%">
<a class="small-but" href="?page=sell">
<div class="imgwrap"><img src="/rusalc/gl.jpg"></div>
<span>	Продажа	</span></a>
</td>	';
	
echo'<td style="25%">
<a class="small-but" href="?page=buy">
<div class="imgwrap"><img src="/rusalc/zadan.jpg"></div>
<span>Покупка</span></a>
</td>	';
echo "</tr></table>";
?>
	<div class='main block'>
		<center>
			Имеется в продаже
		</center>
</div>
	
	
	
<div class='mini-line'></div>
	<?



	for ($i=1;$i<10;$i++){
		

		?>
		<div class='main block'>
 		 <table cellpadding='0' cellspacing='0'>
			<tr>
  

  		<td><img src='/images/res/<?=$i?>.png' alt='*'/></td>
 		 <td valign='top' style='padding-left: 5px;'><?=$resname[$i];?> (<?=$bazaar[$i]?> <font color='#9bc'>шт</font>)<br/><small>
 		 
 		 </small></td></tr></table>
		</div> 
		<div class='mini-line'/></div>

		<?
	}


	break;

	case 'sell';
	//Обработчик
		if(isset($_GET['form'])){
			$pc=_string(_num($_POST['pc']));
			$resq=_num($_POST['i']);
			if($sack[$resq]<$pc){
				$_SESSION['message']="<div class='block'>У вас нет такого количества <img src='/images/icon/res/$resq.png'/>$resname[$resq]</div>";
				header("Location:?page=sell");
				exit;
			}elseif($sack[$resq]>=$pc){
				if($resq==1){
				mysql_query("UPDATE `sack` SET `1`='".($sack['1']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `1`='".($bazaar['1']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==2) {
				mysql_query("UPDATE `sack` SET `2`='".($sack['2']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `2`='".($bazaar['2']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==3) {
				mysql_query("UPDATE `sack` SET `3`='".($sack['3']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `3`='".($bazaar['3']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==4) {
				mysql_query("UPDATE `sack` SET `4`='".($sack['4']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `4`='".($bazaar['4']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==5) {
				mysql_query("UPDATE `sack` SET `5`='".($sack['5']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `5`='".($bazaar['5']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==6) {
				mysql_query("UPDATE `sack` SET `6`='".($sack['6']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `6`='".($bazaar['6']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==7) {
				mysql_query("UPDATE `sack` SET `7`='".($sack['7']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `7`='".($bazaar['7']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==8) {
				mysql_query("UPDATE `sack` SET `8`='".($sack['8']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `8`='".($bazaar['8']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==9) {
				mysql_query("UPDATE `sack` SET `9`='".($sack['9']-$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `9`='".($bazaar['9']+$pc)."' WHERE `id`='1'")or die(mysql_error());
				}
				mysql_query("UPDATE `users` SET `g`='".($user['g']+($buyres*$pc))."' WHERE `id`='".$idu."'");
				
				$gg=$buyres*$pc;
				$_SESSION['message']="<div class='block'>Вы успешно продали <img src='/images/icon/res/$resq.png'/>$resname[$resq] получив $gg <img src='/images/icon/gold.png'/>  </div>";
				header("Location:?page=sell");
				exit;

			}

			
		}
			?>
			
			<div class='main block'/>
			Цена за каждый ресурс по: <?=$buyres;?> <img src='/images/icon/gold.png'/>
			</div>
			<?

			for ($i=1;$i<10;$i++){

				?>
			<div class='main block'>
 		 	<table cellpadding='0' cellspacing='0'>
			<tr>
  			<td><img src='/images/res/<?=$i?>.png' alt='*'/></td>
 		 	<td valign='top' style='padding-left: 5px;'><?=$resname[$i];?> (<?=$sack[$i]?> <font color='#9bc'>шт</font>)<br/><small>
 		 		<form action="?page=sell&amp;form" method="post"/>
 		 		<input type='hidden' value='<?=$i;?>' name='i'/>
 		 		<input type='text' class='text' name='pc' required/><br>
<span class='btn'><span class='end'><input class='label' type='submit' value='Продать'>Продать</span></span>
 		 		</form>
 		 	</small></td></tr></table>
			</div> 
			<div class='mini-line'/></div>
			
		<?
	}
	?>
	<div class='main menuList'/>
			<li>
				<a href='/auction.php'>Назад</a>
			</li>
			</div>
	<?

	break;

	case 'buy';

	//Обработчик
		if(isset($_GET['form'])){
			$pc=_string(_num($_POST['pc']));
			$resq=_num($_POST['i']);
			if($bazaar[$resq]<$pc){
				$_SESSION['message']="<div class='content'>У скупщика нет такого количества <img src='/images/icon/res/$resq.png'/>$resname[$resq]</div>";
				header("Location:?page=buy");
				exit;
			}elseif ($user['g']<($pc*$sellres)) {
				$_SESSION['message']="<div class='block'>У тебя не хватает золота</div>";
				header("Location:?page=buy");
				exit;
			
			}elseif($bazaar[$resq]>=$pc && $user['g']>=($pc*$sellres)){
				if($resq==1){
				mysql_query("UPDATE `sack` SET `1`='".($sack['1']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `1`='".($bazaar['1']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==2) {
				mysql_query("UPDATE `sack` SET `2`='".($sack['2']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `2`='".($bazaar['2']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==3) {
				mysql_query("UPDATE `sack` SET `3`='".($sack['3']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `3`='".($bazaar['3']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==4) {
				mysql_query("UPDATE `sack` SET `4`='".($sack['4']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `4`='".($bazaar['4']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==5) {
				mysql_query("UPDATE `sack` SET `5`='".($sack['5']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `5`='".($bazaar['5']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==6) {
				mysql_query("UPDATE `sack` SET `6`='".($sack['6']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `6`='".($bazaar['6']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==7) {
				mysql_query("UPDATE `sack` SET `7`='".($sack['7']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `7`='".($bazaar['7']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==8) {
				mysql_query("UPDATE `sack` SET `8`='".($sack['8']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `8`='".($bazaar['8']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}elseif ($resq==9) {
				mysql_query("UPDATE `sack` SET `9`='".($sack['9']+$pc)."' WHERE `user`='".$idu."'")or die(mysql_error());
				mysql_query("UPDATE `bazaar` SET `9`='".($bazaar['9']-$pc)."' WHERE `id`='1'")or die(mysql_error());
				}
				mysql_query("UPDATE `users` SET `g`='".($user['g']-($sellres*$pc))."' WHERE `id`='".$idu."'");
				
				$gg=$sellres*$pc;
				$_SESSION['message']="<div class='block'>Вы успешно приобрели <img src='/images/icon/res/$resq.png'/>$resname[$resq] потратив $gg <img src='/images/icon/gold.png'/>  </div>";
				header("Location:?page=buy");
				exit;

			}

			
		}
			?>
			
			<div class='main block'/>
			Цена за каждый ресурс по: <?=$sellres;?> <img src='/images/icon/gold.png'/>
			</div>
			<?

			for ($i=1;$i<10;$i++){

				?>
			<div class='main block'>
 		 	<table cellpadding='0' cellspacing='0'>
			<tr>
  			<td><img src='/images/res/<?=$i?>.png' alt='*'/></td>
 		 	<td valign='top' style='padding-left: 5px;'><?=$resname[$i];?> (<?=$bazaar[$i]?> <font color='#9bc'>шт</font>)<br/><small>
 		 		<form action="?page=buy&amp;form" method="post"/>
 		 		<input type='hidden' value='<?=$i;?>' name='i'/>
 		 		<input type='text' class='text' name='pc' required/><br>
 		 		<span class='btn'><span class='end'><input class='label' type='submit' value='Купить'>Купить</span></span>
 		 		</form>
 		 	</small></td></tr></table>
			</div> 
			<div class='mini-line'/></div>

		<?
	}
	?>
	<div class='main menuList'/>
			<li>
				<a href='/auction.php'>Назад</a>
			</li>
			</div>
	<?
	break;

		

}

include 'system/f.php';
?>