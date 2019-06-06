<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Поход';    

include './system/h.php';
  echo "<div class='main'>";
  $farm = mysql_query('SELECT * FROM `farm` WHERE `user` = "'.$user['id'].'"');  
  $farm = mysql_fetch_array($farm);
  
  if(!$farm) {
  
    mysql_query('INSERT INTO `farm` (`user`) VALUES ("'.$user['id'].'")');
  
  }

?>

<?

if($user['level'] > 2) {


?>

<div class='block_zero center'>
<img src='/rusalc/pohod.jpg' width='100%' alt='*'/><br>
<?

  if($farm['h'] == 0 && $farm['time'] == 0) {
  
  $h = _string(_num($_POST['h']));
  
    if($h && $user['level'] >= $h * 3) {
    
      $hs = ($h * (60 * 60));
            
      mysql_query('UPDATE `farm` SET `h` = "'.$h.'", `time` = "'.(time() + $hs).'" WHERE `user` = "'.$user['id'].'"');
    
    header('location: /farm.php');
    
    }

?>

<font color='#90b0c0'>В походе ты получишь <img src='/images/icon/silver.png' alt='*'/> серебро. <br>
А также есть вероятность того, что вы найдете ключи к волшебным сундукам! <br>
Чем дольше поход, тем больше награда!</font><br/>

<form action='/farm.php' method='post'>
  <select name='h'>

<?

   for($h = 1; $h < 6; $h++) {

if($user['level'] >= $h * 3) {

?>

<option value='<?=$h?>'><?=$h?> час<?=($h == 1 ? '':($h == 5 ? 'ов':'а'))?></option>

<?

    }

  }

?>

  </select><br/>
   <span class='btn'><span class='end'><input class='label' type='submit' value='Отправиться'>Отправиться</span></span>
</form>

<?

  }
  else
  {


if($farm['time'] > time()) {

  if($_GET['end'] == true) {
    mysql_query('UPDATE `farm` SET `h` = "0", 
                                `time` = "0" WHERE `user` = "'.$user['id'].'"');
    header('location: /farm/');
  }
  

?>

<font color='#90b0c0'>Вы отправились в поход..</font><br/>
Осталось: <?=_time($farm['time'] - time())?><br/><br/>

<a class='btn' href='?end=true'><span class='end'><span class='label'>Вернуться</span></span></a>

<?

  }
  else
  {
     $chester = rand(2,4);
     mysql_query('UPDATE `users` SET `s` = `s` + '.($farm['h'] * 1000).', `chester` = `chester` + "'.$chester.'" WHERE `id` = "'.$user['id'].'"');  
      mysql_query('UPDATE `farm` SET `h` = "0",
                                  `time` = "0" WHERE `user` = "'.$user['id'].'"');
    
?>

<font color='#90b0c0'>Вы вернулись из похода!</font><br/>
Получено: <img src='/images/icon/silver.png' alt='*'/> <?=n_f($farm['h'] * 1000)?> серебра <br>
А также вы нашли: <?=$chester;?> ключа к волшебным сундукам!

<?

  }

  }

?>
  </div>
</div>

<?

  }
  else
  {
  
?>

<div class='main' align='center'>
  <img src='/images/icon/farm.png' alt='*'/> Поход доступен с <img src='/images/icon/level.png' alt='*'/> 3 уровня<br/>
</div>

<?

  }
  echo "</div>";
include './system/f.php';

?>