
<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Рыбалка';    


include './system/h.php';  
 

	$next = array (200,500,800,2000,2500,7000,7000,8000,9000,15000,10000);


	$rod = array ('Простая Удочка','Необычная Удочка','Редкая Удочка','Элитная Удочка');

	$sha = array (0,5,10,20); //добавление шанса от удочки


	$xs = array (0,2,3,4); // умножение награды от удочки, отсчет с 0




















$fish = mysql_query('SELECT * FROM `fish` WHERE `user` = "'.$user['id'].'"');      
    $fish = mysql_fetch_array($fish);

if(!$fish) {

  mysql_query('INSERT INTO `fish` (`user`) VALUES ("'.$user['id'].'")');
header('location:/fish.php');

} 



if (isset($_GET['sell'])){


if($fish['level']<5){ header('location:/fish.php');}
if($fish['total']<=0){ header('location:/fish.php');}
mysql_query('UPDATE `users` SET `g` = `g` + '.$fish['total'].' WHERE `id` = "'.$user['id'].'"');   


mysql_query('UPDATE `fish` SET `total` = 0 WHERE `user` = "'.$user['id'].'"');   

$_SESSION['notic']='<center><font color=green>Вся рыба продана</font></center>'; header('location:/fish.php');

}
$bon = $fish['level']*10;//количество добавленных параметров  

if($fish['level']<=0){ $ch=10; }else{ $ch=10; $ch=$ch+2*$fish['level'];}



$ch = $ch + $sha[$fish['udo4ka']];

if($fish['udo4ka']!=0){ $iznos=''.$fish['iznos'].''; }else{ $iznos='отсутвует'; }







if($fish['status']==1 && $fish['time']<=time()){

$rand = mt_rand(1,100);




if($ch<=$rand){


if($fish['udo4ka']>0){ $rand_exp=mt_rand(20,30); $rand_exp = $rand_exp*$xs[$fish['udo4ka']];   $rand_mon=mt_rand(50,100); $rand_mon = $rand_mon*$xs[$fish['udo4ka']]; }else{ $rand_exp=mt_rand(20,30);   $rand_mon=mt_rand(50,100); }




$inf_fish = array('Судак','Карп','Карась','Плотва','Сом'); 
shuffle($inf_fish);



if($fish['level']<10){      mysql_query('UPDATE `fish` SET `pop` = `pop` + '.$rand_exp.',`total`=`total`+1, `iznos`=`iznos`-1 WHERE `user` = "'.$user['id'].'"');   






}else{ mysql_query('UPDATE `fish` SET `total`=`total`+1, `iznos`=`iznos`-1 WHERE `user` = "'.$user['id'].'"'); }  





     mysql_query('UPDATE `users` SET `s` = `s` + '.$rand_mon.',`exp`=`exp`+'.$rand_exp.' WHERE `id` = "'.$user['id'].'"');  

$_SESSION['inf']='<div class="content" align="center"> Ваш Улов: <img src="fish/fish.png" width="12"> <font color=green>'.$inf_fish[0].'</font> <img src="/images/icon/exp.png"> '.$rand_exp.' <img src="images/icon/silver.png"> '.$rand_mon.'</div>';
















}else{
mysql_query('UPDATE `fish` SET `iznos`=`iznos`-2 WHERE `user` = "'.$user['id'].'"');  

$_SESSION['inf']='<div class="content" align="center"><img src="fish/fish.png" width="12"> <font color=red>Эх Сорвалась!!</font></div>';




}
mysql_query('UPDATE `fish` SET `status` = "0" WHERE `user` = "'.$user['id'].'"');
header('location:/fish.php');


}




if (isset($_GET['go'])){


if($fish['status']==1){ header('location:/fish.php');}

mysql_query('UPDATE `fish` SET `status` = "1",
`time` = "'.(time() + 120).'" WHERE `user` = "'.$user['id'].'"');







  
  header('location: /fish.php');

  
  

}





if($fish['udo4ka']>0 and $fish['iznos']<=0){


mysql_query('UPDATE `fish` SET `udo4ka` = 0 WHERE `user` = "'.$user['id'].'"');   


$_SESSION['notic']='<font color=red>Удочка полностью сломана</font>'; }

if($fish['level']<10){





if($fish['pop']>=$next[$fish['level']]){




mysql_query('UPDATE `fish` SET `pop` = 0,`level`=`level`+1 WHERE `user` = "'.$user['id'].'"');   

mysql_query('UPDATE `users` SET `str` = `str`+10,`vit`=`vit`+10,`agi`=`agi`+10,`def`=`def`+10 WHERE `id` = "'.$user['id'].'"');   

$_SESSION['notic']='<div class="content" align="center"> <font color=green>Навык Повышен</font></div>';

}

 } 













  if (isset($_SESSION['notic'])){?><?=$_SESSION['notic']?><?   $_SESSION['notic']=NULL; }
?><div class='content' align='center'><img src="/fish/old.png " width="100%"></div><?
  if (isset($_SESSION['inf'])){?><?=$_SESSION['inf']?><?   $_SESSION['inf']=NULL; }

if($fish['status']==0){
?><div class='content' align='center'>

<a href='fish.php?go' class='button'>Закинуть Удочку</a><br/>



 </div><?
}else{
?><div class='content' align='center'><img src="fish/ud.png"> <font color=green>Удочка заброшена, дождитесь результата (Осталось: <?=_time($fish['time'] - time())?>) </font></div><? }



?><div class='content' align='center'><a href='/fish.php?' class='button'>Обновить</a></div><?


if($fish['level']>4 and $fish['total']>10){ ?> <div class='content' align='center'><a href='fish.php?sell' class='button'>Продать Всю рыбу <img src='/images/icon/gold.png' alt='*'/> <?=$fish['total']?> золота</a></div> <? }



?><div class='line'></div>


<div class='content'>

<table>
        <tr>
            <td style="width: 45px;"><img src="fish/ud/<?=$fish['udo4ka']?>.jpg"></td>



<td>
<?=$rod[$fish['udo4ka']]?><font color='#90c090'><b>(Износ: <?=$iznos?>) </b>    <a href="buy_rod.php">(Сменить Удочку)</a>

















                </div>
            </td>
        </tr></table














 
 

<div class='line'></div><?
if($fish['level']<10){ $prog ='Прогресс '.$fish['pop'].'/'.$next[$fish['level']].'';}else{ $prog=' Всего Поймано: '.$fish['total'].'';}




?><div class='line'></div><div class='content'>    <table>

        <tr>
            <td style="width: 45px;"><img src="fish/lvl.png"></td>



<td>
Навык Рыболова(<?=$fish['level']?>) </br>  Бонус ко всем параметрам  <font color='#90c090'><b>+<?=$bon?> </b></font><br> <font color=green>Шанс Улова: <?=$ch?>%</font>  <br><?=$prog?>















                </div>
            </td>
        </tr>
</table><?


















include './system/f.php';
