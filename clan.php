<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

$id = _string(_num($_GET['id']));

if(!$id && $clan) {
    $id = $clan['id'];
}

  $i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);

  if(!$i) {
  
      header('location: /clans/');
  
  exit;
  
  }

switch($_GET['action']) {
  default:

    $title = 'Клан "'.$i['name'].'"';    

include './system/h.php';

?>

<div class='main'>
<?

if($clan && $clan['id'] == $i['id'] && $clan_memb['rank'] == 4 && $_GET['adm'] == true) {
  $text = _string($_POST['text']);
  if($text) {
    mysql_query('INSERT INTO `clan_msg` (`clan`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$clan['id'].'",
                                                             "'.$user['id'].'",
                                                                   "'.$text.'",
                                                                   "'.time().'")');
    header('location: /clan/');  
  }

?>

<div class='block_zero'>
<form action='/clan/?adm=true' method='post'>
  Новое обьявление:<br/> <input name='text' class='text'/> <br>
<span class='btn'><span class='end'><input class='label' type='submit' value='Отправить'>Отправить</span></span>
</form>
</div>
 <div class='mini-line'></div>

<?

  }

?>

<div class='block_zero'>

<?

  $_exp = round(100 / (clan_exp($i['level']) / $i['exp']));

  if($_exp > 100) {
  
     $_exp = 100;
  
  }

?>

<table cellpadding='0' cellspacing='0'><tr>
<td>

<?

  if($clan && $clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>

<a href='/clan/gerb/'>

<?

  }

?>

<img src='/images/icon/clan/gerb/<?=$i['gerb']?>.png' alt='*'/>

<?

  if($clan && $clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>

</a>

<?

  }

?>

</td><td valign='top' style='padding-left: 5px;'><img src='/images/icon/clan/<?=$i['r']?>.png' alt=''*/> <b><?=$i['name']?></b><br/>

<img src='/images/icon/level.png'/> Уровень: <b><?=$i['level']?></b><br/>
<img src='/images/icon/exp.png' alt='*'/> Опыт: <?=n_f($i['exp'])?> / <?=n_f(clan_exp($i['level']))?> <font color='#999'>(<?=$_exp?>%)</font></td>
</tr></table>

</div>
<div class='mini-line'></div>

<?

if($clan['id'] == $i['id']) {

?>

<div class='menuList'>
<li><a href='/clan/built/'><img src='/images/icon/clan.png' alt='*'/>Статуя клана <?=($clan['built_1'] > 0 ? '<font color=\'#90c090\'><b>+'.$clan_buff.'</b> к параметрам':'')?></font></a>
</li><li>
<a href='/clan/money/'><img src='/images/icon/seif.png' alt='*'/>Казна клана: <img src='/images/icon/gold.png' alt='*'/> <?=n_f($clan['g'])?> <img src='/images/icon/silver.png' alt='*'/> <?=n_f($clan['s'])?></a>
</li>
<?

  $_chat = mysql_query('SELECT COUNT(*) FROM `chat` WHERE `clan` = "'.$clan['id'].'" AND `to` = "'.$user['id'].'" AND `read` = "0"');
  $_chat = mysql_result($_chat,0);

?>
<li>
<a href='/chat/clan/'><img src='/images/icon/chat.png' alt='*'/>Чат <?=($_chat > 0 ? '<font color=\'#3c3\'>(+)</font>':'')?></a></li>
</div>
<div class='mini-line'></div>
<?

}

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$i['id'].'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

?>

<div class='block_zero'>
  <b>Состав клана: (<?=$count?>)</b>

<?

if($count > 0) {

$q = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$i['id'].'" ORDER BY `rank` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {

  $memb = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $memb = mysql_fetch_array($memb);

  switch($row['rank']) {
  
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
    $rank = '<font color=\'#3c3\'>Лидер клана</font>';
     break;
    
  }

?>

<?
  
if($clan && $clan['id'] == $i['id'] && $row['user'] != $user['id'] && $clan_memb['rank'] == 4 && $_GET['adm'] == true) {

?>

<span style='float: right;'><a href='/clan/memb/<?=$row['id']?>/'>(»)</a></span>

<?

}

?> 

<p><img src='/images/icon/race/<?=$memb['r'],($memb['online'] > time() - 86400 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$row['user']?>/'><?=$memb['login']?></a>, <?=n_f($row['exp'])?> - <?=$rank?></p>

<?

  }

?>

</div><div class='main'><div class='block'><?=pages('/clan/'.$i['id'].'/'.($_GET['adm'] == true ? '?adm=true&':'?'))?></div></div>

<?
  
  }
  else
  {
 
?>


<?

  }

