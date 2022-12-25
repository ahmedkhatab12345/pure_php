<?PHP 
session_start();
$pagetitle='Buy Product';
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
$userid = isset($_GET['userid'])&&is_numeric($_GET['userid'])? intval($_GET['userid']):0;
        $stmt=$con->prepare("SELECT * FROM item WHERE item_id=? LIMIT 1 ");
        $stmt->execute(array($userid));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();
        ?>
<h1 id="h11" class="text-center">product order form</h1>
        <div class="container">
            <div class="dii">
            <form class="form-horizontal" action='insert.php?userid=<?PHP echo $row["item_id"]?>' method="POST">
                <div class="form-group form-group-lg">
                    <label class="col-sm-5 control-label" style="font-weight: bold;font-size:25px"></label>
                    <div class="col-sm-10 col-md-5">
                        <input  name="name" type="hidden" class="form-control" value="<?PHP echo $row['name']?>">
                    </div>
                </div>
                <div class="form-group form-group-lg">
                    <label class="col-sm-5 control-label" style="font-weight: bold;font-size:25px">Name in detail</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="username" class="form-control"  autocomplete="off" required="required" placeholder=" Enter Your Name">
                    </div>
                </div>
                        <div class="form-group">
                    <label class="col-sm-5 control-label" style="font-weight: bold;font-size:25px">Detailed address</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="address" class="form-control" autocomplete="new-password" required="required" placeholder="Enter Your Detailed Adderss">
                    </div>
                </div>
                        <div class="form-group">
                    <label class="col-sm-5 control-label" style="font-weight: bold;font-size:25px">Email</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="email" name="email" class="form-control"  required="required" placeholder="Enter Your Email & Must Be Valied">
                    </div>
                </div>
                        <div class="form-group">
                    <label class="col-sm-5 control-label" style="font-weight: bold;font-size:25px">Mobile number (WhatsApp)</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="number" name="mobil" class="form-control" required="required" placeholder="Enter Your Mobile Number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" style="font-weight: bold;font-size:25px">another number</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="number" name="mobil2" class="form-control" required="required" placeholder="Enter Your Another Number">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-5 control-label" style="font-weight: bold;font-size:25px">the number of pieces</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="number" name="pieces" class="form-control" required="required" placeholder="Enter Nomer Of Pieces">
                    </div>
                </div>
                        <div class="form-group ">
                    <div class="col-sm-offset-2 col-sm-10 ">
                        <input type="submit" value="Send"class="btn btn-primary">
                    </div>
                </div>  
            </form>
        </div>
<?PHP include $tpl."footer.php";?>