<?php
// 从数据库获取到数据

$sql = "SELECT * FROM book";
$list = getlist($sql);

$perPage=9;
// $sql = "SELECT * FROM book";
// $list = getlist($sql);
$totalCount = count($list);
$page = ceil($totalCount/$perPage);
if(empty($_GET['p'])){
    $startPage = 0;
}else{
    $startPage = ($_GET['p']-1)*$perPage;
}

$sqls = "SELECT * FROM book LIMIT $startPage,$perPage";
$lists = getlist($sqls);

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
    <link rel="stylesheet" href="css/index.css">
    <script src="jQuery.js"></script>
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
    <div class="main">
      <div class="mleft">
        <h1>我的书城</h1>
        <p>这里拥有世界各地的书籍，只有你想不到，没有我们这里没有的图书。</p><img src="images/renwu.png" alt="">
      </div>
      <div class="mright">
        <h1>快速登录</h1>
        <?php
          session_start();
          if(!empty($_COOKIE['name'])){
            $_SESSION['name']=$_COOKIE['name'];
          }

          if(!empty($_SESSION['name'])){
            echo $_SESSION['name']." 欢迎您登录";
          }else{?>
            <input id="name" type="text" placeholder="用户名">
            <input id="pwd" type="password" placeholder="密码">
            <div class="btn">
              <button onclick="verify()" class="login">登录</button>
              <button>注册</button>
            </div>
         <?php } ?>


      
      </div>
    </div>
    <div class="show">
      <ul class="showBox">
      <?php
        foreach ($lists as $k => $v) { ?>
          
        <li><a href="show.php?id=<?php echo $v['id'] ?>"><img src="images/<?php echo $v['pic']; ?>" alt="">
          <h3><?php echo $v['title'] ?></h3></a>
          <div class="price"><span>￥<?php echo $v['price'] ?></span><a href="#">立即购买</a></div>
        </li>
        <?php }
      ?>
        
      </ul>
      <div class="fanYe">
        <ul class="num">
          <li class="pre">&lt;&lt;</li>
          <li id="nums1" class="nu num3">1</li>
          <li id="nums2" class="num3">2</li>
          <li class="next">&gt;&gt;</li>
        </ul>
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
<script>
var nums1 = document.getElementById("nums1");
var nums2 = document.getElementById("nums2");
$('.pre').click(function(){
  if(parseInt($('#nums1').html())<=1){
    $('#nums1').html(1);
    $('#nums2').html(2);
  }else{
    $('#nums1').html(parseInt($('#nums1').html())-1);
    $('#nums2').html(parseInt($('#nums2').html())-1);
  };
  if($(".num3").eq(0).hasClass("nu")){
    getData($('#nums1').html());
  }else{
    getData($('#nums2').html());
  }
  
});
$('.next').click(function(){
  if(parseInt($('#nums2').html())>=<?php echo $page; ?>){
    $('#nums1').html(<?php echo $page-1; ?>);
    $('#nums2').html(<?php echo $page; ?>);
  }else{
    $('#nums1').html(parseInt($('#nums1').html())+1);
    $('#nums2').html(parseInt($('#nums2').html())+1);
  };
  if($(".num3").eq(0).hasClass("nu")){
    getData($('#nums1').html());
  }else{
    getData($('#nums2').html());
  }
});

$('.num3').click(function(){
  getData($(this).html());
  $('.num3').removeClass('nu');
  $(this).addClass('nu');
});

function getData(p){
    $.ajax({
        type: "post",
        url: "list.php",
        dataType: "json",
        data:{
            p:p,
            perPage:<?php echo $perPage; ?>
        },
        async: true,
        success:function(data){
            var str = "";
            for(var i=0;i<data.length;i++){
              str += "<li><img src='images/"+data[i]['pic']+"' alt=''>"+
          "<h3>"+data[i]['title']+"</h3>"+
          "<div class='price'><span>"+data[i]['price']+"</span><a href='#'>立即购买</a></div>"+
          "</li>"

            }
            $(".showBox").html(str);
        }
    })
}


function verify(){
  var name = document.getElementById("name").value;
  var pwd = document.getElementById("pwd").value;
  $.ajax({
    type: "post",
    url: "login.php",
    async: true,
    dataType: "json",
    data:{
      name: name,
      pwd: pwd
    },
    success:function(data){
      console.log(data);
      if(data.data == 1){
        window.location="index.php";
      }else{
        alert("用户名或密码错误");
      }
    }
  })
}

</script>
</html>