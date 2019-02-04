<?php
    $user = 'root';
    $password = '';
    $db = 'testing';
    $host = 'localhost';

    $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
    $pdo = new PDO($dsn, $user, $password);


    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $score = trim(filter_var($_POST['score'], FILTER_SANITIZE_STRING));
    $sex = trim(filter_var($_POST['sex'], FILTER_SANITIZE_STRING));


    $sql = 'INSERT INTO list(name, score) VALUES(?, ?)';
    $query = $pdo->prepare($sql);
    $query->execute([$name, $score]);

    $sql_gold = 'SELECT * FROM `gold`';
    $query_gold  = $pdo->prepare($sql_gold);
    $query_gold ->execute();
    $num_gold  = $query_gold ->rowCount();

    $req=$pdo->prepare("select min(`score`) from `gold`");
    $req->execute();
    $min_gold=current($req->fetch());


    $sql_silver = 'SELECT * FROM `silver`';
    $query_silver = $pdo->prepare($sql_silver);
    $query_silver ->execute();
    $num_silver  = $query_silver ->rowCount();

    $req=$pdo->prepare("select min(`score`) from `silver`");
    $req->execute();
    $min_silver=current($req->fetch());


    $sql_bronze = 'SELECT * FROM `bronze`';
    $query_bronze  = $pdo->prepare($sql_bronze);
    $query_bronze ->execute();
    $num_bronze  = $query_bronze ->rowCount();

    $req=$pdo->prepare("select min(`score`) from `bronze`");
    $req->execute();
    $min_bronze=current($req->fetch());

    //вставляем нового участника
    if (($num_gold < 2)||($min_gold < $score))
      {$sql = 'INSERT INTO gold(name, score) VALUES(?, ?)';
      $query = $pdo->prepare($sql);
      $query->execute([$name, $score]);}
    else if (($num_silver < 2)||($min_silver < $score))
              {$sql = 'INSERT INTO silver(name, score) VALUES(?, ?)';
              $query = $pdo->prepare($sql);
              $query->execute([$name, $score]);}
          else if (($num_bronze < 2)||($min_bronze < $score))
                    {$sql = 'INSERT INTO bronze(name, score) VALUES(?, ?)';
                    $query = $pdo->prepare($sql);
                    $query->execute([$name, $score]);}
                else {
                  $sql = 'INSERT INTO outside(name, score) VALUES(?, ?)';
                  $query = $pdo->prepare($sql);
                  $query->execute([$name, $score]);                  
                }


    //делаем смещения в таблицах, если произошло переполнение
    $sql_gold = 'SELECT * FROM `gold` ORDER BY `score` ASC';
    $query_gold  = $pdo->prepare($sql_gold);
    $query_gold ->execute();
    $num_gold  = $query_gold ->rowCount();

    $sql_silver = 'SELECT * FROM `silver` ORDER BY `score` ASC';
    $query_silver  = $pdo->prepare($sql_silver);
    $query_silver ->execute();
    $num_silver  = $query_silver ->rowCount();

    $sql_bronze = 'SELECT * FROM `bronze` ORDER BY `score` ASC';
    $query_bronze  = $pdo->prepare($sql_bronze);
    $query_bronze ->execute();
    $num_bronze  = $query_bronze ->rowCount();

    if ($num_gold > 2) {

      //  $sql_gold =$pdo->query("SELECT * FROM 'gold' WHERE 'score' = ?");
      //  $query_gold  = $pdo->prepare($sql_gold);
        //$query_gold ->execute(['score' => $min_gold]);
        $row = $query_gold->fetch(PDO::FETCH_ASSOC);
        $sql = 'INSERT INTO silver(name, score) VALUES(?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$row['name'], $row['score']]);

        $sql = 'DELETE FROM `gold` where `score` = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$row['score']]);

        $sql_silver = 'SELECT * FROM `silver` ORDER BY `score` ASC';
        $query_silver  = $pdo->prepare($sql_silver);
        $query_silver ->execute();
        $num_silver  = $query_silver ->rowCount();

        if ($num_silver > 2) {
          $row = $query_silver->fetch(PDO::FETCH_ASSOC);
          $sql = 'INSERT INTO bronze(name, score) VALUES(?, ?)';
          $query = $pdo->prepare($sql);
          $query->execute([$row['name'], $row['score']]);

          $sql = 'DELETE FROM `silver` where `score` = ?';
          $query = $pdo->prepare($sql);
          $query->execute([$row['score']]);

          $sql_bronze = 'SELECT * FROM `bronze` ORDER BY `score` ASC';
          $query_bronze  = $pdo->prepare($sql_bronze);
          $query_bronze ->execute();
          $num_bronze  = $query_bronze ->rowCount();
        }
          if ($num_bronze > 2) {
              $row = $query_bronze->fetch(PDO::FETCH_ASSOC);
              $sql = 'INSERT INTO outside(name, score) VALUES(?, ?)';
              $query = $pdo->prepare($sql);
              $query->execute([$row['name'], $row['score']]);

              $sql = 'DELETE FROM `bronze` where `score` = ?';
              $query = $pdo->prepare($sql);
              $query->execute([$row['score']]);
            }




      }

          elseif ($num_silver > 2) {
            $row = $query_silver->fetch(PDO::FETCH_ASSOC);
            $sql = 'INSERT INTO bronze(name, score) VALUES(?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute([$row['name'], $row['score']]);

            $sql = 'DELETE FROM `silver` where `score` = ?';
            $query = $pdo->prepare($sql);
            $query->execute([$row['score']]);

            $sql_bronze = 'SELECT * FROM `bronze` ORDER BY `score` ASC';
            $query_bronze  = $pdo->prepare($sql_bronze);
            $query_bronze ->execute();
            $num_bronze  = $query_bronze ->rowCount();

            if ($num_bronze > 2) {
              $row = $query_bronze->fetch(PDO::FETCH_ASSOC);
              $sql = 'INSERT INTO outside(name, score) VALUES(?, ?)';
              $query = $pdo->prepare($sql);
              $query->execute([$row['name'], $row['score']]);

              $sql = 'DELETE FROM `bronze` where `score` = ?';
              $query = $pdo->prepare($sql);
              $query->execute([$row['score']]);
            }
          }

              elseif ($num_bronze > 2) {
                $row = $query_bronze->fetch(PDO::FETCH_ASSOC);
                $sql = 'INSERT INTO outside(name, score) VALUES(?, ?)';
                $query = $pdo->prepare($sql);
                $query->execute([$row['name'], $row['score']]);

                $sql = 'DELETE FROM `bronze` where `score` = ?';
                $query = $pdo->prepare($sql);
                $query->execute([$row['score']]);
              }

    header('Location:index.php');




 ?>
