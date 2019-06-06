<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
  if($user['id'] < 1) {

  header('location: /');
    
exit;

}

    $title = 'SQL manager';    

include './system/h.php';



?>
<?

  if($_POST['text']) {
  
  if(mysql_query($_POST['text'])) {
  
?>

<div class='block center'>
SQL запрос: <code><?$_POST['text']?></code> успешно выполнен!
</div>
 <div class='mini-line'></div>

<?
  
  }
  else
  {
  
  }
  
  }

?>

<div class='main'>
<div class='block'>
  <form action='?' method='post'>
  
    <textarea name='text' style='width: 97%'></textarea><br/>
<span class='btn'><span class='end'><input class='label' type='submit' value='Выполнить'>Выполнить</span></span>
  </form></div></div>
<?

include './system/f.php';
  
?>