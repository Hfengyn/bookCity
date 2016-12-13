<?php

$name = $_POST['name'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM admin WHERE name='$name' AND pwd=$pwd";
$res = getlist($sql);
if($res){
	// echo "验证成功";
	session_start();
	$_SESSION['name']=$name;
	// header("Location:index.php");
	$info["data"] = 1;

}else{
	// echo "验证失败";
	$info["data"] = 2;
	// echo "<script>alert('用户名或密码错误');
	// 	window.localhost.href='index.php';
	// </script>";
}
echo json_encode($info);






function getlist($sql){
	// 连接数据库
	$link = mysqli_connect(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
	// 设置编码格式
	mysqli_query($link,"set names utf8");
	// 执行sql
	$res = mysqli_query($link, $sql);
	if($res){
		while($list = mysqli_fetch_assoc($res)){
			$arr[] = $list;
		}
		if(!empty($arr)){
			return $arr;
		}else{
			return;
		}
	}else{
		return false;
	}
	// 取所有数据
	
	
	return $arr;
}

?>