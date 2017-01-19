<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/25
 * Time: 20:35
 */
namespace Admin\Model;
use Think\Model;
class DocModel extends Model{
    protected $pk='doc_id';

    protected $fields=array(
       'doc_id','doc_title','doc_content','doc_file','doc_author','doc_ctime',

    );
    protected $_map=array(
      'title'=>'doc_title',
      'content'=>'doc_content',



    );
    protected $_validate=array(
       // array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
    array('doc_content','require','内容不能为空',1,'regex',3),


    );
   protected $_auto=array(
      // array(完成字段1,完成规则,[完成条件,附加规则]),
    array('doc_author', 'getUid', 3, 'function'),
    array('doc_ctime','getNowDateTime',1,'function'),
   );

}