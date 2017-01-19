<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/18
 * Time: 19:20
 */
namespace Admin\Model;
use Think\Model;
class DeptModel extends Model{
    //定义主键
    protected $pk= 'dept_id';
    //定义字段
    protected $fields=array(
     'dept_id','dept_name','dept_pid','dept_level','dept_sort','dept_remark',
        'dept_ctime',

    );



}
