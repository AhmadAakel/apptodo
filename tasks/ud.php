<?php
if(isset($_GET['box'])){
    if($_GET['box']== 'update'){
        $id = intval($_GET['id']);
        require '../connect.php';
        $sql = "select * from tasks where id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    $task = $description = $user = "";
    $task_err = $description_err = $user_err = "";
    if(isset($_POST['send'])){
        require '../datacorrection.php';
        if(empty($_POST['task'])){
            $task_err = "*required";
        }
        else{$task = datacorrection($_POST['task']);}
        if(empty($_POST['description'])){
            $description_err = "*required";
        }else{$description = datacorrection($_POST['description']);}
        if(empty($_POST['user'])){
            $user_err = "*required";
        }else{$user = $_POST['user'];}
        
        if(!empty($task)&&!empty($description)&&!empty($user)){
            require '../connect.php';
            $sql3 = "update tasks set task = '$task' , description = '$description'";
            $conn->query($sql3);
            
            $sql2 = "select * from users_tasks where task_id = '$id'";
            $result2 = $conn->query($sql2);
            if($result2->num_rows > 0){
                while($row2 = $result2->fetch_assoc()){
                    $sql4 = "delete from Users_tasks where task_id = '$id' AND user_id <> '$u' ";
                    $conn->query($sql4);
                }
                foreach($user as $u){
                    $sql5 = "insert into users_tasks values (null , '$u' , '$id')";
                    $conn->query($sql5);
            }
            
                
            }
                        
            
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
        <h1>update task</h1>
        <form action ="" method = "POSt">
            <div class="form-group">
                <label for="exampleFormControlInput1">tasks:</label>
                <?php
                require '../connect.php';
                $sql2 = "select * from tasks where id = '$id'";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc()
                ?>
                <input type="text" class="form-control" id="exampleFormControlInput1" name = "task" value = "<?php echo $row2['task'];?>">
                <?php echo $task_err; ?>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">description:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "description" ><?php echo $row2['description'];?></textarea>
                <?php echo $description_err; ?>
            </div>
            
            <div class="form-group">
            <?php
                    require '../connect.php';
                    $sql = "select * from users";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                ?>
                <select multiple class="form-control" id="exampleFormControlSelect2" name = "user[]">
                <?php 
                    while($row = $result->fetch_assoc()){
                    ?>
                <option value = "<?php echo $row['id']; ?>" ><?php echo $row['username'] ?></option>
                <?php 
                    }
                }
                ?>
                </select>
                <?php echo $user_err; ?>
            </div>
            <p>hold Ctrl to select more than one user</p>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name = "send">send</button>
            </div>
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
        $sql1 = "delete from users_tasks where task_id = '$id'";
        $sql = "delete from tasks  where id = '$id'";
        if($conn->query($sql1)&&$conn->query($sql)){
            echo "the data was updated successfuly.<br>";
        }else{echo "error:<br>";}
        $conn->close();
        header("REFRESH:0 , url = index.php");
        }
    }
?>