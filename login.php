<?php 

	session_start(); 
	
	//logout
	if ($_GET["logout"]==1 AND $_SESSION['id']) { session_destroy();
		
		$message="You have successfully been logged out!";
	
	}
	
	session_start(); //needed to login again from the successful logout page.
	
	include("connection.php");

	if ($_POST['submit']=="Sign Up") {
		
		if (!$_POST['email']) //check whether email is entered
		{
			$error.="<br />Please enter your email";
		}
		
		else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) //check if email is in correct format
		{
			$error.="<br />Please enter a valid email address";
		}
			
		if (!$_POST['password']) //check if password has been entered
		{	
			$error.="<br />Please enter your password";
		}
		
		else {
				
			if (strlen($_POST['password'])<8) //if password is less than 8 charaters
			{
				$error.="<br />Your password must have at least 8 characters";
			}
					
			if (!preg_match('`[A-Z]`', $_POST['password']))  //if password does not have a capital letter
			{	
				$error.="<br />Your password must contain at least one capital letter";
			}
				
			}
		
		if ($error) $error = "There were error(s) in your signup details:".$error;
		else { // if no errors at all, sign up the user
			
			
			
			$query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'"; //mysqli_real_escape_string is used to prevent sqlinjection by hackers
		
			$result = mysqli_query($link, $query); //saves the result of the query in a variable called result
		
			echo $results = mysqli_num_rows($result); //echoes the number of rows for which the entered email address matches
		
			if ($results)  $error = "Email already registered. Try again?";
			else {
				
				//$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."')";
				
				$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."')";   
				
				mysqli_query($link, $query); //runs the insert query
				
				echo "You've been signed up";
				
				$_SESSION['id']=mysqli_insert_id($link); //assigns session variable with the id value of the record in the last query
				
				//Redirect to logged in page
				
				header("Location:mainpage.php"); //header must be used before any output(like html) is created
				
			}
		
		
		}
	}

	
	if ($_POST['submit']=="Log In") {
		
		$query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['loginemail'])."' AND password='".md5(md5($_POST['loginemail']).$_POST['loginpassword'])."' LIMIT 1";
		
		$result = mysqli_query($link, $query);
		
		$row = mysqli_fetch_array($result);
		
		if ($row) { //if a value is returned
			
			$_SESSION['id'] = $row['id'];   //create a session
			
			//Redirect to logged in page.
			
			header("Location:mainpage.php"); //header must be used before any output(like html) is created
			
			
		} else {
			
			$error =  "We could not find a user with that email and password. Please try again.";
			
		}
		
	}
	
	//comments to html: function addslashes adds backslashes to all characters  that might cause problems with the script. E.g double quotes.
	
?>