<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $lastnameError = null;
        $ageError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
         
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Пожалуйста, введите ваше имя';
            $valid = false;
        }

        if (empty($lastname)) {
            $lastNameError = 'Пожалуйста, введите фамилию';
            $valid = false;
        }

        if (empty($age) or $age <= 0) {
            $ageError = 'Пожалуйста, введите корректный возраст';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Пожалуйста, введите электронную почту';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Пожалуйста, введите корректный адрес электронной почты';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Пожалуйста, введите номер моб.телефона';
            $valid = false;
        }
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (name, lastname, age, email,mobile) values(?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name, $lastname, $age, $email,$mobile));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Создание пользователя</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Имя</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Имя" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($lastNameError)?'error':'';?>">
                        <label class="control-label">Фамилия</label>
                        <div class="controls">
                            <input name="lastname" type="text"  placeholder="Фамилия" value="<?php echo !empty($lastname)?$lastname:'';?>">
                            <?php if (!empty($lastNameError)): ?>
                                <span class="help-inline"><?php echo $lastNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>


                      <div class="control-group <?php echo !empty($lastNameError)?'error':'';?>">
                        <label class="control-label">Возраст</label>
                        <div class="controls">
                            <input name="age" type="text"  placeholder="Возраст" value="<?php echo !empty($age)?$age:'';?>">
                            <?php if (!empty($ageError)): ?>
                                <span class="help-inline"><?php echo $ageError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">Телефон</label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Контактный телефон" value="<?php echo !empty($mobile)?$mobile:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Создать пользователя</button>
                          <a class="btn" href="index.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>