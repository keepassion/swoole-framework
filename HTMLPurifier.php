<?php 
namespace App\Data;


/*
    这里使用 HTMLPurifier 做过滤 存放位置为 Apps/classes下 
    使用方式为         
        $public = new \App\Data\ReData(1);          因为命名空间 如果不加 ‘\’ 他默认是controllers下 
        $arr_post = $public->XssRequest($_REQUEST);
*/
class ReData
{

    protected $id;
    function __construct($id)
    {
        $this->id = $id;
    }
    function XssRequest($content){
        require_once(WEBPATH.'/libs/HTMLPurifier/HTMLPurifier.auto.php');
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.Doctype', 'XHTML 1.0 Transitional');  //html文档类型（常设）
        $config->set('Core.Encoding', 'UTF-8');   //字符编码（常设）
        $purifier = new \HTMLPurifier($config);
        $arr_request = array();
        unset($content['PHPSESSID']);
        if(!empty($content)){
            foreach($content as $k => $v){
                $arr_request[$k] = $purifier->purify($content[$k]);
            }
        }
        return $arr_request;
    }