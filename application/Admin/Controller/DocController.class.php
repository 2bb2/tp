<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/24
 * Time: 0:35
 */
namespace Admin\Controller;
use Think\Controller;
class DocController extends CommonController{
    function index(){

        $doc=D('doc');
      //  $doc_list=$doc->select();
        $sql="select d.doc_id, d.doc_title, d.doc_content, d.doc_file, d.doc_ctime,
u.user_name from oa_doc d join oa_user u where d.doc_author=u.user_id ";
        $doc_list=$doc->query($sql);

        $this->assign('doc_list',$doc_list);
        $this->display();
    }
     function add(){


             $this->display();
    }
    //编辑器富文本测试
     function ueditor(){

         $this->display();
     }

    function addOk(){
        $config = array(

            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          => array('jpg', 'png', 'gif', 'doc', 'docx' ,'ppt', 'pptx', 'xls','xlsx','mp3'), //允许上传的文件后缀
            'rootPath'      =>  './Upload/', //保存根路径
            'savePath'      =>  '', //保存路径


        );
        $upload= new \Think\Upload($config);
        $info=$upload->upload();
      // print_r($info);die;
       if(!$info){

          echo $upload->geterror();
        };
        $doc=D('doc');
        $data=$doc->create('',1);
        //5. 调用add方法将输入插入数据表
        // 判断如果有上传的文件，将上传后的路径加入到$data中
         if($info){
          $data['doc_file']=$config['rootPath'].$info['file']['savepath'].$info['file']['savename'];

             if($doc->add($data)) {
                 $this->success('添加成功',U('index'),3);
             }else{
                 $this->error('添加失败',U('add'),3);
             }
         }
    }


     function downLoad(){
     $id=I('get.id');
     $doc=D('doc');
      $data=$doc->find($id);
       $path= $data['doc_file'];
         //4. 使用PHP4句话进行文件下载
         header("Content-type: application/octet-stream");
         header('Content-Disposition: attachment; filename="' . basename($path) . '"');
         header("Content-Length: ". filesize($path));
         readfile($path);

     }

    function show(){
        //1. 接收id
        $id = I('get.id');
        //2. 实例化Doc模型，调用find方法查询
        $doc = D('Doc');
        $doc_info = $doc->field('doc_title, doc_content')->find($id);
        //3. 将doc_content的中实体转回特殊字符
        $doc_info['doc_content'] = htmlspecialchars_decode($doc_info['doc_content']);
        echo json_encode($doc_info);
    }

}