
<!DOCTYPE html>
<html>
<head>
	<title>Пример №1 к статье "Универсальный jQuery-скрипт для блоков с вкладками (табами)"</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="tabs.js"></script>
	<script>if((self.parent&&!(self.parent===self))&&(self.parent.frames.length!=0)){self.parent.location = document.location}</script>
	<link href="style.css" rel="stylesheet" />
</head>

<body>

  <p> <a href="index.php">Вернуться обратно</a></p>
  <div class="tabs">

	<ul class="tabs__caption">
		<li class="active">Общая таблица</li>
		<li>Золото</li>
		<li>Серебро</li>
		<li>Бронза</li>
    <li>Выбывшие</li>
	</ul>

	<div class="tabs__content  active">

    <div class="col-md-8 mb-5">
      <table class="table table-striped table-inverse">
  <thead>
    <tr>
      <th>Name</th>
      <th>Score</th>
    </tr>
  </thead>
  <tbody>



            <?php

           $user = 'root';
            $password = '';
            $db = 'testing';
            $host = 'localhost';

            $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
            $pdo = new PDO($dsn, $user, $password);

            $sql = 'SELECT * FROM `list`';
            $query = $pdo->prepare($sql);
            $query->execute();

        // выводим в HTML-таблицу все данные клиентов из таблицы MySQL
         while($row = $query->fetch(PDO::FETCH_OBJ)){
           echo '<tr>';
           echo '<td>' . $row->name . '</td>';
           echo '<td>' . $row->score . '</td>';
          // echo  '<td> <a href="index.php">Редактировать</a> </td>';
          echo "<td>
            <a href='edit.php?id=$row->id'>
               <button>Редактировать</button>
             </a>
           </td>";
           echo '</tr>';
         }


            ?>
          </tbody>
        </table>
        </div>
  	</div>

	<div class="tabs__content">
    <div class="col-md-8 mb-5">
      <table class="table table-striped table-inverse">
    <thead>
    <tr>
      <th>Name</th>
      <th>Score</th>
    </tr>
    </thead>
    <tbody>



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

        // выводим в HTML-таблицу все данные клиентов из таблицы MySQL
         while($row = $query->fetch(PDO::FETCH_ASSOC)){
           echo '<tr>';
           echo '<td>' . $row['name'] . '</td>';
           echo '<td>' . $row['score'] . '</td>';
        //   echo  '<td> <a href="index.php">Редактировать</a> </td>';
           echo '</tr>';
         }


            ?>
          </tbody>
        </table>
        </div>
	</div>

	<div class="tabs__content">
    <div class="col-md-8 mb-5">
      <table class="table table-striped table-inverse">
    <thead>
    <tr>
      <th>Name</th>
      <th>Score</th>
    </tr>
    </thead>
    <tbody>



            <?php

           $user = 'root';
            $password = '';
            $db = 'testing';
            $host = 'localhost';

            $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
            $pdo = new PDO($dsn, $user, $password);

            $sql = 'SELECT * FROM `silver`';
            $query = $pdo->prepare($sql);
            $query->execute();

        // выводим в HTML-таблицу все данные клиентов из таблицы MySQL
         while($row = $query->fetch(PDO::FETCH_ASSOC)){
           echo '<tr>';
           echo '<td>' . $row['name'] . '</td>';
           echo '<td>' . $row['score'] . '</td>';
          // echo  '<td> <a href="index.php">Редактировать</a> </td>';
           echo '</tr>';
         }


            ?>
          </tbody>
        </table>
        </div>
  	</div>

	<div class="tabs__content">
    <div class="col-md-8 mb-5">
      <table class="table table-striped table-inverse">
    <thead>
    <tr>
      <th>Name</th>
      <th>Score</th>
    </tr>
    </thead>
    <tbody>



            <?php

           $user = 'root';
            $password = '';
            $db = 'testing';
            $host = 'localhost';

            $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
            $pdo = new PDO($dsn, $user, $password);

            $sql = 'SELECT * FROM `bronze`';
            $query = $pdo->prepare($sql);
            $query->execute();

        // выводим в HTML-таблицу все данные клиентов из таблицы MySQL
         while($row = $query->fetch(PDO::FETCH_ASSOC)){
           echo '<tr>';
           echo '<td>' . $row['name'] . '</td>';
           echo '<td>' . $row['score'] . '</td>';
           //echo  '<td> <a href="index.php">Редактировать</a> </td>';
           echo '</tr>';
         }


            ?>
          </tbody>
        </table>
        </div>
</div>


<div class="tabs__content">
  <div class="col-md-8 mb-5">
    <table class="table table-striped table-inverse">
  <thead>
  <tr>
    <th>Name</th>
    <th>Score</th>
  </tr>
  </thead>
  <tbody>



          <?php

         $user = 'root';
          $password = '';
          $db = 'testing';
          $host = 'localhost';

          $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
          $pdo = new PDO($dsn, $user, $password);

          $sql = 'SELECT * FROM `outside`';
          $query = $pdo->prepare($sql);
          $query->execute();

      // выводим в HTML-таблицу все данные клиентов из таблицы MySQL
       while($row = $query->fetch(PDO::FETCH_ASSOC)){
         echo '<tr>';
         echo '<td>' . $row['name'] . '</td>';
         echo '<td>' . $row['score'] . '</td>';
        // echo  '<td> <a href="index.php">Редактировать</a> </td>';
         echo '</tr>';
       }


          ?>
        </tbody>
      </table>
      </div>
</div>
</div>

</body>
</html>
