<?PHP 
session_start();
$pagetitle='Show Items';
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
             </li>';
         }
     ?>
          </ul>
        </li>
      </ul>
  </div>
</nav>
<?PHP
        $itemid = isset($_GET['itemid'])&&is_numeric($_GET['itemid'])? intval($_GET['itemid']):0;
        $stmt=$con->prepare("
          SELECT item.*,
            items.username AS Name ,categoris.name AS Category_name
          FROM 
              item
          INNER JOIN 
              categoris
          ON 
            categoris.id=item.cat_id
          INNER JOIN 
              items
          ON 
            items.userId=item.member_id
            WHERE
            item_id=?
            ");
        $stmt->execute(array($itemid));
        $count=$stmt->rowCount();
        if($count>0){
        $row=$stmt->fetch();
?>
      <h1 class="text-center" style="font-weight: bold;"><?PHP echo $row['name']?></h1>
      <div class="container">
        <div class="row">
          <div class="col-md-3 showitem">
            <?PHP
             echo '<img src="admin\uplods/avatars/' .$row['image_item'] .'"/>';
            ?>
           
          </div>
          <div class="col-md-9 item-info">
            <h2><?PHP echo $row['name']?></h2>
            <ul class="list">

            <p><?PHP echo $row['description']?></p>
            <li><span>Adedd Date : </span><?PHP echo $row['add_date']?></li>
            <li><span>Price : </span><?PHP echo $row['price']?></li>
            <li><span>Made In : </span><?PHP echo $row['country']?></li>
            <li><span>Status : </span>
            <?PHP
            if($row['status']==1){
              echo 'New';
            }
            if($row['status']==2){
              echo 'Like New';
            }
            if($row['status']==3){
              echo 'Used';
            }
            if($row['status']==4){
              echo 'Very Old';
            }
            ?>
           </li>
            <li><span>Member Adedd : </span><?PHP echo $row['Name']?></li>
          </ul>
          <h4 >To order the product, please click </h4>
          <?PHP
          if(isset($_SESSION['user'])){
          echo" <a href='buy.php?userid=".$row['item_id']."' class=' btn btn-success'><i class='fa fa-shopping-cart'></i> Buy Now</a>";

          }else{
            echo '<div class="alert alert-danger">Sorry <a href="login.php">Login</a> To Buy This Product</div>';
          }
          ?>
          </div>
        </div>
      <hr>

      <?PHP
             if(isset($_SESSION['user'])){?>
      <div class="row">
        <div class="col-md-offset-3">
          <div class="comment">
         <form method="POST">
          <input type="text" name="comment" class="form-control">
          <input type="number" value="<?=$row['item_id']?>" name="item_id" hidden>
          <button type="submit" class="form-control btn btn-primary">Add Comment</button>
          </form>
          <?PHP
           if ($_SERVER['REQUEST_METHOD']=='POST'){
            $comment=filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
            $userid =$_SESSION['uid'];
            $itemid =$_POST['item_id'];
            if(!empty($comment)){
              $comment=$_POST['comment'];
            $stmt=$con->prepare('INSERT INTO 
                                    comments 
                                    (comment,status,comment_date,itemid,user_id) 
                                    VALUES 
                                    (:zcoment,0,now(),:zitem,:zuser)');
                $stmt->execute(array(
                    'zcoment'    =>$comment,
                    'zitem'=>$itemid,
                    'zuser'=>$userid
                               ));
            }
             if($stmt){
                  echo '<div class="alert alert-success">Comment Adedd</div>';
                }

           }
            
          ?>
        </div>
      </div>
      </div>
      <?PHP
          }
          
          else{
            echo '<div class="alert alert-danger">Sorry <a href="login.php">Login</a> To Make A Comment On This Product</div>';
          }

      ?>
    
      <hr>
      <div class="row">
        <div class="col-md-9">
          <?PHP
            $stmt=$con->prepare("SELECT 
                                comments.*,items.username AS User_Name
                             FROM 
                                comments
                             INNER JOIN 
                                items
                             ON
                                items.userId = comments.user_id 
                             WHERE itemid =? AND status=1
                            ");
      $stmt->execute(array($itemid));
      $rows=$stmt->fetchAll();
      foreach ($rows as $row) {
        echo $row['comment']."<br>";
        echo $row['comment_date']."<br>";
        echo "<hr>";
      }

          ?>
        </div>
      </div>
        
      </div>
<?PHP 
   }else{
    echo '<div class="backiii container alert alert-danger">There Is No Id</div>';
   }
include $tpl."footer.php";
?>