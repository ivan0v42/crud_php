<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Создание, просмотр, редактирование и удаление пользователей</h3>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Создать запись</a>
                </p>
               
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Имя</th>
                          <th>Фамилия</th>
                          <th>Возраст</th>
                          <th>Email</th>
                          <th>Контактный телефон</th>
                          <th style="width:350px">Доступные действия</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM users ORDER BY id ASC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['lastname'] . '</td>';
                                echo '<td>'. $row['age'] . '</td>';
                                echo '<td>'. $row['email'] . '</td>';
                                echo '<td>'. $row['mobile'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn btn-success" href="read.php?id='.$row['id'].'">Просмотреть</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Обновить</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Удалить</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
              
        </div>
    </div> <!-- /container -->
  </body>
</html>