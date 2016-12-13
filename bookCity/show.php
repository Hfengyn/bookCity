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
    <link rel="stylesheet" href="css/show.css">
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
    <div class="show auto">
      <div class="picbox">
      <?php if(!empty($id)){ ?>
        <img src="images/<?php echo $res[0]['pic']; ?>" alt="">
        <?php }else{ ?>
        <img src="images/juren.png" alt="">
        <?php } ?>
      </div>
      <div class="right">
      <?php if(!empty($id)){ ?>
        <p class="title"><?php echo $res[0]["title"]; ?></p>
          <p class="content"><?php echo $res[0]["Introduction"]; ?></p>
          <div class="detail">
            <div class="detailinner">
              <div class="box"><span class="left">作者：</span><span class="author"><?php echo $res[0]["author"]; ?></span></div>
              <div class="box"><span class="left">出版社：</span><span class="edit"><?php echo $res[0]["press"]; ?></span></div>
              <div class="box"><span class="left">出版时间：</span><span class="time"><?php echo $res[0]["pressTime"]; ?></span></div>
              <div class="box"><span class="left">国际标准书号ISBN：</span><span class="isbn"><?php echo $res[0]["isbn"]; ?></span></div>
              <div class="box"><span class="left">友情价格：</span><span class="price">￥<?php echo $res[0]["price"]; ?></span></div>
            </div>
          </div>
          <div class="btnbox"><a href="shopping.php?id=<?php echo $res[0]["id"]; ?>" class="incar">加入购物车</a><a href="#" class="nowbuy">立即购买</a></div>
          <?php }else{ ?>
          <p class="title">巨人的陨落(世界是属于勇敢者的，所以世界是属于我的)</p>
          <p class="content">(全球读者平均3个通宵读完的超级巨作，全球每三秒卖出一本！十年来，横扫欧美16国排行榜的超级小说。碾压全球畅销榜的伟大故事，18次登上10国畅销榜第一名！首次登陆中国！)读客出品</p>
          <div class="detail">
            <div class="detailinner">
              <div class="box"><span class="left">作者：</span><span class="author">[英]肯·福莱特</span></div>
              <div class="box"><span class="left">出版社：</span><span class="edit">江苏文艺出版社</span></div>
              <div class="box"><span class="left">出版时间：</span><span class="time">2016年4月</span></div>
              <div class="box"><span class="left">国际标准书号ISBN：</span><span class="isbn">4545445454545</span></div>
              <div class="box"><span class="left">友情价格：</span><span class="price">￥110.30</span></div>
            </div>
          </div>
          <div class="btnbox"><a href="shopping.php" class="incar">加入购物车</a><a href="#" class="nowbuy">立即购买</a></div>
          <?php } ?>
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