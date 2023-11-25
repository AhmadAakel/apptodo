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
        <a href="./create.php" class="btn btn-secondary">add</a>
        <?php
                    require '../connect.php';
                    $sql = "select * from users";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                ?>
        <a href="../tasks/index.php" class="btn btn-secondary">task</a>
        <a href="../index.php" class="btn btn-danger">logout</a>

        <?php
        }else{
        ?>
        <a href="" class="btn btn-secondary">task</a>
        <?php
                    }
        ?>
        <?php
        require '../connect.php';
        $sql = "select * from users";
        $result = $conn->query($sql);
        if($result->num_rows > 0){?>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">name</th>
                <th scope="col">role</th>
                <th scope="col">update</th>
                <th scope="col">delete</th>
                </tr>
            </thead>
            <?php
            while($row = $result->fetch_assoc()){?>
            <tbody>
                <tr>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['role']?></td>
                <td><a href="./ud.php?box=update&id=<?php echo $row['id']?>" class="btn btn-primary">update</a></td>
                <td><a href="./ud.php?box=delete&id=<?php echo $row['id']?>" class="btn btn-danger">delete</a></td>
                </tr>
            </tbody>
            <?php
            } ?>
        </table>
        <?php
        }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>