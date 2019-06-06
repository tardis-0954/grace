<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR $user['access'] < 1) {

  header('location: /');
    
exit;

}

switch($_GET['action']) {
  default:

    $title = 'Панель управления';    

include './system/h.php';

?>

<div class='main'>
<div class='menuList'>
  <li><a href='/adm/clon/'><img src='/images/icon/arrow.png' alt='*'/> Проверка на мультоводство</a></li>
  <li><a href='/adm/ban/'><img src='/images/icon/arrow.png' alt='*'/> Управление банами</a></li>
<?

  if($user['access'] == 2) {

?>
  <li><a href='/adm/acc/'><img src='/images/icon/arrow.png' alt='*'/> Управление аккаунтами</a></li>
<li><a href='/sql.php'><img src='/images/icon/arrow.png' alt='*'/> SQL менеджер</a></li>
  <li><a href='/adm/deposit/'><img src='/images/icon/arrow.png' alt='*'/> Перевод средств</a></li>
  <li><a href='/adm/trade/'><img src='/images/icon/arrow.png' alt='*'/> Передача вещей</a></li>

<?

  }
  
?>

</div>
</div>
<?

include './system/f.php';
  
  break;
  case 'clon':

    $title = 'Проверка на мультоводство';    

include './system/h.php';

?>

<div class='main'>
<div class='block'>

<?

$id = _string(_num($_POST['id']));
  if($id) {
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $users = mysql_fetch_array($users);
  
  if(!$users) {
      header('location: /adm/clon/');
  exit;
  }

  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `ip` = "'.$users['ip'].'" AND `id` != "'.$users['id'].'"'),0);

?>
IP: <?=$users['ip']?> [<?=$users['ua']?>]


<?

if($count > 0) {

$q = mysql_query('SELECT * FROM `users` WHERE `ip` = "'.$users['ip'].'" AND `id` != "'.$users['id'].'"');

  while($row = mysql_fetch_array($q)) {

?>
<p>
<img src='/images/icon/race/<?=$row['r']?>.png' alt='*'/> <a href='/user/<?=$row['id']?>/'><?=$row['login']?></a></p>

<?

  }

}
else
{

?>
<br>
<font color='#999'>Персонажей нет!</font>

<?

}
  
  }
  else
  {

?>

  <form action='/adm/clon/' method='post'>
    ID персонажа:<br/><input name='id' class='text'/><br/>
<span class='btn'><span class='end'><input class='label' type='submit' value='Проверить'>Проверить</span></span>
  </form>

<?

  }

?>

</div>

</div>
<?

include './system/f.php';

  break;

  case 'ban':

    $title = 'Управление банами';    

include './system/h.php';

?>

<div class='main'>
 <div class='mini-line'></div>

<?

if($_GET['list'] == true) {
    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

if($count > 0) {


$id = _string(_num($_GET['id']));

  if($id) {
  
  $ban = mysql_query('SELECT * FROM `ban` WHERE `id` = "'.$id.'"');
  $ban = mysql_fetch_array($ban);
  
  if(!$ban) {
  
    header('location: /adm/ban/list/?page='.$page);
    
  exit;
  
  }
  
?>

<?

  if($_GET['delete'] == true) {
  
    mysql_query('DELETE FROM `ban` WHERE `id` = "'.$id.'"');
  
  header('location: /adm/ban/list/?page='.$page);
  
  }
  
  }

?>

<div class='block'>

<?

$q = mysql_query('SELECT * FROM `ban` WHERE `time` > "'.time().'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $u = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $u = mysql_fetch_array($u);

?>

<p>  <span style='float: right;'><a href='/adm/ban/list/?id=<?=$row['id']?>&delete=true&page=<?=$page?>'>(x)</a></span><img src='/images/icon/race/<?=$u['r'].($u['online'] > time() - 300 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$u['id']?>/'><?=$u['login']?></a>
  <br/>
  Осталось: <?=_time($row['time'] - time())?> 
</p>
<?
  }
?>
</div></div><div class='mini-line'></div>
  <div class='main'><div class='block'><?=pages('/adm/ban/list/?')?></div></div></div>
<?
 
}
else
{


}

?>

</div>
</div>
<?

}
else
{

$id = _string(_num($_POST['id']));
  if($id) {
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $users = mysql_fetch_array($users);
  
  if(!$users OR $users['access'] >= $user['access']) {
      header('location: /adm/ban/');
  exit;
  }

  $d = _string(_num($_POST['d']));

  $h = _string(_num($_POST['h']));
  if($h > 24) {
     $h = 24;
  }

  $m = _string(_num($_POST['m']));
  if($m > 60) {
     $m = 60;
  }
  
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `user` = "'.$users['id'].'"'),0);
  if($count == 0) {
  
    mysql_query('INSERT INTO `ban` (`user`,
                                    `time`,
                                      `ip`) VALUES ("'.$users['id'].'",
               "'.(time() + ($d * 86400) + ($h * 3600) + ($m * 60)).'",
                                                    "'.$users['ip'].'")');

?>

<div class='main' align='center'>
   <img src='/images/icon/ok.png' alt='*'/> <font color='#3c3'>Персонаж заблокирован!</font></div>

<?
  
  }
  else
  {

?>

<div class='main' align='center'>
<img src='/images/icon/error.png' alt='*'/> <font color='#c66'>Персонаж уже заблокирован!</font></div>

<?
  
  }

?>

<div class='mini-line'></div>

<?
  
  }

?>

<div class='main'><div class='block'>

  <form action='/adm/ban/' method='post'>
    ID персонажа:<br/><input name='id' class='text'/><br/>
    <br/>д <input name='d' size='2' value='0' class='text'/><br/>
    <br/>ч <input name='h' size='2' value='0' class='text'/><br/>
    <br/>м <input name='m' size='2' value='0' class='text'/><br/>   
  <span class='btn'><span class='end'><input class='label' type='submit' value='Забанить'>Забанить</span></span>
  </form>

</div></div>

<div class='mini-line'></div>
<div class='menuList'>
  <li><a href='/adm/ban/list/'><img src='/images/icon/arrow.png' alt='*'/> Список забаненых (<?=mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0)?>)</a></li>
</div>
</div>
<?

  }

