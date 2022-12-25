<?PHP 
session_start();
$pagetitle='Profil';
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
<?PHP
if(isset($_SESSION['user'])){
   echo '<div class="text-center" style="font-size:50px; font-weight:bold;">Welcom'.' '.$_SESSION['user'].'</div>';
         $stmt=$con->prepare("SELECT * FROM items ");
     $stmt->execute();
     $rows=$stmt->fetchAll();
     foreach ($rows as $row) {}
        
  $getuser=$con->prepare("SELECT * FROM items WHERE username=?");
  $getuser->execute(array($sessionUser));
  $info=$getuser->fetch();
   echo '<img class="im  circle" src="admin\uplods/avatars/' .$info['avatar'] .'"/>';
?>
<h1 class="text-center" style="font-weight: bold;">My Profile</h1>
<div class="information">
  <div class="container">
    <div class="panel panel-default">
  <div class="panel-heading">My Information</div>
  <div class="panel-body">
    <ul>
      <li>
        <i class="fa fa-unlock-alt fa-fw"></i>
        <span>Name</span>           : <?PHP echo $info['username']; ?>
      </li>
      <li>
        <i class="fa fa-envelope-o fa-fw"></i>
        <span>Email</span>          : <?PHP echo $info['email']; ?>
      </li>
      <li>
        <i class="fa fa-user fa-fw"></i>
        <span>Full Name</span>      : <?PHP echo $info['fullname']; ?>
      </li>
      <li>
        <i class="fa fa-calendar fa-fw"></i>
        <span>Rejester Date</span>  : <?PHP echo $info['ddd']; ?>
      </li>
    </ul>
    <a href="#" class="btn btn-secondary">Edit My Information</a>
  </div>
</div>
  </div>
</div>
<div class="ads">
  <div class="container">
    <div class="panel panel-default">
  <div class="panel-heading">My ADS</div>
  <div class="panel-body">
   <div class="row">
    <?PHP
     $stmt=$con->prepare("SELECT * FROM item WHERE member_id=? ORDER BY item_id  DESC ");
     $stmt->execute(array($info['userId']));
     $rows=$stmt->fetchAll();
     foreach ($rows as $row) {
       echo '<div class="col-sm-6 col-md-4">';
            echo '<div class="thumbnail item-box mange-pro">';
            if($row['approve']==0){
              echo '<div class="apr">Waiting To Approved</div>';
            };
               echo '<a href="items.php?itemid='.$row['item_id'].'"><img src="admin\uplods/avatars/' .$row['image_item'] .'"/></a>';
               echo '<div class="caption">';
                   echo '<a href="items.php?itemid='.$row['item_id'].'"><h3>'.$row['name'].'</h3></a>';
                   echo '<p>'.$row['description'].'</p>';
                   echo '<span class="price">'.$row['price'].'$'.'</span>';
                   echo '<div class="date">'.$row['add_date'].'</div>';

               echo '</div>';
            echo '</div>';
       echo '</div>';
     }
    ?>
    </div>
  </div>
</div>
  </div>
</div>
<div class="container bt">
 <a href="newad.php" class=" btn btn-primary">Creat New Ads</a>
</div>
<?PHP }
else{
  header('Location:login.php');
  exite();
}
?>

<?PHP include $tpl."footer.php";?>