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

  $ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$id.'\''));
  
  if(!$id OR !$ho OR $id == $user['id']) {
  
    header('location: /mail/');
    
    exit;
  
  }

  $title = 'Диалог с '.$ho['login'];    

  include './system/h.php';
  echo '<div class="main">';
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = \''.$user['id'].'\' AND `ho` = \''.$ho['id'].'\''),0) == 0) {
    
    mysql_query('INSERT INTO `contacts` (`user`,
                                           
                                           `ho`,
                                         
                                         `time`) VALUES (\''.$user['id'].'\',
                                         
                                                           \''.$ho['id'].'\',
                                         
                                                              \''.time().'\')');
  
  
  }

  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `ho` = "'.$user['id'].'" AND `user` = "'.$ho['id'].'"'),0) == 0) {
   
    mysql_query('INSERT INTO `contacts` (`ho`,
    
                                       `user`,
    
                                       `time`) VALUES (\''.$user['id'].'\',
    
                                                         \''.$ho['id'].'\',
    
                                                            \''.time().'\')');
  
  }


  if($ho['r'] != $user['r']) $_s = 100; else $_s = 1;


  $text = _string($_POST['text']);
  
  if($text) {
  if($user['level'] < 25) {
  echo '<div class="block center">Писать в почту можно только с 25 уровня!</div>';
  }else{
    $antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
  
    if(time() - $antiflood['time'] < 2) $errors[] = 'Писать можно 1 раз в 1 секунду!';

    
    if($user['s'] < $_s) $errors[] = 'Не хватает <img src=\'/images/icon/silver.png\' alt=\'*\'/> '.($_s - $user['s']).' серебра<div class=\'separ\'></div><a href=\'/trade/\'>Купить</a>';

    if($errors) {

      echo '<div class=\'block\' align=\'center\'>';
        
      foreach($errors as $error) {
          
        echo $error.'';
          
      }
      
      echo '</div>';

    }
    else
    {

      
        $text = eregi_replace( "[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "", $text);
        
        $text = str_replace(array('ru',
                                 'net',
                                 'com',
                                  'рф',
                                  'tk',
                                  'su',
                                  'us',
                                'mobi',
                                  'ua',
                                 'www',
                                'http'), 'bdls.ru', $text);

      mysql_query('UPDATE `users` SET `s` = `s` - '.$_s.' WHERE `id` = \''.$user['id'].'\'');

      mysql_query('INSERT INTO `mail` (`from`,
      
                                         `to`,
      
                                       `text`,
      
                                       `time`) VALUES (\''.$user['id'].'\',
                                                         
                                                         \''.$ho['id'].'\',
      
                                                             \''.$text.'\',
      
                                                            \''.time().'\')');
                                                            
      mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = \''.$user['id'].'\' AND `ho` = \''.$ho['id'].'\'');
     
      mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `ho` = \''.$user['id'].'\' AND `user` = \''.$ho['id'].'\'');
     
      header('location: /mail/'.$ho['id'].'/');
   
    }
  }
}
  echo '
<div class=\'mini-line\'></div>
<div class=\'block_zero\'>
  <form action=\'/mail/'.$ho['id'].'/\' method=\'post\'>
    Сообщение:<br/>
  <textarea name=\'text\' style=\'width: 97%\'></textarea>

     <span class=\'btn\'><span class=\'end\'><input class=\'label\' type=\'submit\' value=\'Отправить\'>Отправить</span></span>
<br><a href=\'?\' class=\'grey\'>Обновить</a>
  </form>
  <center><font color=\'#909090\'><small><small>Стоимость сообщения '.($user['r'] == $ho['r'] ? 'своей':'чужой').' фракции <img src=\'/images/icon/silver.png\' alt=\'*\'/> '.$_s.'</font></small></small></font></center>
</div>
<div class=\'mini-line\'></div>
<div class=\'block_zero\'>';

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `from` = "'.$user['id'].'" AND `to` = "'.$ho['id'].'" OR `to` = "'.$user['id'].'" AND `from` = "'.$ho['id'].'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

  if($page > $pages) $page = $pages;

  if($page < 1) $page = 1;
    
  $start = $page * $max - $max;

  if($count > 0) {
    
    $col = array('#ffffff', '#f09060', '#90c0c0');
    
    $q = mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' AND `to` = \''.$ho['id'].'\' OR `to` = \''.$user['id'].'\' AND `from` = \''.$ho['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

    while($row = mysql_fetch_array($q)) {

      $from = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['from'].'\''));

      echo '<p><span style=\'float: right; color: '.(($row['read'] == 0) ? '#90c090':'#909090').';\'>'.date('d.m | H:i', $row['time']).'</span><img src=\'/images/icon/race/'.$from['r'].($from['online'] > time() - 86400 ? '':'-off').'.png\' alt=\'*\'/> <a href=\'/user/'.$from['id'].'/\'>'.$from['login'].'</a><br/><font color=\''.$col[$from['access']].'\'>'.bb(smiles($row['text'])).'</font></p>';

      if($row['to'] == $user['id'] && $row['read'] == 0) mysql_query('UPDATE `mail` SET `read` = \'1\' WHERE `id` = \''.$row['id'].'\'');

    }

    echo '</div>'.pages('/mail/'.$id.'/?').'</div>';

  }
  else
  {
  
    echo '<div class=\'block_zero\'><font color=\'#909090\'>Сообщений нет</font></div>';
  
  }

  echo '</div><div class=\'main\'><div class=\'mini-line\'></div><div class=\'menuList\'><li><a href=\'/mail\'><img src=\'/images/icon/arrow.png\' alt=\'*\'/> Почта</a></li>
<li><a href=\'/smiles.php\'><img src=\'/images/icon/arrow.png\' alt=\'*\'/> Смайлики</a></li>
</div>
</div>';

  include './system/f.php';

}
else
{
  
  $title = 'Почта';    

  include './system/h.php';

  echo '<div class=\'main\'>';

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = \''.$user['id'].'\''),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

  if($page > $pages) $page = $pages;
  
  if($page < 1) $page = 1;
    
  $start = $page * $max - $max;

  if($count > 0) {

    echo '<div class=\'menuList\'>';

    $q = mysql_query('SELECT * FROM `contacts` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

    while($row = mysql_fetch_array($q)) {

      $ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['ho'].'\''));

      echo '<li><a href=\'/mail/'.$row['ho'].'/\'><img src=\'/images/icon/race/'.$ho['r'].($ho['online'] > time() - 86400 ? '':'-off').'.png\' alt=\'*\'/> '.$ho['login'].', '.$ho['level'].' ур.';
  
      $new = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `from` = \''.$ho['id'].'\' AND `to` = \''.$user['id'].'\' AND `read` = \'0\''),0);

      if($new > 0) echo '<font color=\'#90c090\'>+'.$new.'</font>';

    $lost = mysql_fetch_array(mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' AND `to` = \''.$ho['id'].'\' OR `to` = \''.$user['id'].'\' AND `from` = \''.$ho['id'].'\' ORDER BY `time` DESC LIMIT 1'));
    
    if($lost) echo '<br/>
<font color=\'#909090\'>'.(mb_strlen($lost['text'],'UTF-8') >= 25 ? mb_substr($lost['text'],0, 25, 'UTF-8').'...':$lost['text']).'</font>';

    echo '</a></li>';
    
    }

  echo '</div>';

  }
  else
  {

    echo '<div class=\'block_zero\'><font color=\'#909090\'>Почта пуста</font></div>';

  }
echo '<div class="block">
'.pages('/mail/?').'</div></div>';
  include './system/f.php';

}

?>