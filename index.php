<?php
$con=mysqli_connect('localhost:3307','root','','ajaxtodolist');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Digi Maze Todo List</title>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<style>
		body{
            width:80%;
            margin:auto;
            font-family:arial;
        }
		#container{
            margin-top:100px;
        }
		#container h1{
            text-align:center;
        }
        #container img{
            width: 92%;
            height: 400px;
        }
		#bcontain #textbox{
            width:82%;
            float:left;
            
        }
		#bcontain #button{
            width:16%;
            float:right;
            
        }
		#row{
            width:91%;
        }
		#row td{
            border:1px solid #ffb6c1;
            padding:8px;
        }
		#row tr:nth-child(even){
            background-color:#FFE6EE;
        }
		.clear{
            clear:both;
        }
		.error{
            color: red;
            font-size: 14px
        }
		</style>
		<script>
		function insert_data(){
			var textbox=jQuery('#title').val();
			if(textbox==''){
				jQuery('.error').html('Please enter value');
			}else{
				jQuery.ajax({
					url:'insert.php',
					method:'post',
					data:'textbox='+textbox,
					success:function(result){
						jQuery('#row').prepend('<tr id="row'+result+'"><td width="92%">'+textbox+'</td><td><a href="javascript:void(0)" onclick=delete_data("'+result+'")>Delete</a></td></tr>');
					}
				})
			}
		}	
		
		function delete_data(id){
			jQuery.ajax({
				url:'delete.php',
				method:'post',
				data:'id='+id,
				success:function(result){
					jQuery('#row'+id).slideUp();
				}
			})
		}	
		</script>
	</head>
	<body>
		<div id="container">
        
        <img src="image.jpg_fit=scale" id="img">
        <marquee  direction="right">
            <h1>Digi Maze Todo List</h1>
        </marquee>
            
			<div id="bcontain">
				<form method="post">
					<div id="textbox"><input type="textbox" id="title" name="title" style="width:100%;padding:15px;"/></div>
					<div id="button"><input type="button" onclick="insert_data()" value="Submit" id="submit" name="submit" style="padding:15px;backgroundcolor:#ffb6c1;"/></div>
				</form>
				<div class="error"></div>
			</div>
			<div class="clear">&nbsp;</div>
			<div id="wal">
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
						<tr id="row<?php echo $row['id']?>">
							<td width="92%"><?php echo $row['title']?></td>
							<td><a href="javascript:void(0)" onclick="delete_data('<?php echo $row['id']?>')">Delete</a></td>
						</tr>
						<?php
					}
					?>
				</table>
				<?php }else { 
					echo "No data found";
				} ?>				
			</div>
		</div>
	</body>
</html>