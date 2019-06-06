<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

  $sub = _string(_num($_GET['sub']));
$topic = _string(_num($_GET['topic']));

if(!$sub && !$topic) {
    $title = 'Форум';    

include './system/h.php';  

?>

<div class='main'>
<?

$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_sub`'),0);

if($count > 0) {


  if($_GET['create'] == true && $user['access'] == 2) {

  $name = _string($_POST['name']);
$access = _string(_num($_POST['access']));
  if($name) {
  
    mysql_query('INSERT INTO `forum_sub` (`name`,
                                        `access`) VALUES ("'.$name.'",
                                                        "'.$access.'")');

    header('location: /forum/');

  }

?>

  <div class='block_zero'>
  
  <form action='/forum/?create=true' method='post'>
  
  Название раздела:<br/>
  <input name='name' class='text'/><br/>
  Создавать топики могут:<br/>
  <select name='access'>
  <option value='0'>все</option>
  <option value='1'>модераторы</option>
  <option value='2'>администраторы</option>
  </select><br/>
   <span class='btn'><span class='end'><input class='label' type='submit' value='Создать'>Создать</span></span>
  </form>

  </div>

<?

  }

$id = _string(_num($_GET['id']));

  if($id && $user['access'] == 2) {
  
  $i = mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);
  
  if(!$i) {
  
    header('location: /forum/');
    
  exit;
  
  }
  
  
$name = _string($_POST['name']);
  if($name) {
  
    mysql_query('UPDATE `forum_sub` SET `name` = "'.$name.'" WHERE `id` = "'.$i['id'].'"');

    header('location: /forum/?adm=true');

  }
  
?>

  <div class='block_zero'>
  
  <form action='/forum/?adm=true&id=<?=$i['id']?>' method='post'>
  
  Название раздела:<br/>
  <input name='name' class='text' value='<?=$i['name']?>'/> <span class='btn'><span class='end'><input class='label' type='submit' value='Сохранить'>Сохранить</span></span>
  
  </form>

  </div>

<?

  if($_GET['delete'] == true) {
  
    $q = mysql_query('SELECT * FROM `forum_topic` WHERE `sub` = "'.$i['id'].'"');
    while($row = mysql_fetch_array($q)) {
      mysql_query('DELETE FROM `forum_comments` WHERE `topic` = "'.$row['id'].'"');
    }
    
   mysql_query('DELETE FROM `forum_topic` WHERE `sub` = "'.$i['id'].'"');
    
      mysql_query('DELETE FROM `forum_sub` WHERE `id` = "'.$i['id'].'"');
    
    header('location: /forum/?adm=true');
    
    }

  }

?>

<div class='menuList'>

<?

$q = mysql_query('SELECT * FROM `forum_sub`');

  while($row = mysql_fetch_array($q)) {

  $i++;

?>

  <li>

<?


  if($_GET['adm'] == true && $user['access'] == 2) {

?>

  <span style='float: right;'><a href='/forum/?adm=true&id=<?=$row['id']?>&delete=true'>(x)</a></span>

<?

  }

?>

  <a href='/forum/sub/<?=$row['id']?>/'><img src='/images/icon/section.png' alt='*'/> <?=$row['name']?></a></li>

<?
  
  }

?>

  <li <?=($_GET['adm'] == true ? '':'class=\'no_b\'')?>>

<?

  if($user['access'] == 2) {

?>

  <a href='/forum/<?=($_GET['adm'] == true ? '':'?adm=true')?>' <?=($_GET['adm'] == true ? 'style=\'color: #909090;\'':'')?>><img src='/images/icon/arrow.png' alt='*'/> Управление форумом</a></a>

<?

  if($_GET['adm'] == true) {

?>

  <li><a href='/forum/?create=true'><img src='/images/icon/arrow.png' alt='*'/> Создать раздел</a></li>

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

<div class='block_zero'><font color='#909090'></font></div>

<?

  }
  
include './system/f.php';

  }
  elseif($sub) {
  
  $sub = mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$sub.'"');
  $sub = mysql_fetch_array($sub);

  if(!$sub) {
  
      header('location: /forum');
  
  exit;
  
  }

if($_GET['create'] == true && $user['access'] >= $sub['access']) {

    $title = 'Новый топик';    

include './system/h.php';
echo '<div class="main">';
?>
<?

  if($user['save'] == 1) {


     $name = _string($_POST['name']);
              $text = _string($_POST['text']);

  if($name && $text) {
    
  if($user['level'] > 14) {
  
      mysql_query('INSERT INTO `forum_topic` (`sub`,
                                             `name`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$sub['id'].'",
                                                                  "'.$name.'",
                                                            "'.$user['id'].'",
                                                                  "'.$text.'",
                                                                 "'.time().'")');
  
    $topic_id = mysql_insert_id();
  
    header('location: /forum/topic/'.$topic_id.'/');
  
  }
  else
  {

?>

<div class='block_zero' align='center'><font color='#909090'>Топики можно создавать с <img src='/images/icon/level.png' alt='*'/> 15 уровня!</font></div>

<?
  
  }
  
  }
  

?>


<div class='block_zero'>
  <form action='/forum/sub/<?=$sub['id']?>/?create=true' method='post'>
  Название топика:<br/>
  <input name='name' class='text'/><br/>
  Оглавление:<br/>
  <textarea name='text' style='width: 100%;'></textarea><br/>
    <span class='btn'><span class='end'><input class='label' type='submit' value='Создать'>Создать</span></span>
  </form>
</div>

<?

  
  }
  else
  {

?>

<div class='block_zero'><font color='#999'>Для создания топика вам нужно сохранить своего персонажа</font></div>

<?
  
  }

echo '</div>';
include './system/f.php';  


}
else
{

    $title = $sub['name'];    

include './system/h.php';  
echo '<div class="main">';
?>

<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_topic` WHERE `sub` = "'.$sub['id'].'"'),0);
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

?>

<div class='menuList'>

<?

$q = mysql_query('SELECT * FROM `forum_topic` WHERE `sub` = "'.$sub['id'].'" ORDER BY `stick` DESC, `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
  
  $i++;


?>

<li><a href='/forum/topic/<?=$row['id']?>/' <?=($row['stick'] == 1 ? 'style="font-weight: bold;"':'')?>><img src='/images/icon/forum_<?=($row['close'] == 1 ? 3:2)?>.png' alt='*'/> <?=$row['name']?></a></li>

<?

  }
  
?>
</div>
<?=pages('/forum/sub/'.$sub['id'].'/?')?>
</div>

<?
  
  }
  else
  {

?>

<div class='block_zero'><font color='#999'>Форум пуст!</font></div>

<?

  }

