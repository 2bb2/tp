<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />

	<script src="/Public/Common/iDialog/jquery-1.8.3.min.js"></script>
	<script src="/Public/Common/iDialog/jquery.iDialog.js" dialog-theme="default"></script>
<title>移动办公自动化系统</title>
<style type='text/css'>
	table tr .num {width:50px;}
	table tr .name {width:320px;}
	table tr .process {width:80px;}
	table tr .file {width:80px; padding-left:13px;}
	table tr .node {width:80px;}
	table tr .addtime {width:80px;}
	.i-content {height:400px; overflow:auto;}
</style>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="<?php echo U('add');?>" class="add">发件</a>
    <a href="javascript:;" class="del" id='btnDel'>删除</a>
    <a href="javascript:;" class="edit" id='btnEdit'>编辑</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="num">序号</th>
            	<th class="num">状态</th>
                <th class="name">邮件主题</th>
                <th class="process">内容</th>
				<th class="file">附件下载</th>
                <th class="node">发件人</th>
                <th class="time">发送时间</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
		<?php if(is_array($email_list)): foreach($email_list as $key=>$vo): ?><tr>
            	<td class="num"> <?php echo ($vo["email_id"]); ?> </td>

               <td>

				<?php if($vo["email_read"] == 1): ?><img src="/Public/Admin/images/rmail.png">
				<?php else: ?>
            	<img src="/Public/Admin/images/rmail1.png"><?php endif; ?>

				</td>
                <td class="name"><?php echo ($vo["email_title"]); ?></td>
                <td class="process">
                	<a class='show' onclick="show('<?php echo ($vo["email_id"]); ?>')" >查看全文</a>
                </td>
				<td class="file">
				<a href="<?php echo U('upload','id='.$vo[email_id]);?>">附件下载</a>				</td>
                <td class="node"><?php echo ($vo["user_name"]); ?></td>
                <td class="time"><?php echo ($vo["email_ctime"]); ?></td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='1' />
                </td>
            </tr><?php endforeach; endif; ?>
                 </tbody>
    </table>
</div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/core.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>


<script type="text/javascript">
	function show(id){
		//post方法异步请求php后台才带的参数中返回相应的数据
		$.post("<?php echo U('ById');?>",{'id':id},function(msg){
			//alert(msg);
			//idialog插件的参数 把title和content修改下
			iDialog({
				title:msg.email_title,
				//id:'DemoDialog  ',
				content:msg.email_content,
				lock: true,
				width:700,
				fixed: true,
				height:400
			});

		},'json');



	}


$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})

$('.pagination').pagination(100,{
	callback: function(page){
		alert(page);	
	},
	display_msg: true,
	setPageNo: true
});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');
</script>
</html>