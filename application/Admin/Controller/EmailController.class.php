<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/26
 * Time: 19:30
 */
namespace Admin\Controller;
use Think\Controller;
class emailController extends CommonController
{
    function index()
    {
        $email = D('email');
        // $email_list=$email->select();
        $sql = "select u.user_name,e.email_title,e.email_content,e.email_file,e.email_ctime,e.email_id,e.email_read
       from oa_email e join oa_user u where e.email_from=u.user_id";
        $email_list = $email->query($sql);
        $this->assign('email_list', $email_list);
        $this->display();
    }

    function add()
    {

        $this->display();
    }

    function addOK()
    {
        $config = array(

            'maxSize' => 0, //上传的文件大小限制 (0-不做限制)
            'exts' => array('jpg', 'png', 'gif', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'mp3'), //允许上传的文件后缀
            'rootPath' => './Upload/', //保存根路径
            'savePath' => '', //保存路径


        );
        $upload = new \Think\Upload($config);
        $info = $upload->upload();
        // print_r($info);die;
        if (!$info) {

            echo $upload->geterror();
        };


        $email = D('email');
        $data = $email->create('', 1);


        if ($info) {
            $data['email_file'] = $config['rootPath'] . $info['email_file']['savepath'] . $info['email_file']['savename'];

            if ($email->add($data)) {
                $this->success('添加成功', U('index'), 3);
            } else {
                $this->error('添加失败', U('add'), 3);
            }
        }

    }

    function upload()
    {
        $email = D('email');
        $id = I('get.id');
        $sql = "select email_file from oa_email where email_id=$id ";
        $arr = $email->query($sql);
        $path = $arr[0]['email_file'];
        //4. 使用PHP4句话进行文件下载
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header("Content-Length: " . filesize($path));
        readfile($path);


    }

    function getNames()
    {
        $name=I('get.name');

       //1. 接收前台提交数据
        $name = I('post.name');
        //2. 实例化User模型
        $user = D('User');
        //3. 根据关键词进行模糊查询
        $user_list = $user->field('user_name')->where("user_name like '%$name%'")->select();
        //4. 返回查询结果
        echo json_encode($user_list);
    }

   function ById(){
       $id=I('post.id');
       $email=D('email');
       $arr=$email->field('email_title,email_content')->find($id);
      /* 3. 将doc_content的中实体转回特殊字符
       $doc_info['doc_content'] = htmlspecialchars_decode($doc_info['doc_content']);
       echo json_encode($doc_info);*/
      echo json_encode($arr);

   }

}