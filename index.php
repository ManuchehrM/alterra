<html>
    <head>
        <title>ТЗ - Alterra.ru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "alterra_task";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            echo "<h2 class='text-center text-danger'>Connection ERROR!</h2>";
            die("Connection failed: " . $conn->connect_error);
        }
        
    ?>
        <div class="row">
            <div class="card col-md-4 first-card">
            
                <div class="card-body">
                    <div class="card-title">
                        <h5>Добавить контакт</h2>
                    </div>
                    <?php
                        if(isset($_POST['name'])){ 
                            $insert_data = 'INSERT INTO contacts(name, tel) VALUES("'.$_POST['name'].'", "'.$_POST['tel'].'")';
                            if ($conn->query($insert_data) === TRUE) {
                                echo '<div class="alert alert-success" role="alert">
                                        Контакт успешно добавлено!
                                       </div>';
                            } else {
                                echo '<div class="alert alert-warning" role="alert">Ошибка: ' . $sql . "<br>" . $conn->error.'</div>';
                            }
                        }
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Имя" name="name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Телефон" name="tel">
                        </div>
                        <button class="btn float-right">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-md-4 second-card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Список контактов</h2>
                    </div>
                    <?php
                     if(isset($_GET['delete']) && !empty($_GET['delete'])){
                        $conn->query('UPDATE contacts SET status=0 where id = '.$_GET['delete']);
                        echo '<div class="alert alert-success" role="alert">';
                           echo 'Контакт успешно удалено!';
                        echo '</div>';
                    }
                        $sql = "SELECT contacts.id, contacts.name, contacts.tel FROM contacts WHERE status=1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {    
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h6><?= $row['name'] ?> <a href="index.php?delete=<?php echo $row['id'] ?>" class="delete-link"><span class="fa fa-times">&times;</span></a></h6>
                            <span><?= $row['tel'] ?></span>
                        </div>
                    </div>
                    <hr>
                    <?php 
                        }
                    } 
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>