

<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Покупка Удочки';    



include './system/h.php';  
 










	$rod = array ('Простая Удочка','Необычная Удочка','Редкая Удочка','Элитная Удочка');


	$pic = array (0,50,250,500); // цена на починку


	$rem = array (0,20,50,100); // износ удочек

  if (isset($_SESSION['we'])){?><?=$_SESSION['we']?><?   $_SESSION['we']=NULL; }





$fish = mysql_query('SELECT * FROM `fish` WHERE `user` = "'.$user['id'].'"');      
    $fish = mysql_fetch_array($fish);

if(!$fish) {

  mysql_query('INSERT INTO `fish` (`user`) VALUES ("'.$user['id'].'")');
header('location:/fish.php');

}


$bs = $rem[$fish['udo4ka']];

$bsg = $pic[$fish['udo4ka']];
if(isset($_GET['rem'])){


if($fish['level']<5){  header('location:/buy_rod.php'); }

if($user['g']< $pic[$fish['udo4ka']]){ $_SESSION['we']='<center><font color=red>Недостаточно Золота</font></center>';  header('location:/buy_rod.php'); }


mysql_query('UPDATE `fish` SET `iznos`='.$bs.' WHERE `user` = "'.$user['id'].'"');   
mysql_query('UPDATE `users` SET `g` = `g` - '.$bsg.' WHERE `id` = "'.$user['id'].'"');   
$_SESSION['we']='<center><font color=green>Удочка успешно починена!</font></center>'; header('location:/buy_rod.php');

}
if(isset($_GET['buy']) and !empty($_GET['id'])){

$vib = $_GET['id'];


$_SESSION['notic']=''.$vib.'';


if($vib==1){ $udo4ka=1; $iznos=20; $gold=100; }


elseif($vib==2){ $udo4ka=2; $iznos=50; $gold=500; }

elseif($vib==3){ $udo4ka=3; $iznos=100; $gold=1000; }
else{ header('location:/fish.php');}


if($user['g']<$gold){ 
$_SESSION['we']='Недостаточно Золота!';
header('location:/buy_rod.php');}


mysql_query('UPDATE `fish` SET `udo4ka` ='.$udo4ka.',`iznos`='.$iznos.' WHERE `user` = "'.$user['id'].'"');   


mysql_query('UPDATE `users` SET `g` = `g` - '.$gold.' WHERE `id` = "'.$user['id'].'"');   



$_SESSION['notic']='<center><font color=green>Вы купили новую удочку!</font></center>';
header('location:/fish.php');





}
?><div class='line'></div><div class='content'> 
  <table cellpadding='0' cellspacing='0'><tr><td><img src='/fish/ud/0.jpg' alt='*'/></td> 

  <td valign='top' style='padding-left: 5px;'>Простая Удочка</a><br/> 



  <font color='#60c030'><b>Эффекты:</b></font> <font color='#30c030'>Нет</font></td> 



  </tr></table> 
  <br/> 
 

</div> <?
?><div class='line'></div><div class='content'> 
  <table cellpadding='0' cellspacing='0'><tr><td><img src='/fish/ud/1.jpg' alt='*'/></td> 


  <td valign='top' style='padding-left: 5px;'>Хорошая Удочка</a><br/> 



<font color='#60c030'><b>Эффекты:</b></font> <font color='#30c030'>Шанс Улова +5% Награда за улов Х2, Износ: 20</font></td> 



  </tr></table> 
  <br/> 
  <div align='center'><a href='buy_rod.php?id=1&amp;buy' class='button'>Купить за <img src='/images/icon/gold.png' alt='*'/> 100 золота</a></div> 




</div> <? 
?><div class='line'></div><div class='content'> 
  <table cellpadding='0' cellspacing='0'><tr><td><img src='/fish/ud/2.jpg' alt='*'/></td> 


  <td valign='top' style='padding-left: 5px;'>Редкая Удочка</a><br/> 



<font color='#60c030'><b>Эффекты:</b></font> <font color='#30c030'>Шанс Улова +10% Награда за улов Х3, Износ: 50</font></td> 



  </tr></table> 
  <br/> 
  <div align='center'><a href='buy_rod.php?id=2&amp;buy' class='button'>Купить за <img src='/images/icon/gold.png' alt='*'/> 500 золота</a></div> 



</div> <?  
?><div class='line'></div><div class='content'> 
  <table cellpadding='0' cellspacing='0'><tr><td><img src='/fish/ud/3.jpg' alt='*'/></td> 


  <td valign='top' style='padding-left: 5px;'>Элитная Удочка</a><br/> 



<font color='#60c030'><b>Эффекты:</b></font> <font color='#30c030'>Шанс Улова +20% Награда за улов Х4, Износ: 100</font></td> 



  </tr></table> 
  <br/> 
  <div align='center'><a href='buy_rod.php?id=3&amp;buy' class='button'>Купить за <img src='/images/icon/gold.png' alt='*'/> 1000 золота</a></div> 


</div> <?   
if($fish['level']>=5 and $fish['iznos']<10){ 
?><div class='line'></div><div class='content'> 
<center><font color=green>Ваша Удочка</font></center> <table cellpadding='0' cellspacing='0'><tr><td><img src='/fish/ud/<?=$fish['udo4ka']?>.jpg' alt='*'/></td> 



  <td valign='top' style='padding-left: 5px;'><?=$rod[$fish['udo4ka']]?></a><br/> 




<font color='#60c030'><b>Износ:</b></font> <font color='#30c030'><?=$fish['iznos']?></font></td> 




  </tr></table> 
  <br/> 
  <div align='center'><a href='buy_rod.php?rem' class='button'>Починить за <img src='/images/icon/gold.png' alt='*'/> <?=$pic[$fish['udo4ka']]?> золота</a></div> 



</div> <? 
}
include './system/f.php';
