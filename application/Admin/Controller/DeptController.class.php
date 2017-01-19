<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/18
 * Time: 17:29
 */
namespace Admin\Controller;
use Think\Controller;
class DeptController extends CommonController{


 function index(){
   $dept=D('Dept');
   //$dept_list=$dept->select();
   $dept_list=$dept->alias('d1')
       ->field('d1.dept_id,d1.dept_name,d1.dept_pid,d2.dept_name name,
        d1.dept_sort,d1.dept_remark,d1.dept_level')
        ->join('left join oa_dept d2 on d1.dept_pid=d2.dept_id')
       ->select();
     echo $dept->getlastsql();
     $dept_list=getDeptTree($dept_list);

     $this->assign('dept_list',$dept_list);

        $this->display();


    }
  function getcontent(){
      $pageno=I('post.p');
     echo $pageno;
  }



    function Add(){
    $dept=M('dept');
    $dept_list= $dept->select();
        $this->assign('dept_list',$dept_list);
        $this->display();

    }

    function addOK(){

        $name=I('post.name');
        $pid=I('post.pid');
        $level=I('post.level');
        $sort=I('post.sort');

        $remark=I('post.remark');

        $info=array(
            'dept_name'=>$name,
            'dept_pid'=>$pid,
            'dept_level'=>$level,
            'dept_sort'=>$sort,
            'dept_remark'=>$remark,
            'dept_ctime'=>date('Y-m-d')


        );
        $dept=M('dept');
       if($dept->add($info) ){
           // 参数1: 提示信息
           // 参数2: 跳转的地址
           // 参数3: 延迟多少秒后跳转
         $this->success('部门添加成功',U('index'),3 );

       }else{
           $this->error('添加失败',U('add'),3);
       }

    }

    function del(){
        $id = I('get.id');
        $dept = D('dept');

        if($dept->delete($id)){
            $this->success('删除部门成功', U('index'), 3);
        } else {

            $this->error('删除部门失败', U('index'), 3);
        }
    }

        function dels(){
           $ids=I('get.ids');
            echo $ids;
            die;
            $dept = D('dept');

            if($dept->delete($ids)){
                $this->success('删除部门成功', U('index'), 3);
            } else {

                $this->error('删除部门失败', U('index'), 3);
            }


        }


      function edit(){
          $id=I('get.id');
          $dept=D('dept');
          $dept_info= $dept->find($id);
          $this->assign('dept_info',$dept_info);
          //② 查询全部部门信息，分配到模板
          $dept_list = $dept->field('dept_id, dept_name')->select();

          $this->assign('dept_list',$dept_list);

        $this->display();
      }
}

/*$('.pagination').pagination({$count},{
    callback: function(page){
        //参数1 :请求php后台程序的路径
        //参数2 :向后台程序发送的页码 json对象
        //参数3 :readyState变为4时触发的事件,参数Msg就是后台php程序返回的结果
        //参数4 :返回值的类型 text(默认类型) .json xml
        $.post("{:U('getconment')}",{'p':page},function(msg){
            // alert(msg);
            $('tbody').html(msg);
        },'text')

	},
    display_msg: true,
	setPageNo: true,
    items_per_page : 1, // 每页显示多少条记录
    current_page : 1     //当前页码
});*/


?>