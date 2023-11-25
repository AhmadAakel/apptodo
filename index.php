<?php
$user = $pass = "";
$user_err = $pass_err = "";
require './datacorrection.php';
require './connect.php';
if(isset($_POST['send'])){
    if(empty($_POST['user'])){
        $user_err = "*required";
    }else{
        $user = datacorrection($_POST['user']);
        session_start();
        $_SESSION['var'] = $user;}
    if(empty($_POST['pass'])){
        $pass_err = "*required";
    }else{$pass = datacorrection($_POST['pass']);}
    if(!empty($user)&&!empty($pass)){
        if($user == "admin" && $pass == "admin"){
            $conn->close();
            header("REFRESH:0 url = ./users/index.php");
        }else{
        $sql = "select * from users";
        $result = $conn->query($sql);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                if($user == $row['username']&&$pass == $row['pass']){
                    if($row['role']=="manager"){
                        $conn->close();
                        header("REFRESH:0 url = ./users/index.php");
                    }else{
                        $conn->close();
                        header("REFRESH:0 url = ./tasks/task_user.php");
                    }
                    
                }
               
            }
        }
    }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    
    <div class="row justify-content-center">
        <div class="card text-center">
          <div class="card-header">
            Login
          </div>
          <div class="card-body">
            <form action="" method = "POST">
            <div class="form-group">
                          <label for="user">username:</label>
                          <input type="text" class="form-control rounded-pill" id="user" aria-describedby="emailHelp" name = "user">
                          <?php echo $user_err; ?>
                      </div>
                      <div class="form-group">
                          <label for="pass">password:</label>
                          <input type="password" class="form-control rounded-pill" id="pass" aria-describedby="emailHelp" name = "pass">
                          <?php echo $pass_err; ?>
                      </div>
                      <button type="submit" class="btn btn-primary" name = "send">login</button>
            </div>
            </form>
          <div class="card-footer text-muted">
            VICA
          </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    
?>