?>

<?

  if($user['access'] >= $sub['access']) {

?>


<div class='main menuList'>

  <li><a href='/forum/sub/<?=$sub['id']?>/?create=true'><img src='/images/icon/forum_2.png'> Создать новый топик</a></li>

</div>
</div>
<?

  }

echo '</div>';
include './system/f.php';

}

}
elseif($topic) {

  $topic = mysql_query('SELECT * FROM `forum_topic` WHERE `id` = "'.$topic.'"');
  $topic = mysql_fetch_array($topic);

  if(!$topic) {
  
      header('location: /forum');
  
  exit;
  
  }

    $title = $topic['name'];

include './system/h.php';  
echo '<div class="main">';
  $topic_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$topic['user'].'"');
  $topic_user = mysql_fetch_array($topic_user);

?>

<?

if($_GET['adm'] == true && $user['access'] > 0) {

?>

<div class='block_zero'>
<img src='/images/icon/arrow.png' alt='*'/> <a href='/forum/topic/<?=$topic['id']?>/?stick=true'> <?=($topic['stick'] == 0 ? 'Закрепить':'Открепить')?></a> | <a href='/forum/topic/<?=$topic['id']?>/?close=true'> <?=($topic['close'] == 0 ? 'Закрыть':'Открыть')?></a> | <a href='/forum/topic/<?=$topic['id']?>/?delete=true'>Удалить</a>
</div>
 <div class='mini-line'></div>

<?

}

?>

<div class='block_zero'>
  <img src='/images/icon/race/<?=$topic_user['r'].($topic_user['online'] > time() - 86400 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$topic_user['id']?>/'><?=$topic_user['login']?></a>, <?=_times(time() - $topic['time'])?><br/>

<?

  if($topic_user['access'] == 1) {
  
?>
<font color='f09060'>
<?
  
  }
  
  if($topic_user['access'] == 2) {
  
?>
<font color='90c0c0'>
<?
  
  }

?>

<?=bb(smiles($topic['text']))?>

<?

  if($topic_user['access'] > 0) {
  
?>
</font>
<?
  
  }

?>

</div>
<div class='mini-line'></div>

