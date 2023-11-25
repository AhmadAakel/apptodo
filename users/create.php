<?php
            $username = $role = $pass = "";
            $username_err = $role_err = $pass_err = "";
            require '../datacorrection.php';
            if(isset($_POST['send'])){
                if(empty($_POST['username'])){
                    $username_err = "*required";
                }
                else{$username = datacorrection($_POST['username']);}
                if(empty($_POST['role'])){
                    $role_err = "*required";
                }
                else{
                    $role = datacorrection($_POST['role']);
                }
                if(empty($_POST['password'])){
                    $pass_err = "*required";
                }else{$pass = datacorrection($_POST['password']);}
                if(!empty($username)&&!empty($role)&&!empty($pass)){
                    require '../connect.php';
                    $sql = "insert into users values (null , '$username' , '$role' , '$pass')";
                    if($conn->query($sql)===true){
                        echo "the data was added successfuly.<br>";
                    }else{echo "error:<br>";}
                    $conn->close();
                    header("REFRESH:0 , url = index.php");
                }
            }
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>add user</h1>
        <form action = "" method = "POST">
            <div class="form-group">
                <label for="name">name:</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name = "username">
                <?php echo $username_err; ?>
            </div>
            <div class="form-group">
                <label for="role">role:</label>
                <input type="text" class="form-control" id="role" name = "role">
                <?php echo $role_err; ?>
            </div>
            <div class="form-group">
                <label for="password">password:</label>
                <input type="password" class="form-control" id="password" name = "password">
                <?php echo $pass_err; ?>
            </div>
            <button type="submit" class="btn btn-primary" name = "send">send</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>