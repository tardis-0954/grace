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

    $title = 'Получить золото';    

include './system/h.php';

if($_GET['pay'] == ok) {

$summa = abs(intval($_POST['summa']));
if($summa == 0){
header('Location: ?');
exit();
}
echo"<div class='wrappers'><img src='/rusalc/zolo.jpg' width='100%' alt='start'></div>";
echo '<div class="main"><div class="block">Вы получаете '.($_POST['summa'] * 100).' <img src="/images/icon/gold.png"> золота <br>
Чтобы подтвердить платёж необходимо сделать перевод '.$_POST['summa'].' rub на QIWI кошелек +79225612638 в комментарии указав titans '.$user['login'].' и подтвердить оплату. </div></div>';
include ('./system/f.php');
exit();
}
?>
<div class='wrappers'><img src='/rusalc/zolo.jpg' width='100%' alt='start'></div>
<div class="main center" style="padding: 4px"><h1>QIWI платёж: </h1>
<div class="block"> <form class="" action="?pay=ok" method="POST">
Сумма (rub):</br>
<input type="number" name="summa" maxlength="50" value="1" class="text"/><br />
<span class="btn"><span class="end"><input class="label" type="submit" value='Купить'>Купить</span></span>
</form>
</div></div></div>
<div class="main menuList">
 
  <a href="/trade/exchange/"><img src="/images/icon/gold.png"> Обменник</a>
</div> </div>

<?
  
include './system/f.php';

          break;

case 'exchange':

    $title = 'Обменник';    

include './system/h.php';

  $course = 1000;

$g = _string(_num($_GET['g']));
  if($g) {
  
  if($_GET['buy'] == true) {

    if($user['s'] < $course * $g) {
    
        header('location: /trade/exchange/');
    
    exit;
    
    }
  
  mysql_query('UPDATE `users` SET `g` = "'.($user['g'] + $g).'", `s` = "'.($user['s'] - $course * $g).'" WHERE `id` = "'.$user['id'].'"');
    
  }
  else
  {

    if($user['g'] < $g) {
    
        header('location: /trade/exchange/');
    
    exit;
    
    }
    
  mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $g).'", `s` = "'.($user['s'] + $course * $g).'" WHERE `id` = "'.$user['id'].'"');
  
  }
  
        header('location: /trade/exchange/');
  
  }

?>

<div class='main'>
<div class='block_zero' align='center'>
  <img src='/rusalc/zolo.jpg' width='100%' alt='start'>
  
  
</div>
<div class='mini-line'></div>
<div class='main'>
<div class='menuList'>
<div class='block_zero' align='center'><font color='#9bc'>Обмен <img src='/images/icon/silver.png' alt='*'/> серебра на <img src='/images/icon/gold.png' alt='*'/> золото</font></div>

<div class='mini-line'></div>


<?
  
  for($i = 1; $i <= ($user['level'] > 10 ? 10:$user['level']); $i++) {

  if($i == 1 OR $i == 5 OR $i == 10) {

  if($user['s'] > $course * $i) {

?>

<li><a href='/trade/exchange/<?=$i?>/?buy=true'><img src='/images/icon/arrow.png' alt='*'/> <img src='/images/icon/silver.png' alt='*'/> <font color='#ffffff'><?=n_f($course * $i)?> → <img src='/images/icon/gold.png' alt='*'/> <?=$i?>            </font></a></li>

<?

  }
  
  }
  
  }

?>

</div>

<div class='mini-line'></div></div>

<div class='main'>
<div class='block_zero' align='center'><font color='#9bc'>Купить <img src='/images/icon/silver.png' alt='*'/> серебро</font></div>

<div class='mini-line'></div>

<div class='menuList'>
<?

  for($i = 1; $i <= ($user['level'] > 10 ? 10:$user['level']); $i++) {

  if($i == 1 OR $i == 5 OR $i == 10) {

  if($user['g'] >= $i) {

?>

<li><a href='/trade/exchange/<?=$i?>/'><img src='/images/icon/arrow.png' alt='*'/> <font color='#ffffff'><img src='/images/icon/gold.png' alt='*'/> <?=$i?> → <img src='/images/icon/silver.png' alt='*'/> <?=n_f($course * $i)?></font></a></li>

<?

  }

  }
  
  }

?>

</div>
</div>
</div>


<?

include './system/f.php';

break;

}

?>