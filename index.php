<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"  rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
             <i class="fa-solid fa-cubes"></i>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/lego">LEGO Chima</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/ice">Лед</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/fire">Огонь</a>
                </li>
                <!-- <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->
            </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php if ($_SERVER["REQUEST_URI"] == "/lego") { ?>
            Вы на главной странице! =)
        <?php } elseif ($_SERVER["REQUEST_URI"] == "/ice") { ?>
            Тут мы вам расскажем о волшебной Галактике Андромеда
        <?php } elseif ($_SERVER["REQUEST_URI"] == "/fire") { ?>
            Был значит один кот, и носил он галактику в поясе Ориона
        <?php } ?>
    </div>
</body>
</html>