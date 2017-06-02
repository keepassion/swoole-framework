

$model = model('Admin'); //加载Admin类
$model->select="fu_admin.id as user_id ,fu_admin.*"; //这里是这是select参数 默认是*
$arr_param['fu_admin.username'] = $arr_post['username'];  //相关where条件
$arr_param['fu_admin.pwd']      = md5($arr_post['pwd']);  //相关where条件
$arr_param['leftjoin']          = array("fu_admin_group","fu_admin.groupid = fu_admin_group.id");  //leftjoin左连 注意这里相关的条件都可以这么写 具体如何参数 参考QueryBuild类里面有相应的函数名称
$arr_result = $model->gets($arr_param);