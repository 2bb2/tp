<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/21
 * Time: 20:08
 */
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController{

    function index (){
        $user=D('user');
        //tp中的分页类核心 是sql="select *from Tb_name limit $pageno,$pagesize ";
       //定义每页显示数
        $pagesize=C('PAGESIZE');
        $this->assign('pagesiez',$pagesize);
        //定义当前页
       // $pageno=3;
        $pageno=I('get.p');


        $user_list=$user->page($pageno,$pagesize)->select();
        $this->assign('user_list',$user_list);
       // $this->display();

        //制作分页导航条
        //获取总记录数 求总页数
        $count=$user->count();
        $this->assign('count',$count);
        $page=new \Think\Page($count,$pagesize);
        //获取分页导航条的字符串
        $str=$page->show();
        $this->assign('str',$str);
        $this->display();
    }
      function getcontent(){
        //获取当前页
          $pageno=I('post.p');
          //每页显示条数
          $pagesize=C('PAGESIZE');
          $user=D('user');
          $user_list=$user->page($pageno,$pagesize)->select();
          // dump($user_list);

          $this->assign('user_list',$user_list);
          $this-> display();

          //将取得到的数组，转成字符串
       /*  $str = "";
         foreach($user_list as $value){
             $str .= "<tr>
                 <td class='num'>".$value['user_id']."</th>
                 <td class='name'>".$value['user_name']."</th>
                 <td class='nickname'>".$value['user_nickname']."</th>
                 <td class='dept'>".$value['user_dept']."</th>
                 <td class='sex'>".$value['user_sex']."</th>
                 <td class='birthday'>".$value['user_birthday']."</th>
                 <th class='tel'>".$value['user_tel']."</th>
                 <th class='email'>".$value['user_email']."</th>
                 <th class='ctime'>".$value['user_ctime']."</th>
                 <th class='operate'>操作</th>
             </tr>";
         }
         echo $str;*/



      }


    function add(){
       $dept=D('dept');
        $dept_list=$dept->field('dept_name,dept_id')->select();
       $this->assign('dept_list',$dept_list);
        $this->display();
    }
    function addOk(){
        $user=D('User');
        $data=$user->create('',1);

        if(!$data){
            $err=$user->getError();
          dump($err);
            $this->error('no',U('add'),3);
        }else{
      if($user->add($data)){

         $this->success('yse',U('index'),3);
      }else{
          $this->error('no',U('add'),3);
      }

    }

    }

      function del(){
          $id=I('get.id');
          $user=D('user');
          if($user->delete($id)){

              $this->success('yse',U('index'),3);
          }else{
              $this->error('no',U('add'),3);
          }
      }

      function charts(){
        $user=D('user');
        $sql="SELECT d.dept_name,count(*) as c from oa_dept d join oa_user u on d.dept_id=u.user_dept GROUP BY user_dept";
        $user_list=$user->query($sql);
         // dump($user_list);die;
         /* $str = "";
          foreach($user_list as $value){
              $str .= "['{$value['dept_name']}', {$value['c']}],";
          }
          $this->assign('str', $str);*/

       $this->assign('user_list',$user_list);
          $this->display('zhuzhuang');
      }

}