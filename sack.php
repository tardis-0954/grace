<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Ресурсы';


include './system/h.php';  
echo '<div class="main">';
?>
<div class='block_zero'>
<?

    $sack = mysql_query('SELECT * FROM `sack` WHERE `user` = "'.$user['id'].'"');      
    $sack = mysql_fetch_array($sack);

if(!$sack) {

  mysql_query('INSERT INTO `sack` (`user`) VALUES ("'.$user['id'].'")');

}

  $res = 0;

for($i = 1; $i < 10; $i++) {

  if($sack[$i] > 0) {

  $res++;
  
    switch($i) {
    case 1:
    $name = 'Алмаз';
   $about = 'Используется для улучшения снаряжения';
     break;
    case 2:
    $name = 'Корунд';
   $about = 'Используется для улучшения снаряжения';

     break;
    case 3:
    $name = 'Обсидиан';
   $about = 'Используется для улучшения снаряжения';

     break;
    case 4:
    $name = 'Графит';
   $about = 'Используется для улучшения снаряжения';

     break;
    case 5:
    $name = 'Оникс';
   $about = 'Используется для улучшения снаряжения';

     break;
    case 6:
    $name = 'Амброзия';
   $about = 'Используется для создания эликсиров';

     break;
    case 7:
    $name = 'Мята';
   $about = 'Используется для создания эликсиров';

     break;
    case 8:
    $name = 'Аир';
   $about = 'Используется для создания эликсиров';

     break;
    case 9:
    $name = 'Рябина';
   $about = 'Используется для создания эликсиров';

     break;
  }

?>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$i?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=$name?> (<?=$sack[$i]?> <font color='#9bc'>шт.</font>)<br/><small>
  <font color='#999'><?=$about?></font>
  </small></td></tr></table>

<?

  }

}

if($res == 0) {

?>

<font color='#999'>У вас нет ресурсов</font>


<?

}

?>
</div>
</div>

<?
  
include './system/f.php';

?>