<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="icon" type="image" href="img/icon_PHP.ico" sizes="32x32">
  <!--<link rel="stylesheet" href="style.css">-->
  <title>Результаты соревнований</title>

  <?php

    $user = 'root';
    $password = '';
    $db = 'testing';
    $host = 'localhost';

    $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
    $pdo = new PDO($dsn, $user, $password);
    $sql = 'SELECT * FROM `gold`';
    $query = $pdo->prepare($sql);
    $query->execute();
    $num = $query->rowCount();
  /*  $sql_gold_min = 'SELECT MIN(`score`) FROM `competition`';
    $query_gold_min  = $pdo->prepare($sql_gold_min);
    $row = $query_gold_min ->fetch(PDO::FETCH_OBJ);
    echo $row;*/

    $req=$pdo->prepare("select min(`score`) from `competition`");
    $req->execute();
    $min=current($req->fetch());

    //$min = $row->score;
  ?>


</head>
<body>
      <div class="col-md-8 mb-5">
             <h4 class="mt-5">Результаты соревнований</h4>
             <form action="db.php" method="post">
               <label for="name">Имя участника</label>
               <input type="text" name="name" id="name" class="form-control">

               <label for="score">Баллы</label>
               <input type="number" name="score" id="score" class="form-control">

               <br><br>
             <label for="male">Мужской: </label><input type="radio" name="sex" id="male" value="male">
             <label for="female">Женский: </label><input type="radio" name="sex" id="female" value="female">
             <br><br>

                <button type="submit" id="send" class="btn btn-success mt-3">Сохранить</button>

                </form>

              <input type="button" id="count" class="btn btn-success mt-3" value="Количество участников">

              <form action="del.php" method="post">
                <label for="del">Имя участника</label>
                <input type="text" name="del" id="del" class="form-control">
                 <button type="submit" id="send1" class="btn btn-success mt-3">Удалить</button>
               </form>

          </div>

</body>
</html>
