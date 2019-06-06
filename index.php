<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
        
    $title = 'Главная'; 

   include './system/h.php';  


    if($user) {
  
?>

<?

?>

<div class='wrappers'><img src='/rusalc/2222.png' width='100%' alt='start'></div>



<?
echo "<table style='width:100%;'><tr>";
echo'<td style="25%">
<a class="small-but" href="/arena/">
<div class="imgwrap"><img src="/rusalc/gl.jpg"></div>
<span>	Арена	</span></a>
</td>	';
	
echo'<td style="25%">
<a class="small-but" href="/duel/">
<div class="imgwrap"><img src="/rusalc/zadan.jpg"></div>
<span>Дуэли</span></a>
</td>	';


echo'<td style="25%">
<a class="small-but" href="/coliseum/">
<div class="imgwrap"><img src="/rusalc/tavern.jpg"></div>
<span>	Колизей	</span></a>
</td>	';

echo "</tr></table>";
?>

<?
$undying = mysql_query('SELECT * FROM `undying` WHERE `start` = "0" LIMIT 1');
$undying = mysql_fetch_array($undying);  
?>

 <div class='index_menu'><a href='/undying/'><img src='/images/icon/bar.png' alt='*'/> Долина бессмертных 

<?
  
  if($undying) {

   $undying_time = round(($undying['time'] - time()) / 3600);
if($undying_time > 1) {

?>

<font color='#909090'>(< <?=$undying_time?> час<?=($undying_time > 1 ? 'ов':'а')?>)</font>

<?

}
else
{

?>

<font color='#909090'>(<?=_time(($undying['time'] - time()))?>)</font></div>

<?

}

  }

?>

  </a>
<?

  $cave = mysql_query('SELECT * FROM `cave` WHERE `user` = "'.$user['id'].'"');
  $cave = mysql_fetch_array($cave);

?>
 </div><div class='index_menu'><a href='/cave/'><img src='/images/icon/cave.png' alt='*'/> Пещера <?=(($cave['dawn'] == 0 OR $cave['dawn'] == 1 && $cave['time'] <= time() OR $cave['dawn'] == 1 && $cave['gather'] == 1 && $cave['time'] <= time()) ? '<font color="#30c030">(+)</font>':'')?></a>

</div>





<div class='index_menu'><a href='/auction.php' style='display: block;'><img src='/images/icon/res.png' alt='*'/>  Аукцион ресурсов</a></span></div>



<div class='index_menu'><a href='/fights_pet.php' style='display: block;'><img src='/images/pets/icon.gif' alt='*' width='11'/>  Битва питомцев</a></span></div>

<div class='index_menu'><a href='/fregold.php' style='display: block;'><img src='/images/icon/gold.png' alt='*'/>  Добыча золота</a></li></span></div>


<div class='index_menu'><a href='/fights_city.php' style='display: block;'><img src='/images/citywar.png' alt='*'/>  Битва за город</a></div>
</span>

<div class='index_menu'><a href='/fish.php' style='display: block;'><img src='/fish/fish.png' alt='*'/>  Рыбалка</a></span></div>

<div class='index_menu'><a href='/trade/' style='display: block;'><img src='/images/icon/gold.png' alt='*'/>  Получить золото</span> <font color='#30c030'>(+)</font> </a></div>
<div class='index_menu'><a href='/shop/' style='display: block;'><img src='/images/icon/equip.png' alt='*'/> Магазин снаряжения</a></div>
<?

if($user['level'] > 0) {

?>

<div class='index_menu'><a href='/farm/' style='display: block;'><img src='/images/icon/farm.png' alt='*'/> Поход

<?

  $farm = mysql_query('SELECT * FROM `farm` WHERE `user` = "'.$user['id'].'"');
  $farm = mysql_fetch_array($farm);

  if(!$farm OR $farm['h'] == 0 && $farm['time'] == 0 OR $farm['h'] > 0 && $farm['time'] <= time()) {

?>

<font color='#30c030'>(+)</font>

<?

  }
  
  }

?>
  
  </a>

</div><div class='index_menu'><a href='/smith/' style='display: block;'><img src='/images/icon/smith.png' alt='*'/> Кузница</a></div>

<div class='index_menu'><a href='/lab/' style='display: block;'><img src='/images/icon/lab.png' alt='*'/> Лаборатория</a></div>


<div class='index_menu'><a href='/clans/' style='display: block;'><img src='/images/icon/clan.png' alt='*'/> Кланы</a>

</div>
</div>

<?

    if(isSet($_GET['exit'])) {
    
        setCookie('id', '');
  setCookie('password', '');
    
    header('location: /');
    
    }
    


    }
    else
    {


$login = _string($_POST['login']);
  $login = strToLower($login);

    $password = _string($_POST['password']);


    if($login && $password) {
    
    $q = mysql_query('SELECT * FROM `users` WHERE `login` = "'.$login.'" AND `password` = "'.$password.'" LIMIT 1');
 
 $user = mysql_fetch_array($q);
      
      if($user) {
    
    setCookie('id', $user['id'], time() + 86400 * 365, '/');
setCookie('password', $password, time() + 86400 * 365, '/');
    
         header('location: /');
 
      
      }
    
    }

$ref = _string(_num($_GET['ref']));

?>
<div><div class='main' style='word-wrap:break-word;'><span style='text-shadow:none;'></span><div class='center'><img src='/images/town/hd/main.jpg' width='100%' alt=''/></div><div class='block_zero center'><h1>Сражайся вместе с нами</h1><span class='medium'>Впервые на мобильниках. Игра, о которой ходят легенды<br/>Теперь к легенде можешь прикоснуться и ты!</span><div class='mb10'></div><h1 class='yellow'>В игре уже <?=n_f(mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0))?>  игроков!</h1></div><div class='mini-line' style='margin-top:5px;'></div><div class='block_zero center' style='padding-top:15px;'><div class='bigBtn'><a class='btn' href='/start/<?=$ref?>'><span class='end'><span class='label'><span class='green'>Начать свой путь</span></span></span></a></div></div><div class='separ'></div>
<?
if($_GET['sign_in'] == 1) {
?>
<div class='content' align='center'>
  <form action='?' method='post'>
    Имя персонажа:<br/>   <input name="login" value="" size="20" maxlength="255" class="text"><br/>
           Пароль:<br/>   <input name="password" value="" size="20" maxlength="255" type="password" class="text"><br>
<span class='btn'><span class='end'><input class='label' type='submit' value='Войти'>Войти</span></span>
</form></div>
<?
}
?>
<div class='block_zero center' style='padding:12px;'>
<?
if($_GET['sign_in'] != 1) {
?>
<a class='btn' href='/?sign_in=1'><span class='end'><span class='label'>Войти</span></span></a>
<?
}
?>
</div></div><div class='mini-line'></div><div class='foots'><div class='center'><img src='/images/icon/2hit.png' alt=''/> <span class='bold'>Об игре</span> <img src='/images/icon/2hit.png' alt=''/></div><ul>«Битва титанов» - захватывающая игра, для мобильных телефонов<br/>Сражения, приключения, общение, любовь - всё это, неотъемлемая часть нашего мира</ul></div></div>
<?

    }
    
include './system/f.php';

?>