<?
	global $conn;
	function connect_db(){
		global $conn;
		$conn = mysqli_connect('localhost', 'root', '', 'comment');
		if (!$conn) echo "Can\'t conect to database <br>";
	}
	function disconnect_db(){
		global $conn;
		if ($conn){
			mysqli_close($conn);
		}
	}
	connect_db();
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Comment using PHP and MYSQL</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Thông tin</h1>
	<form method = "POST">
		<p>Nhap ten: </p>
		<input type="text" name="cmt_name">
		<p>Comment: </p> <br>
		<input type = "text" name = "cmt_comment">
		<br>
		<input type = "submit" name ="cmt_submit">

	</form>
	
	<h1>Comment</h1>
	<hr>
	<?php
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$conn = mysqli_connect('localhost', 'root', '', 'comment');
		if (!$conn) echo "Can\'t conect to database <br>";
		if (!empty($_POST['cmt_submit'])){
			$name = addslashes($_POST['cmt_name']);
	    		$date = date('Y-m-d H-i-s');
	    		$comment = addslashes($_POST['cmt_comment']);
	    		$sql = "INSERT INTO tb_comment(name, date, comment) VALUES ('$name', '$date','$comment')";
	    		mysqli_query($conn, $sql);
	    		header('Location: index.php');
		}
		$sql = "SELECT * FROM tb_comment ORDER BY date DESC";
		$query = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($query)){
			echo "{$row['date']} <br> {$row['name']} : {$row['comment']}<br>";
			echo "<hr>";

		}
		mysqli_close($conn);

		
	?>
</body>
</html>
