
<?PHP include "int.php";
$pagetitle='Category';
?>
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
<div >
  <h1 class="text-center"></h1>
  <div class="row">

    <?PHP
     $stmt=$con->prepare("SELECT * FROM item WHERE cat_id=? AND approve=1 ORDER BY item_id  DESC ");
     $stmt->execute(array($_GET['pageid']));
     $rows=$stmt->fetchAll();
     foreach ($rows as $row) {
      echo '<div class="">';
       echo '<div class="container col-sm-3 col-md-3">';
            echo '<div class="thumbnail category-box">';
                echo '<img style="width: 331px;" src="admin\uplods/avatars/' .$row['image_item'] .'"/>';
               echo '<div class="caption">';
                   echo '<h3><a href="items.php?itemid='.$row['item_id'].'">'.$row['name'].'</a></h3>';
                   echo '<p>'.$row['description'].'</p>';
                   echo '<span style="background-color: #1abc9c;font-weight: bold;font-size: 18px;">'.$row['price'].'</span>';

               echo '</div>';
            echo '</div>';
       echo '</div>';
        echo '</div>';
     }
    ?>
    </div>
</div>
<?PHP include $tpl."footer.php";?>