?>

<?

if($clan && $clan['id'] == $i['id']) {

  if(isSet($_GET['exit']) && $clan_memb['rank'] != 4) {
  
  mysql_query('DELETE FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
    
    header('location: /clans/');

  exit;

  }

?>

<div class='mini-line'></div>
<div class='menuList'>

<?

if($clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>

  <li><a href='/clan/<?=($_GET['adm'] == true ? '':'?adm=true')?>' <?=($_GET['adm'] == true ? 'style="color:#999;"':'')?>><img src='/images/icon/arrow.png' alt='*'/> <?=($_GET['adm'] == true ? 'Скрыть управление':'Управление кланом')?></a></li>

<?

  }

?>

  <li><a href='/clan/?exit'><img src='/images/icon/arrow.png' alt='*'/> Покинуть клан</a></li>

</div>

<?

}

?>

<?

if($clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>

 <div class='mini-line'></div>
<div class='block_zero'>

<?

  if($_POST['change_rank_for_invite']) {
  
    $rank = _string(_num($_POST['rank']));
    
    mysql_query('UPDATE `clans` SET `rank_for_invite` = "'.$rank.'" WHERE `id` = "'.$clan['id'].'"');
  
  
    header('location: /clan/');
  
  }

?>

  Приглашать в клан может:<br/>
   <form action='/clan/' method='post'>
   <select name='rank'>
   <option value='0'>Новобранец</option>
   <option value='1'>Боец</option>
   <option value='2'>Офицер</option>
   <option value='3'>Генерал</option>
   <option value='4'>Лидер клана</option>
   </select><br/>
    <span class='btn'><span class='end'>
    <input class='label' type='submit' value='Сохранить' name='change_rank_for_invite'></span></span></span>
   </form>
</div>
<div class='block_zero'>

<?

  if($_POST['change_rank_for_delete']) {
  
    $rank = _string(_num($_POST['rank']));
    
    mysql_query('UPDATE `clans` SET `rank_for_delete` = "'.$rank.'" WHERE `id` = "'.$clan['id'].'"');
  
  
    header('location: /clan/');
  
  }

?>

   Удалять из клана может:<br/>
   <form action='/clan/' method='post'>
   <select name='rank'>
   <option value='0'>Новобранец</option>
   <option value='1'>Боец</option>
   <option value='2'>Офицер</option>
   <option value='3'>Генерал</option>
   <option value='4'>Лидер клана</option>
   </select><br/>
     <span class='btn'><span class='end'>
   <input class='label' type='submit' value='Сохранить' name='change_rank_for_delete'/></span></span>
   </form>
</div>
 <div class='mini-line'></div>
<div class='block_zero'>

<?

  if($_POST['change_name']) {
  
    if($clan['g'] < 500) {
    
      header('location: /clan/');
     
    exit;
    
    }
    
    $name = _string($_POST['name']);
    
    if($name) {
    
    mysql_query('UPDATE `clans` SET `g` = `g` - 500,
                                 `name` = "'.$name.'" WHERE `id` = "'.$clan['id'].'"');
  
    }
  
    header('location: /clan/');
  
  }

?>

  <form action='/clan/?change_name=true' method='post'>
  Новое название:<br/>
  <input name='name' class='text'/> <br>
<span class='btn'><span class='end'>
<input class='label' type='submit' value='Сохранить' name='change_name'/></span></span>
  </form>
</div>
</div>
<?

}
  
include './system/f.php';
  break;



  case 'money':
    $title = 'Казна клана';    

include './system/h.php';  

if(!$clan['id'] OR $clan['id'] != $i['id']) {

  header('location: /clan/');

exit;

}

$g = _string(_num($_POST['g']));

$s = _string(_num($_POST['s']));

  if($g OR $s) {
    if($g && $user['g'] >= $g) {
    
      mysql_query('UPDATE `clans` SET `g` = `g` + '.$g.' WHERE `id` = "'.$clan['id'].'"');
      mysql_query('UPDATE `users` SET `g` = `g` - '.$g.' WHERE `id` = "'.$user['id'].'"');
    
    }
    
    if($s && $user['s'] >= $s) {
      
      mysql_query('UPDATE `clans` SET `s` = `s` + '.$s.' WHERE `id` = "'.$clan['id'].'"');
      mysql_query('UPDATE `users` SET `s` = `s` - '.$s.' WHERE `id` = "'.$user['id'].'"');
    
    }
  
  header('location: /clan/money/');
  
  }

?>
<div class='main'>
<div class='block_zero'>
   Казна клана: <img src='/images/icon/silver.png' alt='*'/> <?=n_f($i['s'])?> <img src='/images/icon/gold.png' alt='*'/> <?=n_f($i['g'])?><br/>
У вас на счету: <img src='/images/icon/silver.png' alt='*'/> <?=n_f($user['s'])?> <img src='/images/icon/gold.png' alt='*'/> <?=n_f($user['g'])?>
</div>
 <div class='mini-line'></div>
<div class='block_zero'>

<form action='/clan/money/' method='post'>
  <img src='/images/icon/gold.png' alt='*'/>   <input name='g' value='0' class='text'/><br/>
  <img src='/images/icon/silver.png' alt='*'/> <input name='s' value='0' class='text'/><br/>
  <span class='btn'><span class='end'>
  <input class='label' type='submit' value='Пополнить'/></span></span>
</form>
</div>
</div>

<?
include './system/f.php';
  break;

  case 'memb':

if(!$clan['id'] OR $clan['id'] == $i['id'] && $clan_memb['rank'] < 4) {

  header('location: /clan/');

exit;

}

$memb = _string(_num($_GET['memb']));

  $memb = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb.'"');
  $memb = mysql_fetch_array($memb);

  if(!$memb) {

  header('location: /clan/');

exit;
  
  }
  
  $memb_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$memb['user'].'"');
  $memb_user = mysql_fetch_array($memb_user);
  
    $title = $memb_user['login'];    

