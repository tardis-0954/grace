<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if($user) {

  header('location: /');
    
exit;

}

$ref = _string(_num($_GET['ref']));
$a = _string(_num($_GET['a']));
$password = rand(1,999999);

  if(mysql_query('INSERT INTO `users` (`login`,
                                    `password`) VALUEs ("Боец",
                                               "'.$password.'")')) {
    
    $id = mysql_insert_id();

if($ref) {

  $ref_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$ref.'"');
  $ref_user = mysql_fetch_array($ref_user);

  if($ref_user) {
  
    mysql_query('INSERT INTO `ref` (`user`,
                                      `ho`) VALUEs ("'.$ref_user['id'].'",
                                                                "'.$id.'")');
   if($_SERVER['REMOTE_ADDR'] == $ref_user['ip']) {
include ('./system/h.php');
header('location:http://bdls.ru');
echo '<div class="main"><div class="block">Запрещена регистрация по реферальной ссылке!</div></div>';
  include ('./system/f.php');
  exit();
  }
   mysql_query("update `users` set `g` = `g` + 1000, `access` = '".$a."' where `id` = '".$ref_user['id']."'");
  
  }

}
  
  $user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $user = mysql_fetch_array($user);
  
    $_g = 10000;
    $_s = 100000;
    
     
     mysql_query('UPDATE `users` SET `hp` = "'.($user['vit'] * 2).'",
                                     `mp` = "'.$user['mana'].'" WHERE `id` = "'.$id.'"');

     mysql_query('UPDATE `users` SET `g`  ="'.$_g.'",
                                     `s`  ="'.$_s.'", `iznos_time` = "'.(time() + 43200).'" WHERE `id` = "'.$id.'"');


            setCookie('id', $user['id'], time() + 86400 * 365, '/');
setCookie('password', $password, time() + 86400 * 365, '/');
    
    
      header('location: /');

  }

?>