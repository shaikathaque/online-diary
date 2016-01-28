<? 

	session_start();
	
	include("connection.php");
	
	$query="SELECT diary FROM users WHERE id='".$_SESSION['id']."' LIMIT 1";

	$result = mysqli_query($link, $query);
	
	$row = mysqli_fetch_array($result);
	
	$diary = $row['diary'];
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Online Diary</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
	
	.navbar-brand {
		font-size:1.8em;
	}
	
	#topContainer {
		background-image: url("background.jpg");
		height: 400px;
		width:100%;
		background-size: cover;
	}
	
	#topRow {
		margin-top:80px;
		text-align: center;
		color: #EEEEEE;
	}
	
	#topRow h1 {
		font-size: 300%
	}
	
	.bold {
		font-weight: bold;
	}
	
	.marginTop {
		margin-top:30px;
	}
	
	.center {
		text-align:center;
	}
	
	.title {
		margin-top: 100px;
		font-size: 300%;
	}
	
	#footer {
		background-color: #B0D1FB;
		padding-top: 70px;
		width: 100%;
	}
	
	.marginBottom {
		margin-bottom: 30px;
	}
	
	.appstoreImage {
		width:250px;
		height:100px;
	}
	
	body p {
		font-size:1.2em;
	}
	
	
	</style>
	
  </head>
  <body data-spy="scroll" data-target=".navbar-collapse">
  
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
			
				<div class="navbar-header pull-left">
				
				<a class="navbar-brand">Online Diary</a>
				
			
				</div>
				
				<div class="pull-right">
				
					<ul class="navbar-nav nav">
					
					<li><a href="index.php?logout=1">Log Out</a> </li>
					
					</ul>
				
				</div>
				
				
			</div>
		</div>
		
		<div class="container contentContainer" id="topContainer">
		
			<div class="row">
		
				<div class="col-md-10 col-md-offset-1" id="topRow">
				
					<textarea class="form-control"><?php echo $diary; ?></textarea>
		
				</div>
		
			</div>
			
		</div>
		
		
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	<script>
	
		$(".contentContainer").css("min-height",$(window).height());
		
		$("textarea").css("height",$(window).height()-110);
		
		//update the database entry every time a change is made.
		$("textarea").keyup(function() { 
			
			$.post("updatediary.php", {diary: $("textarea").val()} );
			
		});
	
	</script>
	
  </body>
</html>

<form method="post">

	<input type="email" name="email" id="email" value="<?php echo addslashes($_POST['email']); ?>"/> 

	<input type="password" name="password" value="<?php echo addslashes($_POST['password']); ?>"/>
	
	<input type="submit" name="submit" value="Sign Up" />

</form>

<form method="post">

	<input type="email" name="loginemail" id="loginemail" value="<?php echo addslashes($_POST['email']); ?>"/>

	<input type="password" name="loginpassword" value="<?php echo addslashes($_POST['password']); ?>"/>
	
	<input type="submit" name="submit" value="Log In" />

</form>