<?

      if($user['access'] > 0) {
  
   if($_GET['stick'] == true) {

    mysql_query('UPDATE `forum_topic` SET `stick` = "'.($topic['stick'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
  
  header('location: /forum/topic/'.$topic['id'].'/?adm=true');
  
  }
  
   if($_GET['close'] == true) {

    mysql_query('UPDATE `forum_topic` SET `close` = "'.($topic['close'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
  
  header('location: /forum/topic/'.$topic['id'].'/?adm=true');
  
  }

if($_GET['delete'] == true) {

    $q = mysql_query('SELECT * FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'"');
    while($row = mysql_fetch_array($q)) {
      mysql_query('DELETE FROM `forum_comments` WHERE `id` = "'.$row['id'].'"');
    }

  header('location: /forum/sub/'.$topic['sub'].'/?adm=true');
  
    mysql_query('DELETE FROM `forum_topic` WHERE `id` = "'.$topic['id'].'"');

  }

?>

<div class='menuList'>
  <li><a href='/forum/topic/<?=$topic['id']?>/<?=($_GET['adm'] == true ? '':'?adm=true')?>' <?=($_GET['adm'] == true ? 'style=\'color: #909090;\'':'')?>><img src='/images/icon/arrow.png' alt='*'/> Управление топиком</a></li>
</div>
<div class='mini-line'></div>

<?

  }

  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'"'),0);

?>

<div class='block_zero'>
Комментарии: <b><?=$count?></b>
</div>

<?

  if($count > 0) {

?>

<div class='mini-line'></div>
<div class='block_zero'>

<?

    $max = 10;


  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

$q = mysql_query('SELECT * FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'" ORDER BY `id` LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $comment_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $comment_user = mysql_fetch_array($comment_user);

?>

<img src='/images/icon/race/<?=$comment_user['r'].($comment_user['online'] > time() - 86400 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$comment_user['id']?>/'><?=$comment_user['login']?></a><?

if($comment_user['id'] != $user['id']) {

?> <a href='/forum/topic/<?=$topic['id']?>/?page=<?=$page?>&to=<?=$comment_user['id']?>'>(&#187;)</a><? } ?>, <?=_times(time() - $row['time'])?><br>

<?

    if($row['to']) {

      $__to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['to'].'"');
      $__to = mysql_fetch_array($__to);

if($__to['id'] == $user['id']) {

?>

<font color='#90c090'>

<?

    }

?>

<?=$__to['login']?>,

<?

if($__to['id'] == $user['id']) {

?>

</font>

<?

    }
    
    }

  if($comment_user['access'] == 1) {
  
?>
<font color='f09060'>
<?
  
  }
  
  if($comment_user['access'] == 2) {
  
?>
<font color='90c0c0'>
<?
  
  }

?>

<?=bb(smiles($row['text']))?>

<?

  if($comment_user['access'] > 0) {
  
?>
</font>
<?
  
  }
  
  if($user['access'] > 0) {

$comment = _string(_num($_GET['comment']));

             if($comment) {
  
    mysql_query('DELETE FROM `forum_comments` WHERE `id` = "'.$comment.'"');

    header('location: /forum/topic/'.$topic['id'].'/?page='.$page);

  }

?>

<a href='/forum/topic/<?=$topic['id']?>/?page=<?=$page?>&comment=<?=$row['id']?>'>(x)</a>

<?
  
  }
?>
<br>
<?

  }

?>

<p><?=pages('/forum/topic/'.$topic['id'].'/?')?>
</p>
</div>

<?

  }
?>

<div class='mini-line'></div>
<div class='block_zero'>

<?

  if($topic['close'] == 0) {

  if($user['save'] == 1) {

  if($user['level'] > 5) {

$text = _string($_POST['text']);

  $to = _string(_num($_GET['to']));

  if($to) {

      $_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
      $_to = mysql_fetch_array($_to);
  
  if(!$_to OR $_to['id'] == $user['id']) {

    header('location: /forum/topic/'.$topic['id'].'/?page='.$page);
    
  exit;
  
  }
  
  }

  if($_to) {
  
    $text = str_replace($_to['login'].', ', '', $text);
  
  }

  if($text) {
  
    mysql_query('INSERT INTO `forum_comments` (`topic`,`user`,`to`,`text`,`time`) VALUES ("'.$topic['id'].'", "'.$user['id'].'", "'.$_to['id'].'", "'.$text.'", "'.time().'")');
  
  header('location: /forum/topic/'.$topic['id'].'/?page='.$pages);
  
  }

?>

<form action='/forum/topic/<?=$topic['id']?>/?page=<?=$page?>&to=<?=$to?>' method='post'>
  Сообщение:<br/>
<textarea name='text' style='width: 100%;'><?=($to ? $_to['login'].', ':'')?></textarea><br/>
 <span class='btn'><span class='end'><input class='label' type='submit' value='Отправить'>Отправить</span></span>

</form>

<?

  }
  else
  {

?>

<font color='#999'>Писать на форуме можно с <img src='/images/icon/level.png' alt='*'/> 5 уровня</font>

<?
  
  }
  
  }
  else
  {

?>

<font color='#999'>Для общения на форуме вам нужно сохранить своего персонажа</font>

<?
  
  }
  
  }
  else
  {

?>

<font color='#f33'>Топик закрыт</font>

<?
  
  }

?>

</div>

<?
echo '</div>';
include './system/f.php';  

}

?>