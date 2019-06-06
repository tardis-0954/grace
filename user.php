<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
  exit;

}

$id = _string(_num($_GET['id']));
  if($id) {
    $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $i = mysql_fetch_array($i);
    
    if(!$i) {
      header('location: /user/');
      exit;
    }

    }
    else
    { 
      $i = $user;
    }
    
    $title = $i['login'];


include './system/h.php';
if($_GET['md'] == yes && $user['access'] == 2) {
mysql_query("update `users` set `access` = 1 where `id` = '".$i['id']."'");
header('location: ?');
exit();
}
if($_GET['adm'] == yes && $user['access'] == 2) {
mysql_query("update `users` set `access` = 2 where `id` = '".$i['id']."'");
header('location: ?');
exit();
}
if($_GET['md'] == no && $user['access'] == 2) {
mysql_query("update `users` set `access` = 0 where `id` = '".$i['id']."'");
header('location: ?');
exit();
}
echo '<div class="main">';
$mypets = mysql_fetch_assoc(mysql_query("SELECT * FROM `pets_user` WHERE `user` = '".$i['id']."'"));
$w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_1'].'"');
$w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
  $w_1['item'] = 0;
}
$w_1_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_1['item'].'"');
$w_1_item = mysql_fetch_array($w_1_item);

$w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_2'].'"');
$w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
  $w_2['item'] = 0;
}

$w_2_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_2['item'].'"');
$w_2_item = mysql_fetch_array($w_2_item);

$w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_3'].'"');
$w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
  $w_3['item'] = 0;
}

$w_3_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_3['item'].'"');
$w_3_item = mysql_fetch_array($w_3_item);


$w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_4'].'"');
$w_4 = mysql_fetch_array($w_4);

if(!$w_4) {
  $w_4['item'] = 0;
}

$w_4_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_4['item'].'"');
$w_4_item = mysql_fetch_array($w_4_item);

$w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_5'].'"');
$w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
  $w_5['item'] = 0;
}
$w_5_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_5['item'].'"');
$w_5_item = mysql_fetch_array($w_5_item);

$w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_6'].'"');
$w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
  $w_6['item'] = 0;
}
$w_6_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_6['item'].'"');
$w_6_item = mysql_fetch_array($w_6_item);

$w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_7'].'"');
$w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
  $w_7['item'] = 0;
}
$w_7_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_7['item'].'"');
$w_7_item = mysql_fetch_array($w_7_item);

$w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_8'].'"');
$w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
  $w_8['item'] = 0;
}
$w_8_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_8['item'].'"');
$w_8_item = mysql_fetch_array($w_8_item);


  $i_clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$i['id'].'"');
  $i_clan_memb = mysql_fetch_array($i_clan_memb);
  
    if(!$i_clan_memb) {
    
    if($clan && $clan_memb['rank'] >= $clan['rank_for_invite'] && $clan['r'] == $i['r'] && $_GET['clan_invite'] == true) {
    
    if(mysql_result(mysql_query('SELECT COUNT(`id`) FROM `clan_invite` WHERE `user` = "'.$i['id'].'" AND `clan` = "'.$clan['id'].'"'),0) == 0) {
      mysql_query('INSERT INTO `clan_invite` (`clan`,
                                              `user`) VALUES ("'.$clan['id'].'",
                                                                 "'.$i['id'].'")');
?>

<div class='content' align='center'><img src='/images/icon/ok.png' alt='*'/> <font color='#30c030'>Приглашение отправлено!</font></div><div class='line'></div>

<?

    }
    else
    {
    
    }

  
    }
  
  }
  
?>

<div class='content'>
<?
if($i['access'] == 1) {
?>
<p>Модератор</p>
<?
}
?>
<?
if($i['access'] == 2) {
?>
<p>Администратор</p>
<?
}
?>
<img src='/images/icon/race/<?=$i['r'].($i['online'] > (time() - 86400) ? '':'-off')?>.png' alt='*'/> <b><?=$i['login']?></b> <img src='/images/icon/level.png' alt='*'/> <?=$i['level']?> ур, <?=($i['r'] == 0 ? 'Асура':'Борея')?><br/>

