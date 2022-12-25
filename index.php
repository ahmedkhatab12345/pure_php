<?PHP 
session_start();
$pagetitle='Home Page';
include "int.php";?>
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
<div class="upper-par">
   <?PHP
    if(isset($_SESSION['user'])){
        echo '<div class="text-center" style="font-size:50px; font-weight:bold;">Welcom'.' '.$_SESSION['user'].'</div>';
        /////////////
      $stmt=$con->prepare("SELECT * FROM items ");
     $stmt->execute();
     $rows=$stmt->fetchAll();
     foreach ($rows as $row) {}
        ?>
     
<div class="dropdown show" style="    float: right;
    margin-bottom: 12px;
    /* margin: 12px; */
    margin-top: -74px;
    margin-right: 73px;
    padding-right: -24px;
    /* padding-left: 16px; */
    padding: 7px">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?PHP echo $_SESSION['user'];?>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="profile.php">My Profile</a>
    <a class="dropdown-item" href="newad.php">Creat New Item</a>
    <a class="dropdown-item" href="logout.php">Log Out</a>
  </div>
</div>
</form>
        <?PHP 
        if(isset($_SESSION['user'])){
          /*
        echo '<a href="#" style=" float: right;
              margin-bottom: 20px;
              margin-top: 11px;
              margin-right: 1103px;
              font-weight: lighter;
              font-size: 21px;" 
              class="btn btn-info"> Chat With Admin</a>';*/
            }
        echo '<div class="lo">';
        echo '<div class="homeprofil">';
       
        echo '</div>';
        echo '</div>';
    }else{
   ?>
   <div class="inedxlogin">
    <a  href="login.php">
        <span class="login float-right btn btn-info">Login/Signup</span>
    </a>
    </div>
    <?PHP }?>
</div>
<div class="container">
<form method="GET" style="width: 258px;">
  <input class="form-control" type="text" name="ser" placeholder="Serch ....">
  <button class="btn btn-info btn-block" type="submit"  name="btn-serch">Serch</button>
</form>
</div>
<div class="container">
  <h1 style="position: relative;
    left: 473px;
        top: -28px;">All Items</h1>
  <?PHP
if (isset($_GET['btn-serch'])) {
       $stmt=$con->prepare("SELECT * FROM item WHERE name LIKE :value ");
       $serch_value="%".$_GET['ser']."%";
       $stmt->bindparam("value",$serch_value);
       $stmt->execute();
       foreach ($stmt as $data) {
         echo "<ul>";
         echo '<li><a href="items.php?itemid='.$data['item_id'].'">'.$data["name"].'</a></li>';
         echo "</ul>";
       }
     }
  ?>
  <div class="tas">
  <div class="row" style="position: relative;
    top: 70px;">
    <?PHP
     $stmt=$con->prepare("SELECT * FROM item WHERE approve=1 ORDER BY item_id  DESC ");
     $stmt->execute();
     $rows=$stmt->fetchAll();
     foreach ($rows as $row) {
       echo '<div class="col-md-4 iteem">';
            echo '<div class="thumbnail item-box">';
               echo '<a href="items.php?itemid='.$row['item_id'].'"><img src="admin\uplods/avatars/' .$row['image_item'] .'"/></a>';
               echo '<div class="caption">';
                   echo '<h3 class="namee"><a href="items.php?itemid='.$row['item_id'].'">'.$row['name'].'</a></h3>';
                   echo '<p>'.$row['description'].'</p>';
                   echo '<span class="price">'.$row['price'].'</span>';
                    echo '<p>'.$row['add_date'].'</p>';

               echo '</div>';
            echo '</div>';
       echo '</div>';
     }
    ?>
    </div>
    </div>
    </div>
</div>
<?PHP include $tpl."footer.php";?>

