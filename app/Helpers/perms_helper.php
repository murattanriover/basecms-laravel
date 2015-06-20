<?php
/**
 * Created by PhpStorm.
 * User: murattanriover
 * Date: 1.06.15
 * Time: 21:56
 */

use \Illuminate\Http\Request;
use App\Library\PermsLib;


if( ! function_exists('isperms')) {
    function isperms($url="",$method="get"){
        if (PermsLib::$userperms == false) PermsLib::getPermsListforUser(); // First Call
        $userPerms = PermsLib::$userperms;
        try {
            $route = app()->router->getRoutes()->match(Request::create($url, $method));
            if(!isset($route->getAction()['controller'])) return false;
            $action = str_replace("app\\http\\controllers\\","",strtolower($route->getAction()['controller']));
            $action = explode('@',$action);

            if(isset($userPerms['all___all']) || isset($userPerms[@$action[0] . "___all"]) || isset($userPerms[@$action[0] . "___" . @$action[1]]))
                return true;
            else return false;
        }catch(Exception $message){return false;}
    }
}

if( ! function_exists('permslink')) {
    function permslink($url,$title="",$attr=[],$method="get"){
        if(isperms($url,$method)) return html_entity_decode(link_to($url,$title,$attr));
        else return null;
    }
}

if( ! function_exists('permshtml')) {
    function permshtml($url,$html="",$method="get"){
        if(isperms($url,$method)) return $html;
        else return null;
    }
}