<?

  if($i_clan_memb) {

    $i_clan = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$i_clan_memb['clan'].'"');
    $i_clan = mysql_fetch_array($i_clan);

  switch($i_clan_memb['rank']) {
  
    case 0:
    $rank = 'Новобранец';
     break;
    case 1:
    $rank = 'Боец';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 4:
    $rank = '<font color=\'#30c030\'>Лидер клана</font>';
     break;
    
  }

?>

<img src='/images/icon/clan/<?=$i_clan['r']?>.png' alt='*'/> <a href='/clan/<?=$i_clan['id']?>/'><?=$i_clan['name']?></a>, <?=$rank?><br/>

<?

  }

?>

  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td><img src='/manekenImage/<?=$i['sex']?>/<?=$w_1['item']?>/<?=$w_2['item']?>/<?=$w_3['item']?>/<?=$w_4['item']?>/<?=$w_5['item']?>/<?=$w_6['item']?>/<?=$w_7['item']?>/<?=$w_8['item']?>/' alt='*'/>
 </td>
  <td valign='top' style='padding: 5px 0px 0px 5px;'>

    <img src='/images/icon/str.png' alt='*'/>   Сила: <?=$i['str']?><br/>
    <img src='/images/icon/vit.png' alt='*'/>  Жизнь: <?=$i['vit']?><br/>
    <img src='/images/icon/agi.png' alt='*'/>  Удача: <?=$i['agi']?><br/>
    <img src='/images/icon/def.png' alt='*'/> Защита: <?=$i['def']?><br/>
    <img src='/images/icon/mana.png' alt='*'/>  Мана: <?=$i['mana']?>
 
 
 </td>
 </tr></table>

<?

  $all_ability = 0;

  if($i['ability_1'] > 0) {
    $all_ability += 1;
?>
  <img src='/images/ability/1.<?=$i['ability_1_quality']?>.png' width='25px' height='25px' alt='*'/>
<?
  }
  if($i['ability_2'] > 0) {
    $all_ability += 1;
?>
  <img src='/images/ability/2.<?=$i['ability_2_quality']?>.png' width='25px' height='25px' alt='*'/>
<?
  }
  if($i['ability_3'] > 0) {
    $all_ability += 1;
?>
  <img src='/images/ability/3.<?=$i['ability_3_quality']?>.png' width='25px' height='25px' alt='*'/>
<?
  }
  if($i['ability_4'] > 0) {
    $all_ability += 1;
?>
  <img src='/images/ability/4.<?=$i['ability_4_quality']?>.png' width='25px' height='25px' alt='*'/>
<?
  }
  if($i['ability_5'] > 0) {
    $all_ability += 1;
?>
  <img src='/images/ability/5.<?=$i['ability_5_quality']?>.png' width='25px' height='25px' alt='*'/>
<?
  }
?>



<div class='mini-line'></div>

<?

  $equips = 0;

  if($i['w_1']) {
    $equips++;
  }
  if($i['w_2']) {
    $equips++;
  }
  if($i['w_3']) {
    $equips++;
  }
  if($i['w_4']) {
    $equips++;
  }
  if($i['w_5']) {
    $equips++;
  }
  if($i['w_6']) {
    $equips++;
  }
  if($i['w_7']) {
    $equips++;
  }
  if($i['w_8']) {
    $equips++;
  }

?>
<?
if($mypets['id'] != 0) {
?>
<div class="block">
<img src="/images/pets/<?=$mypets['img'];?>.png" height="100" width="80"> <br>
Питомец: <?=$mypets['name'];?> <br>
  <img src="/images/icon/str.png"> Сила: <?=$mypets['sila'];?></br>
<img src="/images/icon/def.png"> Защита: <?=$mypets['def'];?></br>
<img src="/images/icon/vit.png"> Здоровье: <?=$mypets['hp'];?>/<?=$mypets['max_hp'];?>
</div></div></div>
<?
}
?>
<?
  if($i['id'] == $user['id']) {
?>

</div></div></div><table style='width:100%;'><tr>
<td style="25%">
<a class="small-but" href='/mail/'>
<div class="imgwrap"><img src="/rusalc/zadan.jpg"></div>
<span>Сообщения</span></a>
</td>	
	
<td style="25%">
<a class="small-but" href="/settings/">
<div class="imgwrap"><img src="/rusalc/zadan.jpg"></div>
<span>Настройки</span></a>
</td>	


<td style="25%">
<a class="small-but" href="/train/">
<div class="imgwrap"><img src="/rusalc/tavern.jpg"></div>
<span>	Параметры	</span></a>
</td>	

</tr></table>
<?
}
?>















