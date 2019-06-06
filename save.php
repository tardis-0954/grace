<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

if($user['save'] == 1) {

  header('location: /');
  exit;

}

$title = 'Сохранение';    

include './system/h.php';  

   $login = _string($_POST['login']);
$password = _string($_POST['password']);

if($login && $password) {
  
  if(!preg_match('/[a-z0-9а-я]{2,10}/i', $login)) $errors[] = 'Имя персонажа введено неверно';
  if(!preg_match('/[a-z0-9]{2,10}/i', $password)) $errors[] = 'Пароль введен неверно';

  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `login` = \''.$login.'\''),0) != 0) $errors[] = 'Выбранное имя персонажа уже занято';  
  
  if($errors) {

        echo '<div class=\'main\' align=\'center\'>';
        
        foreach($errors as $error) {
          
          echo $error.'';
          
        }
      
        echo '</div>
<div class=\'mini-line\'></div>';

  }
  else
  {
  
    mysql_query('UPDATE `users` SET `login` = \''.$login.'\', 
                                 `password` = \''.$password.'\',
                                     `save` = \'1\'  WHERE `id` = \''.$user['id'].'\'');

    setCookie('password', $password, time() + 86400 * 365, '/');
  
    header('location: /');
  
  }
  
}

echo '<div class=\'main\'>
<div class=\'block\' align=\'center\'>
  <form action=\'/save/\' method=\'post\'>
  Имя персонажа:<br/>
  <input name=\'login\' value=\''.$login.'\' class=\'text\'><br/>
  Пароль:<br/>
  <input name=\'password\' value=\''.$password.'\' type=\'password\' class=\'text\'><br/>
  <span class=\'btn\'><span class=\'end\'><input class=\'label\' type=\'submit\' value=\'Сохранить\'>Сохранить</span></span>
</form>
</div>

</div>';
  
include './system/f.php';

?>