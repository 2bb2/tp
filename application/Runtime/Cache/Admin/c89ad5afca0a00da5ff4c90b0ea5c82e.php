<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="<?php echo U('add');?>" class="add">添加</a>
    <a href="javascript:;" class="del">删除</a>
    <a href="javascript:;" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th style="width:18px"></th>
            	<th class="num">序号</th>
                <th class="name">部门名称</th>
                <th class="process">上级部门</th>
                <th class="node">排序</th>
                <th class="time">备注信息</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        	<?php if(is_array($dept_list)): foreach($dept_list as $key=>$vo): ?><tr>
        		<td><input type="checkbox" value="<?php echo ($vo["dept_id"]); ?>"/></td>
            	<td class="num"><?php echo ($vo["dept_id"]); ?></td>
                <td class="name">
                	<?php echo (str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$vo["dept_level"])); echo ($vo["dept_name"]); ?>
                </td>
                <td class="process"><?php echo ((isset($vo["name"]) && ($vo["name"] !== ""))?($vo["name"]):"顶级部门"); ?></td>
                <td class="node"><?php echo ($vo["dept_sort"]); ?></td>
                <td class="time"><?php echo ($vo["dept_remark"]); ?></td>
                <td class="operate">
                	<a href="<?php echo U('del','id='.$vo[dept_id]);?>">删除</a>&nbsp;&nbsp;&nbsp;
                	<a href="<?php echo U('edit', 'id='.$vo[dept_id]);?>">编辑</a>
                </td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<div class="pagination ue-clear"></div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
//1. 获取删除按钮标签,注册点击事件
$('.del').click(function(){
	//2. 获取已选中复选框
	// $(':checkbox') 获取所有的复选框
	// :checked已选中的复选框
	// list: 所有已选中的复选框，多标签集合（可以理解为是一个数组[不是数组]，不能用循环来操作）
	var list = $(':checkbox:checked');
	// each方法，能够将一个变量当中的多个标签对象，循环取出
	// 定义结果字符串，用来保存所有取出的dept_id的值
	var result = '';
	list.each(function(){
		result += $(this).val() + ',';
	});
	// 截取掉最后一个 ,
	result = result.substr(0, result.length - 1);
	//alert(result);
	// /Admin/Dept 转义成当前控制器   Dept
	// Dept/dels/ids/result
	location.href = "/Admin/Dept/dels/ids/" + result;
})


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
	// 点击分页导航条的页码按钮时的触发事件
	// page是要跳转的页号，但是少1；实际页号是： page+1
	callback: function(page){
		//参数1: 请求后台PHP程序的路径
		//参数2: 向后台程序发送的页号,json对象
		//参数3: readyState变为4时的触发事件,参数msg就是后台PHP程序返回的结果
		//参数4: 返回值类型，text（默认类型）、json、xml
		$.post("<?php echo U('getcontent');?>",{'p':page+1}, function(msg){
			//alert(msg);
			$('tbody').html(msg);
		}, 'text');
	},
	display_msg: false,  //是否显示统计信息
	setPageNo: true,     //是否显示页面跳转
	prev_text : "&lt;&lt;&nbsp;上一页",  // 上一页按钮上的显示文字
	next_text : "下一页&nbsp;&gt;&gt;",  // 下一页按钮上的显示文字
	items_per_page : 10, // 每页显示条数
//	items_per_page : <?php echo ($pagesize); ?>, // 每页显示条数
});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');
</script>
</html>