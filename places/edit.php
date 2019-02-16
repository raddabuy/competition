<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="icon" type="image" href="img/icon_PHP.ico" sizes="32x32">
  <!--<link rel="stylesheet" href="style.css">-->
  <title>Редактирование</title>

  <?php

    $user = 'root';
    $password = '';
    $db = 'testing';
    $host = 'localhost';

    $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
    $pdo = new PDO($dsn, $user, $password);


    $sql = 'SELECT * FROM `list` WHERE `id`=:id';
    $id = $_GET['id'];
    $query = $pdo->prepare($sql);
    $query->execute(['id'=>$id]);

    $student = $query->fetch(PDO::FETCH_ASSOC);

   ?>





</head>
<body>
      <div class="col-md-8 mb-5">
             <h4 class="mt-5">Результаты соревнований</h4>
             <form action="db.php" method="post">
               <label for="name">Имя участника</label>
               <input type="text" name="name" id="name" class="form-control" value = <?=$student['name']?>>

               <label for="score">Баллы</label>
               <input type="number" name="score" id="score" class="form-control" value = <?=$student['score']?>>

               <br><br>
             <label for="male">Мужской: </label><input type="radio" name="sex" id="male" value="male">
             <label for="female">Женский: </label><input type="radio" name="sex" id="female" value="female">
             <br><br>

                <button type="submit" id="send" class="btn btn-success mt-3">Сохранить</button>

                </form>

              <p> <a href="tab_index.php">Показать списки</a></p>

          </div>

</body>
</html>
