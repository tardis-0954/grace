<? 
include './system/common.php';

include './system/functions.php';
include './system/user.php';
if($clan['id'] == 0 || $clan_memb['rank'] < 4){
include './system/h.php'; 
echo' <div class="main center">Доступно только для главы клана!</div>';
include './system/f.php'; 
exit;
}
$title = 'Клановый герб'; 
include './system/h.php'; 
$error = NULL;

if(isset($_POST['id'])) {
$id = _num($_POST['id']);
if($id > 1 || $id < 19) {
mysql_query("UPDATE `clans` SET `gerb` = '$id' WHERE `id` = '".$clan['id']."'");
header("Location: /clan/");
exit();
}

}

if($error) {
echo '<div class="main" style="color: red">
'.$error.'
</div>';
}

echo '
<form action="?" method="post" action="">';
for($i = 1; $i < 18; $i++) {
echo '<div class="main" style="padding: 4px;">';
echo '<input type="radio" name="id" value="'.$i.'" /> 
<img src="/images/icon/clan/gerb/'.$i.'.png" /> '; 
echo '</div>';
}
echo "<div class='main'>
<div class='block'/>
<span class='btn'><span class='end'><input class='label' type='submit' value='Установить'>Установить</span></span>
</form></div>
</div>";

include './system/f.php';
?>