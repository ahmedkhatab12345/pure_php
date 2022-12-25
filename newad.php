<?PHP 
session_start();
$pagetitle='new ads';
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
  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?PHP echo $_SESSION['user'];?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="profile.php">My Profile</a>
    <a class="dropdown-item" href="newad.php">Creat Ads</a>
    <a class="dropdown-item" href="logout.php">Log Out</a>
  </div>
</div>
</nav>
<h1 id="h11" class="text-center">Add New Item</h1>
        <div class="container">
            <div class="dii">
            <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" style="font-weight: bold;font-size:25px">Name</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="name" class="form-control"    placeholder=" Name Of Items">
                    </div>
                </div>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" style="font-weight: bold;font-size:25px">Description</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="description" class="form-control"    placeholder=" Description Of Items">
                    </div>
                </div>
                 <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" style="font-weight: bold;font-size:25px">Price</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="price" class="form-control"    placeholder=" Price Of Items">
                    </div>
                </div>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" style="font-weight: bold;font-size:25px">Country</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="country" class="form-control"    placeholder=" Country Of Items">
                    </div>
                </div>
                
                 
                 <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" style="font-weight: bold;font-size:25px">Status</label>
                    <div class="col-sm-10 col-md-5">
                    <select class="form-control "  name="status">
                        <option value="0">...</option>
                        <option value="1">New</option>
                        <option value="2">Like New</option>
                        <option value="3">Uesd</option>
                        <option value="4">Very Old</option>
                    </select>
                    <div class="col-sm-10 col-md-5">
                    </div>
                </div>
                
                 <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" style="font-weight: bold;font-size:25px">Category</label>
                    <div class="col-sm-10 col-md-5">
                    <select class="form-control "  name="category">
                        <option value="0">...</option>
                            <?PHP
                            $stmt=$con->prepare("SELECT * FROM categoris");
                            $stmt->execute();
                            $rows=$stmt->fetchAll();
                            foreach($rows as $row){
                                echo"<option  value='".$row['id']."'>".$row['name']."</option>";
                            }
                            ?>
                    </select>
                    <div class="col-sm-10 col-md-5">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" style="font-weight: bold;font-size:25px">Item Image</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="file" name="image" class="form-control" >
                    </div>
                </div>
                        <div class="form-group ">
                    <div class="col-sm-offset-2 col-sm-10 ">
                        <input type="submit" value="Add Item"class="btn btn-primary">
                    </div>
                </div>  
            </form>
        </div>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
             $Avatar=$_FILES['image'];
            $avatarName=$_FILES['image']['name'];
            $avatarType=$_FILES['image']['type'];
            $avatarTemp=$_FILES['image']['tmp_name'];
            $avatarSize=$_FILES['image']['size'];
            
            $avatarAllowedExcetention=array('jpeg','jpg','png','gif');
            //explode function make divided strig to array explode('mark','String') 
            // end() get last item in array
            $tmp = explode('.', $avatarName);
            $file_extension = end($tmp);
            $avatarExtention=strtolower($file_extension);
            
            ///////////////
            $stmt=$con->prepare('SELECT * FROM items ');
            $stmt->execute();
            $rows=$stmt->fetchAll();
            foreach ($rows as $row) {}
            echo('<div class="container">');
            $name   =$_POST['name'];
            $desc =$_POST['description'];
            $price=$_POST['price'];
            $country =$_POST['country'];
            $status =$_POST['status'];
           // $Member= $_SESSION['user'];
            $Category=$_POST['category'];
            //var_dump($Member);
            // validate form
            $formErorr=array();
            //if(strlen($user)< 4){

            //  $formErorr[]='<div class="alert alert-danger">!Username cant be less than <strong>4 chracter</strong>!</div>';
            //}

            if(empty($name)){

                $formErorr[]='!name cant be  <strong>Empty</strong>!';
            }  
             if(empty($desc)){

                $formErorr[]='!description cant be  <strong>Empty</strong>!';
            }  
             if(empty($price)){

                $formErorr[]='!price cant be  <strong>Empty</strong>!';
            }  
             
            if($status==0){

                $formErorr[]='!You Must Chose  <strong>Status</strong>!';
            }
             if($country==0){

                $formErorr[]='!You Must Chose  <strong>Country</strong>!';
            }
             if (!empty($avatarName) && ! in_array($avatarExtention,$avatarAllowedExcetention)) {
                $formErorr[]='!This Exetion Is <strong> Not Allowed </strong>!';
            }
            if (empty($avatarName)) {
                $formErorr[]='!Avatar Is <strong> Required </strong>!';
            }
            if ($avatarSize > 4194304) {
                $formErorr[]='!Avatar Cant Larger Than <strong> 4MB </strong>!';
            }
            foreach ($formErorr as $erorr) {
            
                echo '<div  alert alert-danger">'. $erorr. '</div>' ;
            }
            //validate form
            if(empty($formErorr)){
                $avatar=rand(0,10000).'_'.$avatarName;
                move_uploaded_file($avatarTemp, "admin\uplods\avatars\\".$avatar);
            //insert items in data base

                $stmt=$con->prepare('INSERT INTO 
                                    item 
                                    (name,description,price,country,status,add_date,member_id,cat_id,image_item) 
                                    VALUES 
                                    (:zname,:zdesc,:zprice,:zcountry,:zstatus,now(),:zmem,:zcat,:zimgg)');
                $stmt->execute(array(
                    'zname'    =>$name , 
                    'zdesc'    =>$desc, 
                    'zprice'   =>$price , 
                    'zcountry' =>$country,
                    'zstatus'  =>$status,
                    'zmem'     =>$_SESSION['uid'],
                    'zcat'     =>$Category,
                    'zimgg'    =>$avatar
                    
                                       ));
            
            echo "<div class='contaiiner  alert alert-success isre'>". $stmt->rowCount()." ". 'Record Inserted '."</div>";
            
            }
        }
        echo('</div>');

 include $tpl."footer.php";?>