include './system/f.php';

  

  break;

  case 'deposit':

  if($user['access'] < 2) {

    header('location: /adm/');

  exit;

  }

    $title = 'Передача средств';    

include './system/h.php';

?>

<?

  if($_POST['submit']) {

  $id = _string(_num($_POST['id']));
    
  $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $users = mysql_fetch_array($users);

  if($users) {
  
           $type = _string($_POST['type']);
    $count= _string(_num($_POST['count']));
  
  if(mysql_query('UPDATE `users` SET `'.$type.'` = `'.$type.'` + '.$count.' WHERE `id` = "'.$id.'"')) {

?>

<div class='main' align='center'><div class='block'>Перевод успешно выполнен!</div></div>

<?  
  
  }
  else
  {
  
  }

  }
  else
  {
  
  
  }
  
  }

?>

<div class='main'><div class='block'>

  <form action='/adm/deposit/' method='post'>
    ID персонажа:<br/><input name='id' class='text'/><br/>
    <select name='type'>
    <option value='s'>Серебро</option>
    <option value='g'>Золото</option>
    </select>
    <br/><input name='count' size='2' value='0' class='text'/><br/>
<span class='btn'><span class='end'><input class='label' type='submit' name='submit' value='Перевести'>Перевести</span></span>
  </form>
</div>
</div>

<?

include './system/f.php';

  break;

  case 'trade':

  if($user['access'] < 2) {

    header('location: /adm/');

  exit;

  }

    $title = 'Передача вещей';    

include './system/h.php';

?>

<?

  if($_POST['submit']) {

  $id = _string(_num($_POST['id']));
$item = _string(_num($_POST['item']));


  $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $users = mysql_fetch_array($users);

   $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$item.'"');
   $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
    $str =28;
    $vit =28;
    $agi =28;
    $def =28;
     break;
    case 1:
  $bonus = 5;
    $str =31;
    $vit =31;
    $agi =31;
    $def =31;

     break;

    case 2:
 $bonus = 10;
    $str =45;
    $vit =45;
    $agi =45;
    $def =45;

     break;

    case 3:
 $bonus = 10;
    $str =52;
    $vit =52;
    $agi =52;
    $def =52;

      break;

    case 4:
 $bonus = 10;
    $str =60;
    $vit =60;
    $agi =60;
    $def =60;

     break;
     
    case 5:
 $bonus = 10;
    $str =120;
    $vit =120;
    $agi =120;
    $def =120;

     break;

    case 6:
 $bonus = 10; 
    $str =170;
    $vit =170;
    $agi =170;
    $def =170;

     break;

  }

  if($users && $item) {
  
           $type = _string($_POST['type']);
    $count= _string(_num($_POST['count']));
  
  if(mysql_query('INSERT INTO `inv` (`user`,
                                     `item`,
                                    `bonus`,
                                     `_str`,
                                     `_vit`,
                                     `_agi`,
                                     `_def`) VALUES ("'.$users['id'].'",
                                                      "'.$item['id'].'",
                                                           "'.$bonus.'",
                                                             "'.$str.'",
                                                             "'.$vit.'",
                                                             "'.$agi.'",
                                                             "'.$def.'")')) {

?>

<div class='main' align='center'>Вещь успешно передана!</div>

<?  
  
  }
  else
  {
  
  }

  }
  else
  {
  
  
  }
  
  }

