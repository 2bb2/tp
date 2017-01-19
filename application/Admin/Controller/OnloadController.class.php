<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/20
 * Time: 19:36
 */
namespace Admin\Controller;
use Think\Controller;
class  OnloadController extends CommonController{


   function index(){
    //   加载方法只能在模块中调用,在controller中调用
    //   load('@/my_test');
   //  my_test();


//自定义的方法 自能在common下创建 function.php
      //  mytest();

//  来源是admin/common/function.php
   //  func();

 //      mydir方法在common/common/dir.php
 //     mydir();

 //      myload();

 //这是在Tools下的Xml类中的方法
 //   $xml=new \Tools\Xml;
 //    $xml->index() ;

   }
}