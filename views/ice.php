<?php
$is_image = $url == '/ice/image';
$is_info  = $url == '/ice/info';
?>

<h1>Лед</h1>
<div class="mb-3">
    <ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link <?= $is_image ? "active" : '' ?>" href="/ice/image">Картинка</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $is_info ? "active" : '' ?>" href="/ice/info">Описание</a>
    </li>
    </ul>
</div>


<?php
if($is_image){
    require "ice_image.php";
}elseif($is_info){
    require "ice_info.php";
}else{
    echo "Выберите раздел Описание или Картинка";
}
?>
