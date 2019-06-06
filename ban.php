<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR !$ban) {

  header('location: /');
    
exit;

}

    $title = 'Бан';    

include './system/h.php';

?>

<div class='main'>
  <div class='block center'>Вы забанены..
<br>Осталось: <?=vremja($ban['time'] - time())?><br/>
Дождитесь окончания бана!
  </div>
</div>

<?

include './system/f.php';
  
?>