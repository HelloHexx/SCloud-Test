<!doctype html>
<html lang="ru">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/style.css">
    <title>NEWS</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-head">
            <a class="navbar-brand" href="#">NEWS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Главная</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <h1 class="mb-5 mt-5" style="text-align: center;">Админ панель</h1>
    </div>
    <div class="container m-auto p-2 bg-light rounded board">
        <div class="container p-4">
            <h2>Добавление статьи</h2>
            <form action="/add_post" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Text</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text"></textarea>
                </div>
                <div class="form-group">
                    <label for="inputDate">Введите дату:</label>
                    <input type="date" class="form-control" name="date">
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
            <hr>
            <h2>Удаление статей</h2>
            <form action="/add_post" method="POST">
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Выберите статьи(ю)</label>
                    <select multiple class="form-control" id="exampleFormControlSelect2" name="del">
                        <?php
            foreach ($data as $item) {
                echo("<option value='$item->id' >$item->id : $item->Title</option>");
            }
            ?>
                      <!-- <option>1</option> -->
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>

        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>