?>

<div class='main'>
<div class='block'>
  <form action='/adm/trade/' method='post'>
    ID персонажа:<br/><input name='id' class='text'/> <br>
    <select name='item'>
<?

    $q = mysql_query('SELECT * FROM `items` ORDER BY `id`');
while($row = mysql_fetch_array($q)) {

  switch($row['quality']) {
    case 0:
  $quality = 'П';
     break;
    case 1:
  $quality = 'О';

     break;

    case 2:
  $quality = 'Р';

     break;

    case 3:
  $quality = 'Э';

      break;

    case 4:
  $quality = 'Л';

     break;
     
    case 5:
  $quality = 'Б';

     break;

    case 6:
  $quality = 'С Б';
     break;

  }  
?>
      <option value='<?=$row['id']?>'><?=$row['id']?> / <?=$quality?> / <?=$row['name']?></option>
<?

  }

?>
    </select><br/>
   <span class='btn'><span class='end'><input class='label' type='submit' name='submit' value='Передать'>Передать</span></span>
    
  </form>

</div>
</div>
<?

include './system/f.php';

  break;
	case 'acc':
		if($user['access'] < 2) {
			header('location: /adm/');
			exit;
		}
		$title = 'Редактирование игрока';
		include './system/h.php';
		if(isset($_GET['yes'])){
		echo _string($_POST['login']);
			mysql_query('UPDATE `users` SET `login` = \''._string($_POST['login']).'\', `s` = '._string(_num($_POST['s'])).', `g` = '._string(_num($_POST['g'])).', `level` = '._string(_num($_POST['level'])).', `exp` = '._string(_num($_POST['exp'])).', `str` = '._string(_num($_POST['str'])).', `vit` = '._string(_num($_POST['vit'])).', `agi` = '._string(_num($_POST['agi'])).', `def` = '._string(_num($_POST['def'])).', `mana` = '._string(_num($_POST['mana'])).' WHERE `id` = '._string(_num($_GET['yes'])).' LIMIT 1');
			header('location: /adm/acc/');
			exit;
		}
		if(isset($_POST['submit']) & !empty($_POST['id'])){
			$acc = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = '._string(_num($_POST['id'])).' LIMIT 1'));
			?>
			<div class="main"><div class="block">
				<form action='/adm/acc/yes/<?=_string(_num($_POST['id']))?>/' method='post'>
					Ник:
					<br/>
					<input type='text' name='login' value='<?=$acc['login']?>' class='text'/> 
					<br/>
					Кол-во серебра:
					<br/>
					<input name='s' value='<?=$acc['s']?>' class='text'/> 
					<br/>
					Кол-во золота:
					<br/>
					<input name='g' value='<?=$acc['g']?>' class='text'/> 
					<br/>
					Уровень:
					<br/>
					<input name='level' value='<?=$acc['level']?>' class='text'/> 
					<br/>	
					Опыт:
					<br/>
					<input name='exp' value='<?=$acc['exp']?>' class='text'/> 
					<br/>	
					Сила:
					<br/>
					<input name='str' value='<?=$acc['str']?>' class='text'/> 
					<br/>	
					Жизнь:
					<br/>
					<input name='vit' value='<?=$acc['vit']?>' class='text'/> 
					<br/>	
					Удача:
					<br/>
					<input name='agi' value='<?=$acc['agi']?>' class='text'/> 
					<br/>
					Защита:
					<br/>
					<input name='def' value='<?=$acc['def']?>' class='text'/> 
					<br/>
					Мана:
					<br/>
					<input name='mana' value='<?=$acc['mana']?>' class='text'> 
					<br/>
<span class='btn'><span class='end'><input class='label' type='submit' name='submit' value='Сохранить'>Сохранить</span></span>
					
				</form>
			</div></div>
			<?
		}
		else{
		?>
		<div class="main"><div class="block">
			<form action='/adm/acc/' method='post'>
				ID персонажа:
				<br/>
				<input name='id' class='text'/> 
				<br/>
<span class='btn'><span class='end'><input class='label' type='submit' value='Изменить' name='submit'>Изменить</span></span>
			</form>
		</div>
		
		<?
		}
		include './system/f.php';
	break;

}
  
?>