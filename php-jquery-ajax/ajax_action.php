<?php
      $conn=mysqli_connect("localhost","root","","test");
      $action=$_POST["action"];
      if($action=="Insert"){
        $id=mysqli_real_escape_string($conn,$_POST["id"]);
        $name=mysqli_real_escape_string($conn,$_POST["name"]);
        $email=mysqli_real_escape_string($conn,$_POST["email"]);
        $password=mysqli_real_escape_string($conn,$_POST["password"]);
        $user_type=mysqli_real_escape_string($conn,$_POST["user_type"]);
        $sql="insert into user_table(name,email,password,user_type) values('{$name}','{$email}','{$password}','{$user_type}')";
        if($conn->query($sql)){
            echo "<tr uid={$id}>
            <td>{$name}</td>
            <td>{$email}</td>
            <td>{$password}</td>
            <td>{$user_type}</td>
            <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
            <td><a href='#' class='btn btn-primary delete'>Delete</a></td>
            </tr>";
        }else{
            echo false;
        }
      }else if($action=="Update"){
        $id=mysqli_real_escape_string($conn,$_POST["id"]);
        $name=mysqli_real_escape_string($conn,$_POST["name"]);
        $email=mysqli_real_escape_string($conn,$_POST["email"]);
        $password=mysqli_real_escape_string($conn,$_POST["password"]);
        $user_type=mysqli_real_escape_string($conn,$_POST["user_type"]);
        $sql="update user_table set name='{$name}',email='{$email}',password='{$password}',user_type='{$user_type}' where id='{$id}'";
        if($conn->query($sql)){
            echo "
            <td>{$name}</td>
            <td>{$email}</td>
            <td>{$password}</td>
            <td>{$user_type}</td>
            <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
            <td><a href='#' class='btn btn-primary delete'>Delete</a></td>";
        }else{
            echo false;
        }
      }else if($action=='Delete'){      
        $id=$_POST["uid"];
        $sql="delete from user_table where id='{$id}'";
        if($conn->query($sql)){
          echo true;
        }else{
          echo false;
        }
      }
?>