<?php
return array(
	//'配置项'=>'配置值'
    //在项目配置项中 自动加载自定义的文件 文件写在common/common下 可以写多个文件
    'PAGESIZE'             => 5,

    'LOAD_EXT_FILE'        =>'dir,myLoad',

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  '',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀


    'TMPL_PARSE_STRING' => array(
        //设置路径常量 设置了没有用 我用的是 __PUBLIC__
        '__ADMIN__' => '/Public/Admin',
        '__ADMINCSS__' => '/Public/Admin/css',
        '__ADMINJS__' => '/Public/Admin/js',
        '__ADMINIMG__' => '/Public/Admin/images',
        '__COMMON__' => '/Public/Common',
    ),

    //设置重写模式
    'URL_MODEL'=>2,
    //设置禁止访问的模块
    'MODULE_DENY_LIST'=>array('Common','Runtime'),
    //设置允许访问的模块
    'MODULE_ALLOW_LIST'=> array('Admin','Home'),
    //设置默认访问的方法
    'DEFAULT_MODULE'=>'Admin',
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    //设置默认访问的方法
    'DEFAULT_ACTION'=>'login',
    //登陆页面的 Trace
    'SHOW_PAGE_TRACE'=>true,

);