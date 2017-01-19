<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="/Public/Admin/css/base.css" />
  <link rel="stylesheet" type="text/css" href="/Public/Admin/css/jquery.dialog.css" />
  <link rel="stylesheet" href="/Public/Admin/css/index.css" />

  <script src="/Public/Common/Lobibox/lib/jquery.1.11.min.js"></script>
  <script src="/Public/Common/Lobibox/js/Lobibox.js"></script>

  <link rel="stylesheet" href="/Public/Common/Lobibox/font-awesome/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="/Public/Common/Lobibox/dist/css/Lobibox.min.css"/>


<title>移动办公自动化系统</title>
</head>

<body>
<div id="container">
  <div id="hd">
    <div class="hd-wrap ue-clear">
      <div class="top-light"></div>
      <h1 class="logo"></h1>
      <div class="login-info ue-clear">
        <div class="welcome ue-clear" style="width:150px;"><span>欢迎您,</span><a href="javascript:;" class="user-name"  ><?php echo (session('unickname')); ?></a></div>
        <div class="login-msg ue-clear"> <a href="javascript:;" class="msg-txt">消息</a> <a href="javascript:;" class="msg-num"><?php echo ($list[0][c]); ?></a> </div>
      </div>
      <div class="toolbar ue-clear"> <a href="javascript:;" class="home-btn">首页</a> <a href="javascript:;" class="quit-btn exit"></a> </div>
    </div>
  </div>
  <div id="bd">
    <div class="wrap ue-clear">
      <div class="sidebar">
        <h2 class="sidebar-header">
          <p>功能导航</p>
        </h2>
        <ul class="nav">
          <?php if(is_array($node_listA)): foreach($node_listA as $key=>$vo): ?><li class="<?php echo ($vo["node_title"]); ?>">
              <div class="nav-header">
                <a href="javascript:;" class="ue-clear">
                  <span><?php echo ($vo["node_name"]); ?></span><i class="icon"></i>
                </a>
              </div>
              <ul class="subnav">
                <?php if(is_array($node_listB)): foreach($node_listB as $key=>$v): if($v[node_pid] == $vo[node_id] ): ?><li><a href="javascript:;" date-src="<?php echo U($v[node_controller].'/'.$v[node_action]);?>"><?php echo ($v["node_name"]); ?></a></li><?php endif; endforeach; endif; ?>
              </ul>
            </li><?php endforeach; endif; ?>
        </ul>



      </div>


      <div class="content">
        <iframe src="<?php echo U('home');?>" id="iframe" width="100%" height="100%" frameborder="0"></iframe>
      </div>


    </div>
  </div>
  <div id="ft" class="ue-clear">
    <div class="ft-left"> <span>中国移动</span> <em>Office&nbsp;System</em> </div>
    <div class="ft-right"> <span>Automation</span> <em>V2.0&nbsp;2014</em> </div>
  </div>
</div>
<div class="exitDialog">
  <div class="dialog-content">
    <div class="ui-dialog-icon"></div>
    <div class="ui-dialog-text">
      <p class="dialog-content">你确定要退出系统？</p>
      <p class="tips">如果是请点击“确定”，否则点“取消”</p>
      <div class="buttons">
        <input type="button" class="button long2 ok" value="确定" />
        <input type="button" class="button long2 normal" value="取消" />
      </div>
    </div>
  </div>
</div>
</body>




<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/core.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.dialog.js"></script>
<script type="text/javascript" src="/Public/Admin/js/index.js"></script>

<script type="text/javascript">
  function getEmailNum(){
    $.ajax({
      'url': "<?php echo U('getEmailNum');?>",
      'type': 'get',
      // 如果使用get方式请求，设置为false，不进行缓存
      'cache': false,
      'dataType': 'text',
      'async': true,
      'success':function(msg){
        alert(msg);



      /* var new_num = msg;
        var old_num = $('.msg-num').html();

        if(new_num > old_num){
          var num = new_num - old_num;
          Lobibox.notify('default', {
            title: '新邮件提醒',
            msg: '您收到'+num+'封新邮件，请注意查收'
          });
          $('.msg-num').html(new_num);
        }*/
      }
    });
  }

  //setInterval('getEmailNum()',5000);

  Lobibox.notify('default', {
    msg: 'end loveliest, building stripes.',
    delay:false,
  });
</script>

</html>