include './system/h.php';  

    if($memb['rank'] != 3 && $memb['rank'] < $clan_memb['rank']) {
  
  if($_GET['up'] == true) {
  
      mysql_query('UPDATE `clan_memb` SET `rank` = "'.($memb['rank'] + 1).'" WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb['id'].'"');

      header('location: /clan/memb/'.$memb['id'].'/');
  
  }
     
  }

  if($memb['rank'] < $clan_memb['rank'] && $memb['rank'] > 0) {

    if($_GET['down'] == true) {

      mysql_query('UPDATE `clan_memb` SET `rank` = "'.($memb['rank'] - 1).'" WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb['id'].'"');

        header('location: /clan/memb/'.$memb['id'].'/');

    }

  }

?>

<div class='main'>

<div class='block_zero'>

<?

  switch($memb['rank']) {
  
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
    $rank = '<font color=\'#3c3\'>Лидер клана</font>';
     break;
    
  }

?>

Звание: <?=$rank?><br/>
  <img src='/images/icon/exp.png' alt='*'/> Опыт: <?=n_f($memb['exp'])?><br/>
  <img src='/images/icon/gold.png' alt='*'/> <?=n_f($memb['g'])?><br/>
<img src='/images/icon/silver.png' alt='*'/> <?=n_f($memb['s'])?><br/>
Дата вступления: <?=date('d.m.y', $memb['time'])?>

</div>
<div class='mini-line'></div>
<div class='block_zero' align='center'>
<?

     if($memb['rank'] != 3 && $memb['rank'] < $clan_memb['rank']) {

?>
<a class='btn' href='/clan/memb/<?=$memb['id']?>/?up=true'><span class='end'><span class='label'>Повысить</span></span></a>

<?

  }

  if($memb['rank'] < $clan_memb['rank'] && $memb['rank'] > 0) {

?>
<a class='btn' href='/clan/memb/<?=$memb['id']?>/?down=true'><span class='end'><span class='label'>Понизить</span></span></a>

<?
  
  }


?>
</div>

<?

  if($clan_memb['rank'] == 4) {
  
    if($_GET['lider'] == true) {
    
      mysql_query('UPDATE `clan_memb` SET `rank` = "4" WHERE `id` = "'.$memb['id'].'"');
      mysql_query('UPDATE `clan_memb` SET `rank` = "3" WHERE `user` = "'.$user['id'].'"');
    
    header('location: /clan/');
    
    }
  
?>

<div class='mini-line'></div>
   <div class='block_zero' align='center'>
<a class='btn' href='/clan/memb/<?=$memb['id']?>/?lider=true'><span class='end'><span class='label'>Передать лидерство</span></span></a>

</div>

<?
  
  }

  if($memb['rank'] < $clan_memb['rank'] && $clan_memb['rank'] >= $clan['rank_for_delete']) {
  
  if($_GET['delete'] == true) {
  
    mysql_query('DELETE FROM `clan_memb` WHERE `id` = "'.$memb['id'].'"');
  
  header('location: /clan/');
  
  }
  
?>

<div class='mini-line'></div>
   <div class='block_zero' align='center'>
   <a class='btn' href='/clan/memb/<?=$memb['id']?>/?delete=true'><span class='end'><span class='label'>Исключить</span></span></a>
</div>
</div>
<?

  }

include './system/f.php';
  break;

  case 'built':
    $title = 'Статуя клана';    

include './system/h.php';  

if(!$clan['id'] OR $clan['id'] != $i['id']) {

  header('location: /clan/');

exit;

}

  $progress = round(100 / (34 / $i['built_1']));

  function cost($i) {
    
    switch($i) {
      case 0:
      $cost = 60000; 
       break;
      case 1:
      $cost = 60000; 
       break;
      case 2:
      $cost = 120000; 
       break;
      case 3:
      $cost = 180000; 
       break;
      case 4:
      $cost = 1800; 
       break;
      case 5:
      $cost = 120000; 
       break;
      case 6:
      $cost = 240000; 
       break;
      case 7:
      $cost = 360000; 
       break;
      case 8:
      $cost = 3600; 
       break;
      case 9:
      $cost = 180000; 
       break;
      case 10:
      $cost = 360000; 
       break;
      case 11:
      $cost = 540000; 
       break;
      case 12:
      $cost = 7200; 
       break;
      case 13:
      $cost = 240000; 
       break;
      case 14:
      $cost = 480000; 
       break;
      case 15:
      $cost = 720000; 
       break;
      case 16:
      $cost = 14400; 
       break;
      case 17:
      $cost = 300000; 
       break;
      case 18:
      $cost = 600000; 
       break;
      case 19:
      $cost = 900000; 
       break;
      case 20:
      $cost = 28800; 
       break;
      case 21:
      $cost = 360000; 
       break;
      case 22:
      $cost = 720000; 
       break;
      case 23:
      $cost = 1080000; 
       break;
      case 24:
      $cost = 57600; 
       break;
      case 25:
      $cost = 420000; 
       break;
      case 26:
      $cost = 840000; 
       break;
      case 27:
      $cost = 1260000; 
       break;
      case 28:
      $cost = 115200; 
       break;
      case 29:
      $cost = 480000; 
       break;
      case 30:
      $cost = 960000; 
       break;
      case 31:
      $cost = 230400; 
       break;
      case 32:
      $cost = 540000; 
       break;
      case 33:
      $cost = 1080000; 
       break;
      case 34:
      $cost = 1620000;
       break;
      case 35:
      $cost = 1620000;
       break;
    }
  
  return $cost;
  
  }
  
  function value($i) {
  
    switch($i) {
      case 0:
      $value = 0; 
       break;
      case 1:
      $value = 0; 
       break;
      case 2:
      $value = 0; 
       break;
      case 3:
      $value = 0; 
       break;
      case 4:
      $value = 1; 
       break;
      case 5:
      $value = 0; 
       break;
      case 6:
      $value = 0; 
       break;
      case 7:
      $value = 0; 
       break;
      case 8:
      $value = 1; 
       break;
      case 9:
      $value = 0; 
       break;
      case 10:
      $value = 0; 
       break;
      case 11:
      $value = 0; 
       break;
      case 12:
      $value = 1; 
       break;
      case 13:
      $value = 0; 
       break;
      case 14:
      $value = 0; 
       break;
      case 15:
      $value = 0; 
       break;
      case 16:
      $value = 1; 
       break;
      case 17:
      $value = 0; 
       break;
      case 18:
      $value = 0; 
       break;
      case 19:
      $value = 0; 
       break;
      case 20:
      $value = 1; 
       break;
      case 21:
      $value = 0; 
       break;
      case 22:
      $value = 0; 
       break;
      case 23:
      $value = 0; 
       break;
      case 24:
      $value = 1; 
       break;
      case 25:
      $value = 0; 
       break;
      case 26:
      $value = 0; 
       break;
      case 27:
      $value = 0; 
       break;
      case 28:
      $value = 1; 
       break;
      case 29:
      $value = 0; 
       break;
      case 30:
      $value = 0; 
       break;
      case 31:
      $value = 1; 
       break;
      case 32:
      $value = 0; 
       break;
      case 33:
      $value = 0; 
       break;
      case 34:
      $value = 0; 
       break;

    }
    
  return $value;
      
  }

?>
<div class='main'>
<div class='block_zero'>
<img src='/images/icon/clan.png' alt='*'/> <b>Статуя клана:</b> <img src='/images/icon/level.png' alt='*'/> <?=$i['built_1']?> уровень<br/>
<?
  
  if($i['built_1'] > 0) {

?>

Бонус: <font color='#90c090'>+<?=clan_buff($i['built_1'])?></font> к сумме параметров<br/>

<?
  
  }

?>

<font color='#90b0c0'>Прогресс:</font> <?=$progress?>%
</div>
 <div class='mini-line'></div>
<div class='block_zero'>

<?

  if($i['id'] == $clan['id'] && $clan_memb['rank'] == 4 && $i['built_1'] < 34) {

  if($_GET['up'] == true) {
  
    if($i[(value($i['built_1']) == 1 ? 'g':'s')] >= cost($i['built_1'])) {
    
      mysql_query('UPDATE `clans` SET `built_1` = `built_1` + 1,
     `'.(value($i['built_1']) == 1 ? 'g':'s').'` = `'.(value($i['built_1']) == 1 ? 'g':'s').'` - '.cost($i['built_1']).' WHERE `id` = "'.$i['id'].'"');
    
    header('location: /clan/built/');
    
    }
  
  }

?>

  <center><a class='btn' href='/clan/built/?up=true'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($i['built_1']) == 1 ? 'gold':'silver')?>.png' alt= '*' /> <?=cost($i['built_1'])?></span></span></a>
</center>

<?

  }

?>

</div>
</div>
<?

include './system/f.php';
  break;


}

?>