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
  
  $title = 'Лаборатория';    
  
  include './system/h.php';
  echo '<div class="main">';
?>

<div class='wrappers'><img src='/rusalc/labor.jpg' width='100%' alt='start'><br/>

  <div class='block_zero' align='center'><font color='#90b0c0'>В лаборатории можно усилить своего персонажа</font></div>
 <div class='mini-line'></div>
<div class='index_lab'>
  <a href='/lab/wiz/'><img src='/images/icon/wiz.png' alt='*'/> Колдун<br/>
  <small><font color='#fff'>Восстановление маны и здоровья</small></font></a></div>
  <div class='index_lab'><a href='/lab/premium/'><img src='/images/icon/premium.png' alt='*'/> Благословение<br/>
  <small><font color='#fff'>Увеличение опыта и награды</small></font></a></div>
</div>
</div>
<?

include './system/f.php';

  break;
  case 'wiz':

$title = 'Колдун';

include './system/h.php';
if($_GET['potion'] == true) {
    
  if($user['g'] < 15) $errors[] = 'Не хватает <img src=\'/images/icon/gold.png\' alt=\'*\'/> '.(15 - $user['g']).' золота<div class=\'separ\'></div><a href=\'/trade/\'>Купить</a>';

  if($errors) {

    echo '<div class=\'block\' align=\'center\'>';
    
    foreach($errors as $error) {
      
      echo $error.'<br/>';
      
    }
  
    echo '</div>
<div class=\'mini-line\'></div>';

  }
  else
  {


    mysql_query('UPDATE `users` SET `g` = `g` - 15,
    
                                      `hp` = \''.($user['vit'] * 2).'\',
    
                                      `mp` = \''.$user['mana'].'\' WHERE `id` = \''.$user['id'].'\'');


    $referal = _string($_GET['referal']);
    
    if($referal) {
    
      header('location: '.$referal);

    }
    else
    {
    
      header('location: /lab/wiz/');
    
    }
  
  }

}

echo '<div class=\'main\'>

  <div class=\'wrappers\'><img src=\'/rusalc/koldun.jpg\' width=\'100%\' alt=\'start\'><br/><center>Выбирай что нужно тебе и уходи пока  не поздно</center><br/>
</div>
<div class=\'mini-line\'></div>
<div class=\'block_zero center\'>
  <table cellpadding=\'0\' cellspacing=\'0\'>
  <tr>
  <td><img src=\'/images/alchemy/potion.png\' alt=\'*\'/></td>
  <td valign=\'top\' style=\'padding-left: 5px;\'><b>Настойка бодрости</b><br/>
  <small><small>+100% маны и жизни</small></small></td>
  </tr></table>
  <div class=\'separ\'></div>
  <div align=\'center\'>
    <a class=\'btn\' href=\'/lab/wiz/?potion=true\'><span class=\'end\'><span class=\'label\'>Купить</a></span></span><br/>
    <font color=\'#909090\'>Цена: <img src=\'/images/icon/gold.png\' alt=\'*\'/> 15 золота</font>
  </div></div>
</div>';

include './system/f.php';
       break;
  case 'premium':

$title = 'Благославение';

include './system/h.php';

if($_GET['buy'] == true) {
  
  if($premium) $errors[] = 'Вы уже активировали благославение';
  
  if($user['g'] < 5000) $errors[] = 'Не хватает <img src=\'/images/icon/gold.png\' alt=\'*\'/> '.(5000 - $user['g']).' золота<div class=\'separ\'></div><a href=\'/trade/\'>Купить</a>';
  
  if($errors) {
    
    echo '<div class=\'block\' align=\'center\'>';
    
    foreach($errors as $error) {
      
      echo $error.'<br/>';
      
    }
  
    echo '</div>
<div class=\'mini-line\'></div>';
  
  }
  else
  {

    mysql_query('UPDATE `users` SET `g` = `g` - 5000 WHERE `id` = \''.$user['id'].'\'');
      
    mysql_query('INSERT INTO `premium` (`user`,
                                        `time`) VALUES ("'.$user['id'].'",
                                            "'.(time() + (3600)).'")');   

    mysql_query('UPDATE `users` SET `str` = `str` + 500,
                                    `vit` = `vit` + 500,
                                    `agi` = `agi` + 500,
                                    `def` = `def` + 500, `mana` = `mana` + 500  WHERE `id` = \''.$user['id'].'\'');

    header('location: /lab/premium/');
  
  }

}

echo '<div class=\'main\'>

   <div class=\'wrappers\'><img src=\'/rusalc/blagosl.jpg\' width=\'100%\' alt=\'start\'><br/>
  
 
</div>
<div class=\'mini-line\'></div>
<div class=\'block_zero center\'>
<font color=\'#90c090\'>+500</font> ко всем параметрам<br>Время действия: 60 мин.<br/>
  <font color=\'#90c090\'>+25%</font> к опыту<br/>
  Время поиска и добычи ресурсов на <font color=\'#90c090\'>10%</font> меньше<br> '.($premium ? 'Осталось: '._time($premium['time'] - time()):'<a class=\'btn\' href=\'/lab/premium/?buy=true\'><span class=\'end\'><span class=\'label\'>Купить</a></span></span><br/>
  <font color=\'#909090\'>Цена: <img src=\'/images/icon/gold.png\' alt=\'*\'/> 5000 золота</font>').'</li>
</div></div>';

include './system/f.php';
       break;

}

?>