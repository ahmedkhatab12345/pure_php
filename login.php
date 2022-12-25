<?PHP
session_start();
$pagetitle='Login';
if(isset($_SESSION['user'])){
	    	header('Location:index.php');
	    	exit();
}
?>
<?PHP include "int.php";?>
<!DOCTYPE html>
<html>
    <head>
        <title> <?php 
        if (isset($pagetitle)) {
            echo $pagetitle;
        }else{
            echo "Defult";
        }

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
<div class="ksr">
<ul id="list" class="nav navbar-nav navbar-right">
  <ul class="nav justify-content-end">
      <?PHP
       $stmt=$con->prepare('SELECT * FROM categoris ORDER BY id ASC');
       $stmt->execute();
     $rows=$stmt->fetchAll();
     foreach ($rows as $row) {
             echo '<li>
             <a href="categoris.php?pageid='.$row['id'].'&pagename='.str_replace(' ', '-', $row["name"]).'">
             '.$row["name"].'
             </a>
             </li>';
         }
     ?>
</ul>
</div>
</nav>

<?PHP
if($_SERVER['REQUEST_METHOD']=='POST'){
    $user=$_POST['username'];
    $pass=$_POST['password'];

   $stmt=$con->prepare("SELECT
                                userId,username,password 
                         FROM
                                items
                         WHERE
                                username=?
                         AND 
                                password=?
                        
                        ");
    $stmt->execute(array($user,$pass));
    $get=$stmt->fetch();
    $count=$stmt->rowCount();
    if($count>0){
    	$_SESSION['user']=$user;
      $_SESSION['uid']=$get['userId'];
    	
    	header('Location:index.php');
    	exit();
    }
    
}
 ?> 
 <img src="2593065.JPG" class="imim">
<div class=" login-page" style="position: relative;
    top: -1087px;
    float: right;
    right: 48px;
}">
        <div >
	<form class="login" action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h2 style="color: #007BFF;" class="text-center">Login</h2>
    <input class="form-control" type="text" name="username" autocomplete="off" placeholder="Enter Your Name" required="true">
    <input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="Enter Your Password"  required="true">
    <input class="btn btn-primary btn-block" type="submit" value="Login">
    <a href="admin\index.php" class="newacount btn btn-primary" style=" width: 301px;"><h3>Login As Admin</h3></a>
    <a href="signup.php" class="newacount" style="margin-top: 18px;"><h3>Create a new acount ?</h3></a>

  </form>
        </div>
      </div>
<?PHP include $tpl."footer.php";?>