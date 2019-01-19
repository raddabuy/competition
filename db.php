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


    $sql = 'INSERT INTO competition(name, score, sex) VALUES(?, ?, ?)';
    $query = $pdo->prepare($sql);
    $query->execute([$name, $score, $sex]);



      $sql = 'INSERT INTO ' .$sex. '(name, score) VALUES(?, ?)';
      $query = $pdo->prepare($sql);
      $query->execute([$name, $score]);

    /*else if($sex == 'female')
    {
      $sql = 'INSERT INTO female(name, score) VALUES(?, ?)';
      $query = $pdo->prepare($sql);
      $query->execute([$name, $score]);
    }*/

    header('Location:index.php');




 ?>
