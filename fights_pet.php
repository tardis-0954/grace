<?
    
    include './system/common.php';
    
 include './system/functions.php';
         
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

$title = 'Битва питомцев';


include './system/h.php';  


?>

<div class='main'>
<div class='block_zero'>
<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `pets_user` WHERE `user` != "'.$user['id'].'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

$q = mysql_query('SELECT * FROM `pets_user` WHERE `user` != "'.$user['id'].'" ORDER BY `id` DESC, `hp` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {
  
?>
<p>
<a href='/attack_pet.php?id=<?=$row['id']?>/'><img src='/images/pets/icon.gif'> <?=$row['name']?></a></p>

<?

  }

?>
</div></div><div class="mini-line"></div>
<div class="main block">Выбери противника для своего питомца!</div>
<div class="main"><div class="block">
<?=pages('?');?>
</div></div>

<?

include './system/f.php';

        
?>