<div class='index_user'><a href='/equip/<?=$i['id']?>/'><img src='/images/icon/equip.png' alt='*'/> Снаряжение (<?=$equips?>/8)</a></div></div>



<?
  if($i['id'] == $user['id']) {
?>

<?
  if($user['level'] > 0) {
?>
<div class='index_user'><a href='/ability/<?=$i['id']?>/'><img src='/images/icon/seif.png' alt='*'/> Умения (<?=$all_ability?>/4)</a></div>
<?
  }
?>
<div class='index_user'><a href='/inv/bag/'> <img src='/images/icon/bag.png' alt='*'/> Сумка  (<?=mysql_result(mysql_query('SELECT COUNT(`id`) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "0"'),0)?>/20) <?=(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "0" AND `new` = "0"'),0) > 0 ? '<font color=\'#30c030\'>(+)</font>':'')?></a></div>
<?
  if($user['chest'] == 1) {
?>
<div class='index_user'><a href='/inv/chest/'> <img src='/images/icon/bag.png' alt='*'/> Сундук (<?=mysql_result(mysql_query('SELECT COUNT(`id`) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "1"'),0)?>/20) <?=(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "1" AND `new` = "0"'),0) > 0 ? '<font color=\'#30c030\'>(+)</font>':'')?> </a></div>
<?
  }

  $sack = mysql_query('SELECT * FROM `sack` WHERE `user` = "'.$user['id'].'"');      
  $sack = mysql_fetch_array($sack);
  
  $resources = 0;
  
  for($resource = 1; $resource < 10; $resource++) {

    if($sack[$resource] > 0) {

      $resources++;

    }

  }
?>
    <div class='index_user'><a href='/pets/pets.php'><img src='/images/pets/icon.gif' alt='*'/> Питомец</a></div>
  <div class='index_user'><a href='/sack/'><img src='/images/icon/res.png' alt='*'/> Ресурсы (<?=$resources?>/9)</a></div>

</div>


<?

  }
  else
  {

?>


<?
if($i['id'] != $user['id'] && $user['id'] == 1) {
?>

<?
}
?>
<?
if(!$i_clan_memb && $clan && $clan_memb['rank'] >= $clan['rank_for_invite'] && $clan['r'] == $i['r']) {
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_invite` WHERE `user` = "'.$i['id'].'" AND `clan` = "'.$clan['id'].'"'),0) == 0) {
?>
<div class='index_menu'><a href='/user/<?=$i['id']?>/?clan_invite=true'><img src='/images/icon/clan.png' alt='*'/> Пригласить в клан</a></div>
<?
}
}
?>
<div class='index_menu'>  <a href='/mail/<?=$i['id']?>/'><img src='/images/icon/mail.png' alt='*'/> Отправить почту</a></div>

<?
}
?>
</div>
 


<div class='content'>







<?
if($user['id'] == $i['id'] OR !$i['id']) {
?>
<img src='/images/icon/arrow.png' alt='*'/> Опыт: <?=n_f($user['exp'])?>/<?=n_f($exp)?> (<?=$exp_progress?>%)<br/>
<?
}
?>
<img src='/images/icon/arrow.png' alt='*'/> Рейтинг дуэлей: <?=n_f($i['duel_rating'])?><br/>
<img src='/images/icon/arrow.png' alt='*'/> Рейтинг колизея: <?=n_f($i['coliseum_rating'])?><br>
<img src='/images/icon/arrow.png' alt='*'/> Сообщений в чате: <?=n_f($i['chat_msg'])?><br/>
<img src='/images/icon/arrow.png' alt='*'/> Получено золота за общение в чате: <?=n_f($i['chat_msg'])?> <img src='/images/icon/gold.png' alt='*'/> <br/>
<?
if($i_clan_memb) {
?>
<img src='/images/icon/arrow.png' alt='*'/> Бонус клан. опыта: <?=$i_clan_memb['v']?>%</a>
</div>
</div>
<?
}
include './system/f.php';

?>