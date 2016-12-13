<?php


$p = $_POST['p'];
$perPage = $_POST['perPage'];

$sql = "SELECT * FROM book";
// $list = getlist($sql);
// $totalCount = count($list);
$startPage = ($p-1)*$perPage;

$sql2 = "SELECT * FROM book LIMIT $startPage,$perPage";
// $id = "SELECT * FROM news WHERE id";
// print_r($id);
$lists = getlist($sql2);
echo json_encode($lists);








function getlist($sql){
  // 链接数据库
  $link = mysqli_connect(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
  // 设置编码格式
  mysqli_query($link,"set names utf8");
  $res=mysqli_query($link,$sql);
  $arr=array();
  while ($list = mysqli_fetch_assoc($res)) {
    $arr[]=$list;
  }
  if(!empty($arr)){
    return $arr;
  }else{
    return false;
  }
  mysqli_close();//关闭数据库链接，提高性能
}

?>