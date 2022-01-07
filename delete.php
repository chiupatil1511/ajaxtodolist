<?php
$con=mysqli_connect('localhost:3307','root','','ajaxtodolist');
$id=$_POST['id'];
$sql="delete from todo_list where id=$id";
mysqli_query($con,$sql);
?>