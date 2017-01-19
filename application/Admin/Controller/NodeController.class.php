<?php
namespace Admin\Controller;
use Think\Controller;
class NodeController extends CommonController{
    function index(){
        $node = D('Node');
        $node_list = $node->select();
        $this->assign('node_list', $node_list);
        $this->display();
    }
    
    
    function add(){
        $node = D('Node');
        $node_list = $node->select();
        $this->assign('node_list', $node_list);
        $this->display();
    }
    
    function addOk(){
        $node = D('Node');
        $data = $node->create('', 1);
        if($node->add($data)){
            $this->success('添加节点成功', U('index'), 3);
        } else {
            $this->error('添加节点失败', U('add'), 3);
        }
    }
}










