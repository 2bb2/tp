<?php if (!defined('THINK_PATH')) exit(); if(is_array($user_list)): foreach($user_list as $key=>$vo): ?><tr>
        <td class="num"><?php echo ($vo["user_id"]); ?></th>
        <td class="name"><?php echo ($vo["user_name"]); ?></th>
        <td class="nickname"><?php echo ($vo["user_nickname"]); ?></th>
        <td class="dept"><?php echo ($vo["user_dept"]); ?></th>
        <!-- <td class="role">1</th>-->
        <td class="sex"><?php echo ($vo["user_sex"]); ?></th>
        <td class="birthday"><?php echo ($vo["user_birthday"]); ?></th>
        <th class="tel"><?php echo ($vo["user_tel"]); ?></th>
        <th class="email"><?php echo ($vo["user_email"]); ?></th>
        <th class="ctime"><?php echo ($vo["user_ctime"]); ?></th>
        <th class="operate"><a href="<?php echo U('del','id='.$vo['user_id']);?>">删除</a></th>
    </tr><?php endforeach; endif; ?>