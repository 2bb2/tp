<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
<style type='text/css'>
	table tr .num{ width:63px; text-align: center;}
	table tr .name{ width:63px; padding-left:17px;}
	table tr .nickname{ width:63px; padding-left:13px;}
	table tr .dept{ width:63px; padding-left:13px;}
	table tr .role{ width:63px; padding-left:13px;}
	table tr .sex{ width:63px; padding-left:13px;}
	table tr .birthday{ width:63px; padding-left:13px;}
	table tr .tel{ width:63px; padding-left:13px;}
	table tr .email{ width:63px; padding-left:13px;}
	table tr .ctime{ width:63px; padding-left:13px;}
	table tr .operate{ width:63px; padding-left:15px;}
	table tr .operate a{ color:#2c7bbc;}
	table tr .operate a:hover{ text-decoration:underline;}
</style>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="<?php echo U('add');?>" class="add">添加</a>
    <a href="" class="del">删除</a>
    <a href="" class="edit">编辑</a>
    <a href="<?php echo U('charts');?>" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="num">序号</th>
                <th class="name">姓名</th>
                <th class="nickname">昵称</th>
                <th class="dept">部门</th>
              <!--  <th class="role">角色</th>-->
                <th class="sex">性别</th>
                <th class="birthday">生日</th>
                <th class="tel">电话</th>
                <th class="email">邮箱</th>
                <th class="ctime">添加时间</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        	<?php if(is_array($user_list)): foreach($user_list as $key=>$vo): ?><tr>
            	<td class="num"><?php echo ($vo["user_id"]); ?></th>
                <td class="name"><?php echo ($vo["user_name"]); ?></th>
                <td class="nickname"><?php echo ($vo["user_nickname"]); ?></th>
                <td class="dept"><?php echo ($vo["user_dept"]); ?></th>
               <!-- <td class="role">1</th>-->
                <td class="sex"><?php echo ($vo["user_sex"]); ?></th>
                <td class="birthday"><?php echo ($vo["user_birthday"]); ?></th>
                <th class="tel"><?php echo ($vo["user_tel"]); ?></th>
                <th class="email"><?php echo ($vo["user_email"]); ?></th>
                <th class="ctime"><?php echo ($vo["user_ctime"]); ?></th>
                <th class="operate"><a href="<?php echo U('del','id='.$vo['user_id']);?>">删除</a></th>
            </tr><?php endforeach; endif; ?>

            
        </tbody>
    </table>
</div>
<div class="pagination ue-clear"></div>
<!--需要把JS  pagination注释掉 <div class="pagination ue-clear"><?php echo ($str); ?> </div>-->
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})


$('.pagination').pagination(<?php echo ($count); ?>,{
	callback: function(page){
		//参数1: 请求后台PHP程序的路径
		//参数2: 向后台程序发送的页号,json对象
		//参数3: readyState变为4时的触发事件,参数msg就是后台PHP程序返回的结果
		//参数4: 返回值类型，text（默认类型）、json、xml
		$.post("<?php echo U('getContent');?>",{'p':page+1}, function(msg){
			//alert(msg);
				$('tbody').html(msg);
		}, 'text');
	},

	display_msg: false,  //是否显示统计信息
	setPageNo: true,     //是否显示页面跳转
	prev_text : "&lt;&lt;&nbsp;上一页",  // 上一页按钮上的显示文字
	next_text : "下一页&nbsp;&gt;&gt;",  // 下一页按钮上的显示文字
	items_per_page : <?php echo C('PAGESIZE');?>, // 每页显示条数

});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');
</script>
</html>