<?
    
    include './system/common.php';
    
 include './system/functions.php';
         
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

$action = _string($_GET['action']);

switch($action) {
  default:
    
    $title = 'Онлайн';


include './system/h.php';  


?>

<div class='main'>
<div class='block_zero'>Все игроки | <a href='/online/search/'>Поиск</a></div>
<div class='mini-line'></div>
<div class='block_zero'>
<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `online` > "'.(time() - 86400).'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

$q = mysql_query('SELECT * FROM `users` WHERE `online` > "'.(time() - 86400).'" ORDER BY `level` DESC, `level` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {
  
$clan_row = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$row['id'].'"');
  $clan_row = mysql_fetch_array($clan_row);
?>
<p>
<img src='/images/icon/race/<?=$row['r'].($row['online'] > (time() - 86400) ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$row['id']?>/'><?=$row['login']?></a> <img src='/images/icon/level.png' alt='*'/> <?=$row['level']?> ур
<?
if($clan_row != 0) {
?>
 <img src='/images/icon/clan.png'>
<?
}
?>

<?
if($clan_row == 0) {
?>
<?
}
?>

</p>

<?

  }

?>

</div></div><div class="main"><div class="block">
<?=pages('?');?>
</div></div>

<?

include './system/f.php';

        break;

case 'search':
    
    $title = 'Поиск игрока';


include './system/h.php';  


$login = _string($_POST['login']);
  if($login) {
    $users = mysql_query('SELECT * FROM `users` WHERE `login` = "'.$login.'"');
    $users = mysql_fetch_array($users);
  
  if($users) {

    header('location: /user/'.$users['id'].'/');

  }
  else
  {
  
  }

  }

?>

<div class='main'>
<div class='block_zero'><a href='/online/'>Все игроки</a> | Поиск</div>
<div class='mini-line'></div>

<div class='block_zero'>
  <form action='/online/search/' method='post'>
    Имя персонажа:<br/><input name='login' class='text'/><br/>
     <span class='btn'><span class='end'><input class='label' type='submit' value='Поиск'>Поиск</span></span>
</form>
</div>
</div>
<?

include './system/f.php';

  break;

}
  
?>