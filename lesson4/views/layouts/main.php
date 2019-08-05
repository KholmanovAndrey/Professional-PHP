<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <ul class="menu">
                    <li class="menu__list"><a class="menu__link" href="?a=users">Пользователи</a></li>
                    <li class="menu__list"><a class="menu__link" href="?c=good&a=goods">Товары</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="content"><?= $content ?></div>
</body>
</html>