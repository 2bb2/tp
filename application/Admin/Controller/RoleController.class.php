<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends CommonController{
    function index(){
        $role = D('Role');
        $role_list = $role->select();
        $this->assign('role_list', $role_list);
        $this->display();
    }
    
    function distribute(){
        $node = D('Node');
        $node_list = $node->select();
        $this->assign('node_list', $node_list);
        $this->display();
    }
    
    function distributeOk(){
        $ids = I('get.ids');
        $rid = I('get.rid');
        //实例化Node模型，根据ids获取所有的node_path
        $node = D('Node');
        // select * from oa_node where node_id in (1,2,3,4,5);
        $node_list = $node->field('node_path')->select($ids);
        // 将node_list转为字符串
        $node_path = "Admin-Main-index,Admin-Main-logout,";
        foreach($node_list as $value){
            if($value['node_path'] != 'null'){
                $node_path .= $value['node_path'].',';
            }
        }
        $node_path = substr($node_path, 0, strlen($node_path) - 1);
        
        //实例化Role模型
        $role = D('Role');
        // 构造要修改的数据
        $data = array(
            'role_id' => $rid,
            'role_ids' => $ids,
            'role_path' => $node_path
        );
        if($role->save($data)){
            $this->success('分配权限成功', U('index'), 3);
        } else {
            $this->error('分配权限失败', U('index'), 3);
        }
    }
}
















