<div >
<h1  style="text-align: center;">CM => M</h1>
<form method="POST" action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in1">
	<input type="submit" value="Convert"> 
</form>
<hr>
<h1  style="text-align: center;">M => CM</h1>
<form action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in2">
	<input type="submit" value="Convert"> 
</form>
<hr>
<h1 style="text-align: center;">KG => GM</h1>
<form action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in3">
	<input type="submit" value="Convert"> 
</form>
<hr>
<h1 style="text-align: center;">GM => KM</h1>
<form action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in4">
	<input type="submit" value="Convert"> 
</form>
<hr>
<h1 style="text-align: center;">M => M3</h1>
<form action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in5">
	<input type="submit" value="Convert"> 
</form>
<hr>
<h1 style="text-align: center;">M3 => M</h1>
<form action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in6">
	<input type="submit" value="Convert"> 
</form>
<hr>
<h1 style="text-align: center;">HR => S</h1>
<form action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in7">
	<input type="submit" value="Convert"> 
</form>
<hr>
<h1 style="text-align: center;">S => HR</h1>
<form action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in8">
	<input type="submit" value="Convert"> 
</form>
<hr>
<h1 style="text-align: center;">KM => M</h1>
<form action="<?PHP echo $_SERVER['PHP_SELF']?>">
	Cm= <input type="text" name="in9">
	<input type="submit" value="Convert"> 
</form>
<hr>
</div>
<?PHP
$input1=$_POST['in1'];
echo 'The Result of converting '.$input1.'cm  = '.$input1/100;
echo ' m';
?>