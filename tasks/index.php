<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <a href="./create.php" class="btn btn-secondary">add new task</a>
        <a href="../users/index.php" class="btn btn-secondary">users</a>
        <a href="../index.php" class="btn btn-danger">logout</a>
        <?php
                require '../connect.php';
                $sql = "select * from tasks";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                ?>
        <div class="card mt-4">
            <div class="card-header">
            <?php echo $row['task']; ?>  
            </div>
            <div class="card-body">
                <h5 class="card-title mb-4"><?php echo $row['description'] ?></h5>
                <?php
                $idt = intval($row['id']);
                $sql1 = "SELECT users_tasks.*, users.username, tasks.id
                FROM users_tasks
                    LEFT JOIN users ON users_tasks.user_id = users.id 
                    LEFT JOIN tasks ON users_tasks.task_id = tasks.id where tasks.id = '$idt'";
                if($result1 = $conn->query($sql1)){
                    while($row1 = $result1->fetch_assoc()){
                ?>
                <p class="card-text mb-1"><?php echo $row1['username']; }}?></p>
                
                <div class="mt-3">
                <a href="./ud.php?box=delete&id=<?php echo $row['id']?>" class="btn btn-danger">delete</a>
                <a href="./ud.php?box=update&id=<?php echo $row['id']?>" class="btn btn-primary">update</a>
          
                </div>
            </div>
        </div>
        <?php
                }
            }          
               
                ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>