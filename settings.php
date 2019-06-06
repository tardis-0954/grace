<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
  exit;

}


$title = 'Настройки';    

include './system/h.php';  

echo '<div class=\'main\'>';

$login = _string($_POST['login']);

if($login) {
   
  if($user['g'] < 250) $errors[] = 'Не хватает <img src=\'/images/icon/gold.png\' alt=\'*\'> '.(250 - $user['g']).' золота<div class=\'separ\'></div><a href=\'/trade/\'>Купить золото</a>';  
  
  if(!preg_match('/[a-z0-9а-я]{2,20}/i', $login)) $errors[] = 'Имя персонажа введено не верно';
        
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `login` = \''.$login.'\''),0) != 0) $errors[] = 'Персонаж с такими именем уже зарегестрирован';
        
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
  
    mysql_query('UPDATE `users` SET `login` = \''.$login.'\',
                                     `g` = `g` - 250 WHERE `id` = \''.$user['id'].'\'');
    header('location: /');
  
  }

}


    
$password = _string($_POST['password']);

if($password) {  
  
  if(!preg_match('/[a-z0-9]{2,20}/i', $password)) $errors[] = 'Пароль введен неверно';
  
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

    mysql_query('UPDATE `users` SET `password` = \''.$password.'\' WHERE `id` = \''.$user['id'].'\'');

    setCookie('password', $password, time() + 86400 * 365, '/');



    header('location: /');
    
  }
  
}
  
echo '<div class=\'menuList\'>';
  
  ?>

  <?
  if($user['access'] != 0) 
 
  echo'<li><a  href=\'/adm/\'><img src=\'/images/icon/arrow.png\' alt=\'*\'/> Админ-панель</a></li>';
 ?>
  
<?
echo'
  <li><a href=\'/settings/login/\'><img src=\'/images/icon/arrow.png\' alt=\'*\'/>Сменить имя персонажа</a></li>
  <li><a href=\'/settings/password/\'><img src=\'/images/icon/arrow.png\' alt=\'*\'/>Сменить пароль</a></li>
  <li><a href=\'/settings/sex/\'><img src=\'/images/icon/arrow.png\' alt=\'*\'/>Сменить пол</a></li>
  <li><a href=\'/settings/race/\'><img src=\'/images/icon/arrow.png\' alt=\'*\'/>Сменить сторону</a></li></div>';

if($_GET['action']) {
  
  echo '<div class=\'mini-line\'></div>
<div class=\'block_zero\'>';

  switch($_GET['action']) {
    case 'login':

    echo '<form action=\'/settings/login/\' method=\'post\'>
  Введите новое имя:<br/>
  <input name=\'login\' class=\'text\'/><br/>
   <span class=\'btn\'><span class=\'end\'><input class=\'label\' type=\'submit\' value=\'Сменить\'>Сменить</span></span>
</form>';

    break;
    case 'password':
  
    echo '<form action=\'/settings/password/\' method=\'post\'>
  Введите новый пароль:<br/>
  <input name=\'password\' class=\'text\' type=\'password\'/><br/>
  <span class=\'btn\'><span class=\'end\'><input class=\'label\' type=\'submit\' value=\'Сменить\'>Сменить</span></span>
</form>';

    break;
    case 'race':

    if($_GET['change'] == true && $user['g'] >= 50) {  
  
      mysql_query('UPDATE `users` SET `r` = "'.($user['r'] == 0 ? 1:0).'", `g` = `g` - 50 WHERE `id` = "'.$user['id'].'"');

      header('location: /');
  
    }

    echo 'Текущая сторона: <img src=\'/images/icon/race/'.$user['r'].'.png\' alt=\'*\'/> '.($user['r'] == 0 ? 'Асура':'Борея').'<br/>
Желаете сменить сторону на <img src=\'/images/icon/race/'.($user['r'] == 0 ? 1:0).'.png\' alt=\'*\'/> '.($user['r'] == 0 ? 'Борея':'Асура').'?<br/>
<a class=\'btn\' href=\'/settings/race/?change=true\'><span class=\'end\'><span class=\'label\'>Да, сменить</a></span></span>';

    break;
    case 'sex':

    if($_GET['change'] == true) {  
  
      mysql_query('UPDATE `users` SET `sex` = \''.($user['sex'] == 0 ? 1:0).'\' WHERE `id` = \''.$user['id'].'\'');

      header('location: /');
  
    }

    echo 'Вы уверены что хотите сменить пол на <b>'.($user['sex'] == 0 ? 'Женский':'Мужской').'</b>?<br/>
    <a class=\'btn\' href=\'/settings/sex/?change=true\'><span class=\'end\'><span class=\'label\'>Да, сменить</a></span></span>';

    break;

    echo '</div>';
    
  } 

  echo '</div>';

}

echo '<div class=\'mini-line\'></div>
  <div class=\'menuList\'>
  <li><a href=\'/?exit\'><img src=\'/images/icon/section.png\' alt=\'*\'/> <font color=\'#909090\'>Выйти из игры</font></a></li>
</div></div>';
  
include './system/f.php';

?>