<?php
if(isset($_GET['box'])){
    if($_GET['box']== 'update'){
        $id = intval($_GET['id']);
        require '../connect.php';
        $sql = "select * from users where id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    $username = $role = $pass = "";
    if(isset($_POST['send'])){
        require '../datacorrection.php';
        $username = datacorrection($_POST['username']);
        $role = datacorrection($_POST['role']);
        $pass = datacorrection($_POST['password']);
        if(!empty($username)&&!empty($role)&&!empty($pass)){
            require '../connect.php';
            $sql = "update users set username = '$username' , role = '$role' , pass = '$pass' where id = '$id'";
            if($conn->query($sql)===true){
                echo "the data was updated successfuly.<br>";
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
        <h1>update user</h1>
        <form action = "" method = "POST">
            <div class="form-group">
                <label for="name">userName:</label>
                <?php
                require '../connect.php';
                $sql2 = "select * from users where id = '$id'";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc()
                ?>
                <input type="text" class="form-control" id="name" name = "username" value = "<?php echo $row2['username'];?>">
            </div>
            <div class="form-group">
                <label for="role">role:</label>
                <input type="text" class="form-control" id="role" name = "role" value = "<?php echo $row2['role'];?>">
            </div>
            <div class="form-group">
                <label for="password">password:</label>
                <input type="password" class="form-control" id="password" name = "password" value = "<?php echo $row2['role'];?>">
            </div>
            <button type="submit" class="btn btn-primary" name = "send">send</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    }
    elseif($_GET['box']== 'delete'){
        $id = intval($_GET['id']);
        require '../connect.php';
        $sql = "delete from users  where id = '$id'";
        if($conn->query($sql)===true){
            echo "the data was updated successfuly.<br>";
        }else{echo "error:<br>";}
        $conn->close();
        header("REFRESH:0 , url = index.php");
        }
    }
?>