<?
    
    include './system/common.php';
    
 include './system/functions.php';
         
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Модераторы';


include './system/h.php';  

?>

<div class='main'>

<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `access` > 0'),0);
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

<div class='block_zero'>

<?

$q = mysql_query('SELECT * FROM `users` WHERE `access` > 0 ORDER BY `online` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {
  
?>
<p>
<img src='/images/icon/race/<?=$row['r'].($row['online'] > (time() - 86400) ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$row['id']?>/'><?=$row['login']?></a></p>

<?

  }

?>

</div></div>
<div class="main"><div class="block">
<?=pages('/moderators/?');?>

</div>
</div>
<?

  }
  else
  {

?>

<div class='block_zero'>

<font color='#999'>Модераторов нет</font>

</div></div>
</div>
<?

  }
  
include './system/f.php';

?>