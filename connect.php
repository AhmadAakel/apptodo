<?php
$servername = "localhost";
$userName = "root";
$password = "";

$conn = new mysqli($servername,$userName,$password);
if($conn->connect_error){
    die("connection faild" . $conn->connect_error);
}

/* $sql = "create database crud";
if($conn->query($sql)===true){
    echo "database created successfuly.<br>";
}
else {echo "error creating database: <br>" . $conn->error;} */
$conn = new mysqli($servername,$userName,$password , "crud");

/* $sql = "create table users(
    id int auto_increment primary key ,
    username varchar(50) not null,
    role varchar(50) not null,
    pass varchar(50) not null);";
    if($conn->query($sql)===true){
        echo "users creating successfuly. <br>";
    }else{
        echo "error creating users table:<br>". $conn->error;
    }
 
$sql = "create table tasks(
    id int auto_increment primary key,
    task varchar(50) not null,
    description text );";
    if($conn->query($sql)===true){
        echo "tasks creating successfuly. <br>";
    }else{
        echo "error creating tasks table:<br>". $conn->error;
    }
     $sql = "create table users_tasks(
        id int auto_increment primary key,
        user_id int not null,
        task_id int not null,
        foreign key (user_id) references users(id),
        foreign key (task_id) references tasks(id));";
        if($conn->query($sql)===true){
            echo "users_tasks creating successfuly. <br>";
        }else{
            echo "error creating users_tasks table:<br>". $conn->error;
        } */