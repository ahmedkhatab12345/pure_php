<?PHP
session_start();?>
        <meta charset="UTF-8">
        <title>Confirm</title>
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
</nav>
<?PHP
           include 'int.php';

        $userid = isset($_GET['userid'])&&is_numeric($_GET['userid'])? intval($_GET['userid']):0;
        $stmt=$con->prepare("SELECT * FROM item WHERE item_id=? LIMIT 1 ");
        $stmt->execute(array($userid));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();

           if($_SERVER['REQUEST_METHOD']=='POST'){
            echo "<h1 class='text-center'>Confirm procurement process</h1>";
            $name   =$_POST['name'];
            $user   =$_POST['username'];
            $add    =$_POST['address'];
            $email  =$_POST['email'];
            $mo1    =$_POST['mobil'];
            $mo2    =$_POST['mobil2'];
            $piec   =$_POST['pieces'];
            /*
            // validate form
            $formErorr=array();
            //if(strlen($user)< 4){

            //  $formErorr[]='<div class="alert alert-danger">!Username cant be less than <strong>4 chracter</strong>!</div>';
            //}

            if(strlen($user)> 20){

                $formErorr[]='!Username cant be less than <strong>20 chracter</strong>!';
            }  

            if(empty($user)){
            
                $formErorr[]='!Username cant be <strong> empty </strong>!';
            }elseif (strlen($user)< 4){
                   $formErorr[]='!Username cant be less than <strong>4 chracter</strong>!';
            }if(empty($pass)){
            
                $formErorr[]='!Password cant be <strong> empty </strong>!';
            }

            if(empty($name)){
            
                $formErorr[]='!Full Name cant be <strong> empty </strong>!';
            }
            
            if(empty($email)){
            
                $formErorr[]='!Email cant be <strong> empty </strong>!';
            }
            
            foreach ($formErorr as $erorr) {
            
                echo '<div  alert alert-danger">'. $erorr. '</div>' ;
            }
            //validate form
           
            if(empty($formErorr)){
               */
            //insert user in data base
                $stmt=$con->prepare('INSERT INTO 
                                    buy
                                    (name,username,address,email,mobile1,mobile2,piesies,order_date) 
                                    VALUES 
                                    (:zname,:zuser,:zaddr,:zemail,:zmob1,:zmob2,:zpies,now())');
                $stmt->execute(array(
                    'zname' =>$name,
                    'zuser' =>$user, 
                    'zaddr' =>$add, 
                    'zemail'=>$email,
                    'zmob1' =>$mo1,
                    'zmob2' =>$mo2,
                    'zpies' =>$piec));
                    ?>
                    <div class="container">
                        <div class="confirming" style="border: 3px solid #D4EDDA;border-radius: 9px; padding: 88px">
                        <h1 class="text-center"><?PHP echo $row["name"];?></h1>
                        <h2 style="font-size: 45px;">Total Price is : 
                        <?PHP
                            $filterprice=filter_var($row["price"],FILTER_SANITIZE_NUMBER_INT);
                            $totalprice=$piec*$filterprice;
                            echo ($totalprice)+($totalprice*0.05).'LE';
                        ?>  
                         </h2>
                         <a href="index.php" class="btn btn-warning float-right"> Confirm</a>
                         </div>
                    </div>
                    <?PHP
              
        }else{
            //$erorrMessage="Sorry you cant acsess this page ";
            //redirctHome($erorrMessage,3);
            echo '<div class="contaiiner alert alert-danger">'."! Sorry you cant acsess this page !".'</div>';
        }
 
    
         include $tpl."footer.php";
        ?>