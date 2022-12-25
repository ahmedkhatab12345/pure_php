<?PHP
session_start();
$pagetitle='SignUp';
if(isset($_SESSION['user'])){
	header('Location:index.php');
	exit();}
?>
<?PHP include "int.php";?>
<!DOCTYPE html>
<html>
    <head>
        <title> <?php

        if (isset($pagetitle)) {
            echo $pagetitle;
        }else{
            echo "Defult";}
        ?> </title>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="layout/css/frontend.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="body">
<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
  <a id="home" class="navbar-brand" href="index.php">Home Page</a>
  <div  class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div  class="navbar-nav">
    </div>
  </div>
  <div>
<ul id="list" class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?PHP
       $stmt=$con->prepare('SELECT * FROM categoris ORDER BY id ASC');
       $stmt->execute();
     $rows=$stmt->fetchAll();
     foreach ($rows as $row) {
             echo '<li>
             <a href="categoris.php?pageid='.$row['id'].'&pagename='.str_replace(' ', '-', $row["name"]).'">
             '.$row["name"].'
             </a>
             </li>';}?>   
          </ul>
        </li>
      </ul>
  </div>
</nav>
 <div >
  <form class="signup"  action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="POST">
  	<h2 style="color: #218838;" class="text-center">signup</h2>
    <input class="form-control" type="text" name="username" autocomplete="off" placeholder="Enter Your Name"  required="true">
    <input class="form-control" type="password" name="pass" autocomplete="new-password" placeholder="Enter Your Password"  >
    <input class="form-control" type="password" name="pass2" autocomplete="new-password" placeholder="Type Password Again"  >
    <input class="form-control" type="email" name="email"  placeholder="Enter a Valid Email"  >
    <input class="btn btn-success btn-block" type="submit" value="Login">
  </form>
        </div>
        <div class="the-error">
    	<?PHP
    	if($_SERVER['REQUEST_METHOD']=='POST'){

    	$formerror=array();
    	if(isset($_POST['username'])){
        $userr=$_POST['username'];
      $passwoord=$_POST['pass'];
      $emaill=$_POST['email'];
    		$filterduser=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    		if(strlen($filterduser)<4){
    			$formerror[]='user name must be mor than four characters';
    		} 
    	}
    	if(!empty($_POST['pass'])){
    	if(isset($_POST['pass'])&&isset($_POST['pass2'])){
    		$password1=$_POST['pass'];
    		$password2=$_POST['pass2'];
    		if ($password1 !==$password2) {
    			$formerror[]='Sorry Password Not Match';
    		}
    	}
    }else{
    	$formerror[]='Password Must Be Not Empty ';
    }
    	if(isset($_POST['email'])){
    		$filterdemail=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    		if(filter_var($filterdemail,FILTER_VALIDATE_EMAIL)!= true){
    			$formerror[]='This Email Is Not Valid';
    		}
    	}
          if(!empty($formerror)){
          	foreach ($formerror as $error) {
          		echo'<div class="alert alert-danger" role="alert">';
                 echo $error .'</br>';
                 echo'</div>';
          		
          	}
          }
          if(empty($formerror)){
          	$stmt2=$con->prepare('SELECT username From items WHERE username = ?');
	        $stmt2->execute(array($_POST['username']));
	        $check=$stmt2->rowCount();
          	if($check>0){
              echo'<div  class="alert alert-danger" role="alert">Sorry This user is exist</div>'; }
          else{
          	 $stmt=$con->prepare('INSERT INTO items (username,password,email,regstatus,ddd) VALUES (:zuser,:zpass,:zmail,1,now())');
          $stmt->execute(array('zuser' =>$userr, 'zpass' =>$passwoord, 'zmail' =>$emaill));
        echo "<div class='contaiiner  alert alert-success'>".'congratulations you have successfully registered'."</div>";
        header('REFRESH:10;URL=login.php');
          }}
        }
    	?>
    </div>
<?PHP include $tpl."footer.php";?>