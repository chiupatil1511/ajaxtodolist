<?php

// connection of database with php myadmin
$con=mysqli_connect('localhost:3307','root','','ajaxtodolist');
$error='';
if(isset($_POST['submit'])){
    
	$textbox=$_POST['textbox'];
	if($textbox==''){
		$error='Please enter value';
	}else{

        // inserting data into the database
		$sql="insert into todo_list(title) values('$textbox')";
		mysqli_query($con,$sql);
	}
}

// deleting data from database
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$sql="delete from todo_list where id=$id";
	mysqli_query($con,$sql);
	header('location:index.php');
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Todo List</title>    
    <style>
        body{
            width:80%;
            margin:auto;
            font-family:arial;
        }
        #container{
            margin-top: 100px;
        }
        #title{
            text-align:center;
        }
        #con #textbox{
            width:82%;
            float:left;
        }
        #con #button{
            width:16%;
            float:right;
        }
        #row{
            width:91%;
        }
        #row td{
                border:1px solid #ddd;
                padding:8px;
        }
        #row tr:nth-child(even){
            background-color:#f2f2f2;
        }
        .clear{
            clear:both;}

    </style>

</head>

<body>
<div id="container">
    <h1 id="title">Todo List</h1>

    <div id="con">
        <form method="post">
            <div id="textbox">
                <input type="textbox" id="textbox" name="textbox"  placeholder="Things to do" style="width:100%;padding:15px;color:'grey'"/>
            </div>
            <div id="button">
                <input type="submit" id="submit" name="submit" style="padding:15px;"/>
            </div>
        </form>
    </div>
    <div class="clear">&nbsp;</div>
                <div >
                    <?php
                    $sql="select * from todo_list order by id desc";
                    $res=mysqli_query($con,$sql);
                    $count=mysqli_num_rows($res);
                    if($count>0){
                    ?>
                        <table id="row">
                        <?php
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                                    <tr>
                                        <td width="92%"><?php echo $row['title']?></td>
                                        <td><a href="index.php?delete=<?php echo $row['id']?>">Delete</a></td>
                                    </tr>
                            <?php
                            }
                            ?>        
                        </table>	
                        <?php 
                            }
                            else { 
                                echo "No data found";
                            } 
                        ?>
                </div>
	</div>
</div>
</body>
</html>