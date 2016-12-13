<?php
$title = $_POST['title'];
$introduction = $_POST['introduction'];
$author = $_POST['author'];
$press = $_POST['press'];
$pressTime = $_POST['pressTime'];
$price = $_POST['price'];
$isbn = $_POST['isbn'];
$pic = $_POST['pic'];
$sql = "INSERT INTO book (title,introduction,author,press,pressTime,price,isbn,pic) VALUES ('$title','$introduction','$author','$press',$pressTime,$price,$isbn,'$pic')";
$res = add($sql);
if($res){
	$info['status'] = 1;
	$info['info'] = "添加成功";
}else{
	$info['status'] = 0;
	$info['info'] = "添加失败";
}
echo json_encode($info);


function add($sql){
	$link = mysqli_connect(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
	if($mysqli->errno){
		echo $mysql->errno;
	}
	// 设置编码格式
	$mysqli->query("set names utf8");
	$res = $mysqli->query($sql);
	if($res){
		return true;
	}else{
		return false;
	}
}
?>