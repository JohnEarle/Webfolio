<?php 
	$connection = mysqli_connect('localhost','root','','test') or die("Error " . mysqli_error($link));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contacts</title>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

</head>

<body>
<?php 

	if(isset($_POST['submit'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$statement = 'select * from admin where username = "'.$username.'" and password = "'.$password.'" limit 1';
		echo $statement;
		$row = mysqli_fetch_array(mysqli_query($connection,$statement),MYSQLI_ASSOC);
		if($row['password'] == $password and $row['username'] = $username){
			setcookie("currentUser","good", time()+1350);
			$username = "";
			$password = "";
			}
		else{
			echo "<script type='text/javascript'>ACCESS DENIED</script>";
		}
	}
		if(!isset($_COOKIE['currentUser'])){
		echo '<form action="" method="post">
			<label for="username">Username</label>
			<input type="text" name="username" id="formUsernameField" />
    		<label for="password">Password</label>
    		<input type="password" name="password" id="formPasswordField" />
    		<input type="submit" name="submit" />
		</form>';
		}
		else{
			echo '<a href="logout.php">Logout</a>';
			$statement2 = "select * from buisnesscontacts";
			$contacts = array();
			$index = 0;
			$r2 = mysqli_query($connection,$statement2);
			while($row = mysqli_fetch_assoc($r2)){
               $contacts[$index] = $row;
			   $index++;
			}
			for($x = 0; $x < count($contacts); $x++)
			{
				echo "<h1 class='contact' phone='".$contacts[$x]['Phone']."' email='".$contacts[$x]['Email']."'>".$contacts[$x]['name']."</h1>";
			}
		}
?>
</div>
</body>
<script type="text/javascript">
	$('.contact').click(function(event){
		
		alert("Phone Number: "+event.target.getAttribute('phone')+" Email: "+event.target.getAttribute('email'));
		});
</script>
<style>
	body{
		text-align: center;
	}
</style>
</html>