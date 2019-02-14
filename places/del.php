<?php
    $user = 'root';
    $password = '';
    $db = 'testing';
    $host = 'localhost';

    $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
    $pdo = new PDO($dsn, $user, $password);


    $name = trim(filter_var($_POST['del'], FILTER_SANITIZE_STRING));

    function number($table)
       {
         global $pdo;
         $sql_gold = 'SELECT * FROM ' .$table;
         $query_gold  = $pdo->prepare($sql_gold);
         $query_gold ->execute();
         $number  = $query_gold ->rowCount();
         return $number;
       }

    function minimum($table)
      {
        global $pdo;
      $req=$pdo->prepare("select min(`score`) from " .$table);
        $req->execute();
        $minimum=current($req->fetch());
        return $minimum;

      }

      function insert($table, $name, $score)
      {
        global $pdo;
        $sql = 'INSERT INTO ' .$table. '(name, score) VALUES(?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$name, $score]);
      }

      function delete($table, $row)
      {
        global $pdo;
        $sql = 'DELETE FROM '.$table.' where `score` = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$row['score']]);
      }

      function shift($from, $to)
      {
       //$row = row($from);
       global $pdo;
       $sql_gold = 'SELECT * FROM '.$from. ' ORDER BY `score` ASC';
       $query_gold  = $pdo->prepare($sql_gold);
       $query_gold ->execute();
       $row = $query_gold->fetch(PDO::FETCH_ASSOC);

        $name = $row['name'];
       $score = $row['score'];

        insert($to,$name, $score);

        delete($from, $row);
      }

    $sql = 'DELETE FROM `list` where `name` = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$name]);

    $sql_list = 'SELECT * FROM `list`' ;
    //ORDER BY `score` ASC
    $query_list  = $pdo->prepare($sql_list);
    $query_list ->execute();

    $sql = $pdo->query('TRUNCATE TABLE `gold`');

    $sql = $pdo->query('TRUNCATE TABLE `silver`');

    $sql = $pdo->query('TRUNCATE TABLE `bronze`');

    $sql = $pdo->query('TRUNCATE TABLE `outside`');

    while ($row = $query_list->fetch(PDO::FETCH_OBJ)) {
              $name = $row->name;
              $score = $row->score;
              if ((number('gold') < 2)||(minimum('gold') < $score))
                {
                insert('gold',$name, $score);
              }
              else if ((number('silver') < 2)||(minimum('silver') < $score))
                        {
                        insert('silver',$name, $score);
                      }
                    else if ((number('bronze')   < 2)||(minimum('bronze') < $score))
                              {
                              insert('bronze',$name, $score);
                          }
                          else {

                            insert('outside',$name, $score);
                          }


              //делаем смещения в таблицах, если произошло переполнение


              if (number('gold')  > 2) {
                  shift('gold', 'silver', $row);
                  if (number('silver') > 2) {
                      shift('silver', 'bronze', $row);
                    if (number('bronze') > 2) {
                          shift('bronze', 'outside', $row);
                      }
                    }
                }
                    elseif (number('silver') > 2) {
                      shift('silver', 'bronze', $row);
                      if (number('bronze')  > 2) {
                        shift('bronze', 'outside', $row);
                      }
                    }
                        elseif (number('bronze') > 2) {
                          shift('bronze', 'outside', $row);
                        }


                }


    header('Location:index.php');




 ?>
