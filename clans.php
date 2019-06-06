<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


switch($_GET['action']) {

default:

    $title = 'Рейтинг кланов';    

include './system/h.php';  

?>

<div class='main'>
<div class='block_zero'>
<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clans`'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;


  if($page == 1) {
  
    $i = $page - 1;
  
  }
  elseif($page == 2) {
    
    $i = ($page + 9);
  
  }
  else
  {
  
    $i = ($page * 10) - 9;
  
  }

if($count > 0) {

$q = mysql_query('SELECT * FROM `clans` ORDER BY `level` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
  
  $i++;

if($i < 2) {

?>

<div class='wrappers'><img src='/rusalc/klans.png' width='100%' alt='start'></div><br/><center/>Каждый понедельник <br/>кланы занявшие  с 1 по 10 места получают в казну по <font color='#b8860b'>10000 золота</font> и <font color='#C0C0C0'>100000 серебра</font></center><br/>

<?=$i?> место<br/>
<table cellpadding='0' cellspacing='0'>
<tr>
<td><img src='/images/icon/clan/gerb/<?=$row['gerb']?>.png' alt='*'/></td><td valign='top' style='padding-left: 5px;'><img src='/images/icon/clan/<?=$row['r']?>.png' alt=''*/> <a href='/clan.php?id=<?=$row['id']?>'><?=$row['name']?></a><br/>
<img src='/images/icon/level.png'/> Уровень: <b><?=$row['level']?></b><br/>
<img src='/images/icon/exp.png' alt='*'/> Опыт: <?=n_f($row['exp'])?></td>
</tr></table>
</div><div class='mini-line'></div>
<?

  }
  else
  {

?>
<p> <a href='/clan/<?=$row['id']?>'>
<img src='/images/icon/clan/<?=$row['r']?>.png' alt=''*/> <?=$row['name']?>, <img src='/images/icon/level.png'/> <?=$row['level']?></a></p>

<?

  }


  }

?>
</div><div class='main block'>
<?=pages('?')?></div></div>
<div class='mini-line'></div>
<?

  }
  else
  {

?>


<?

  }
  
?>
<div class='index_menu'>
<a href='/clans/create/'><img src='/images/icon/clan.png' alt='*'/> Создать клан</a></li></div>
</div></div>
<?

include './system/f.php';

  break;

  case 'create':

    $title = 'Создать клан';    

include './system/h.php';  

$cost = 15000;

?>

<div class='main'>

<?

  if($clan) {

?>
<div class='wrappers'><img src='/rusalc/stop.png' width='100%' alt='start'></div><br/>
<div class='block_zero center'><font color='#999'>Для создания клана необходимо выйти из уже существующего!</font></div>
</div>
<?

  }
  else
  {
  
$name = _string($_POST['name']);
$name = strToLower($name);

  if($name && $user['g'] >= $cost) {
    $clans = mysql_query('SELECT * FROM `clans` WHERE `name` = "'.$name.'"');
    $clans = mysql_fetch_array($clans);
  
  if(!$clans) {
  if($user['level'] > 10) {
  echo '<div class="main block center">Создать клан можно только с 10 уровня!</div>';
  include ('./system/f.php');
  exit();
  }
    mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');
  
  mysql_query('INSERT INTO `clans` (`name`,`r`, `gerb`) VALUES ("'.$name.'", "'.$user['r'].'", "1")');

  $clan_id = mysql_insert_id();
  
  mysql_query('INSERT INTO `clan_memb` (`clan`,`user`,`rank`, `time`,`last_update`) VALUES ("'.$clan_id.'", "'.$user['id'].'", "4", "'.time().'","'.(time() + ((60 * 60) * 24)).'")');
  
  header('location: /clan.php');
  
  }
  
  }

?>
<div class='wrappers'><img src='/rusalc/sozdanie.gif' width='100%' alt='start'><br/><center>В связи с множеством заброшенных кланов<br/>cоздать кланы можно только с 10 уровня</center><br/></div>
<div class='block_zero' align='center'>
  <form action='' method='post'>
  Название клана:<br/>
  <input name='name' class='text'><br/>
  <span class='btn'><span class='end'><input class='label' type='submit' value='Создать'>Создать</span></span><br/>
  <font color='#999'>Цена: <img src='/images/icon/gold.png' alt='*'/> <?=$cost?> золота</font>
  </form>
</div>
</div>
<?
  
  }

include './system/f.php';

  break;
  
}

?>