<?php

if(@!empty($id = $_GET['id'])){
  $id = $_GET['id'];
  $sql = "SELECT * FROM book WHERE id=$id";
  $res = getlist($sql);
}

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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>网上书城</title>
    <link rel="stylesheet" href="css/shopping.css">
  </head>
  <body>
    <header>
      <nav>
        <ul class="nav">
          <li><a href="#">书吧</a></li>
          <li><a href="index.php" class="on">网站首页</a></li>
          <li><a href="#">关于我们</a></li>
          <li><a href="show.php">图书展示</a></li>
          <li><a href="#">联系我们</a></li>
          <li><a href="shopping.php">购物车</a></li>
          <li><a href="addition.html">添加图书</a></li>
        </ul>
      </nav>
    </header>
    <div class="shopping">
      <h1>购物车</h1>
      <div class="shop">
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr class="info">
            <td>图书</td>
            <td>书名</td>
            <td>数量</td>
            <td>单价</td>
            <td>结算</td>
            <td>删除</td>
          </tr>
          <?php if(!empty($id)){ ?>
            <tr class="info_n">
              <td><img src="images/<?php echo $res[0]['pic'] ?>" alt=""></td>
              <td><?php echo $res[0]['title'] ?></td>
              <td>1本</td>
              <td><?php echo $res[0]['price'] ?></td>
              <td>付款</td>
              <td>删除</td>
            </tr>
          <?php }else{ ?>
            <tr class="info_n">
              <td><img src="images/zhantianjing.png" alt=""></td>
              <td>啦啦啦</td>
              <td>1本</td>
              <td>33.3</td>
              <td>付款</td>
              <td>删除</td>
            </tr>
          <?php } ?>
          
        </table>
      </div>
    </div>
    <footer>
      <div class="footer"><span>
          <ul class="lianjie">
            <li><a href="#">免费条款</a></li>
            <li><a href="#">隐私保护</a></li>
            <li><a href="#">咨询热点</a></li>
            <li><a href="#">联系我们</a></li>
            <li><a href="#">公司简介</a></li>
            <li><a href="#">批发方案</a></li>
            <li><a href="#">配送方式</a></li>
          </ul></span><span class="banQuan">©2016-2999 SSS版权所有，并保留所有权利</span></div>
    </footer>
  </body>
</html>