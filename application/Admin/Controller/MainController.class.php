<?php
namespace Admin\Controller;
use Think\Controller;
 class MainController extends CommonController{


         function index(){
             //左侧管理菜单
             //1. 获取session中的roleid
             $rid = session('roleid');
             //2. 实例化Role模型，根据rid查询ids
             $role = D('Role');
             $data = $role->field('role_ids')->find($rid);
             $node_ids = $data['role_ids'];
             //3. 根据ids从Node表中查询具体可操作的权限
             $node = D('Node');
             // 查询时，分别取得顶级节点和子集节点
             $node_listA = $node->where("node_show=1 and node_id in ($node_ids) and node_level=0")->select();
             $node_listB = $node->where("node_show=1 and node_id in ($node_ids) and node_level=1")->select();
             $this->assign('node_listA', $node_listA);
             $this->assign('node_listB', $node_listB);


             //1. 实例化Email模型
             $email = D('Email');
             //2. 根据当前用户id统计未读邮件数量
             $id = session('uid');
             $count = $email->where("email_to='$id' and email_read=1")->count();
             $this->assign('count',$count);
             $this->display();
         }




         /*   $email=M();
             $uid=session(uid);
            // dump(session());
            $sql="select count(*) c from oa_email where email_to='$uid' and email_read=1  ";
             $list=$email->query($sql);

            $this->assign('list',$list);
             // print_r($list);
           $this->display();*/

             //1. 实例化Email模型
          /*    $email = D('Email');
              //2. 根据当前用户id统计未读邮件数量
              $id = session('uid');
              $count = $email->where("email_to='$id' and email_read=1")->count();
              $this->assign('count',$count);
              $this->display();*/
     }


     function home(){


         $this->display();

     }

     function getEmailNum(){
       $uid=session(uid);
         $email=M();
         $sql="select count(*) as c from oa_email where email_to='$uid' and email_read=1  ";
         $list=$email->query($sql);
         $count= $list[0][c];
         echo $count;

       /*  //1. 实例化Email模型
         $email = D('Email');
         //2. 根据当前用户id统计未读邮件数量
         $id = session('uid');
         $count = $email->where("email_to='$id' and email_read=1")->count();
         echo $count;*/

     }








?>