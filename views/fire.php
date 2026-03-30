<?php
$is_image = $url == '/fire/image';
$is_info  = $url == '/fire/info';
?>

<h1>Огонь</h1>
<div class="mb-3">
    <ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link <?= $is_image ? "active" : '' ?>" href="/fire/image">Картинка</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $is_info ? "active" : '' ?>" href="/fire/info">Описание</a>
    </li>
    </ul>
</div>


<?php
if($is_image){
    require "fire_image.php";
}elseif($is_info){
    require "fire_info.php";
}else{
    echo "Выберите раздел Описание или Картинка";
}
?>