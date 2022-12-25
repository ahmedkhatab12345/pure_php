<?PHP
$dsn='mysql:host=localhost;dbname=shop';
$user='root';
$pass='';
try{
    $con=new PDO($dsn,$user,$pass);
    echo "  ";
}catch(PDOException $e){
    echo "faild to connet". $e ->getMessage();

}
?>