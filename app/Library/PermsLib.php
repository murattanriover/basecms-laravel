<?php
/**
 * Created by PhpStorm.
 * User: murattanriover
 * Date: 20.06.15
 * Time: 18:12
 */
namespace App\Library;

use App\Model\GroupPerms;

class PermsLib {
    public static $userperms = false;

    // get perms controller and method list for user
    public static function getPermsListforUser(){
        if(auth()->check() && isset(auth()->user()->id)){
            $perms = GroupPerms::
            join('users', function($join) {$join->on('users.id', '=', \DB::RAW(auth()->user()->id))->where('users.status','>',0);})->
            join('user_group', 'user_group.user_id', '=', 'users.id')->
            join('groups', function($join) {$join->on('groups.id', '=','user_group.group_id')->where('groups.status','>',0);})->
            select(['controller','action'])->
            where('group_perms.group_id','=',\DB::RAW('groups.id'))->get();

            self::$userperms = [];
            foreach ($perms as $key=>$p) {
                $controller = (is_null($p->controller)) ? "all" : $p->controller;
                $method     = (is_null($p->action)) ? "all" : $p->action;
                self::$userperms[$controller."___".$method] = true;
            }
        }
        else self::$userperms = [];
    }

    public static function isPermControl($controller=null,$action=null){
        $sql = '
            SELECT ug.user_id FROM user_group as ug
              JOIN group_perms AS gp ON
                (
                    gp.group_id=ug.group_id AND
                    (gp.controller=? OR gp.controller IS NULL) AND
                    (gp.controller IS NULL OR (gp.action=? OR gp.action IS NULL) )
                )
                JOIN groups AS g ON g.id=ug.group_id AND g.status>0
            WHERE ug.user_id=' . (int)auth()->user()->id;
        $perm = \DB::select($sql,[$controller,$action]);
        if (count($perm) < 1) return false; else return true;
    }

    public static function getControllerMethod($route_uses=null){
        return explode('@',str_replace("app\\http\\controllers\\","",strtolower($route_uses)));
    }

    // get controller files in /App/Http/Controlllers/ Folder
    public static function mapSystemClasses($controllerdir,$onlypublic=true) {
        if($controllerdir==null) $controllerdir = app_path().'/Http/Controllers/'; // Controllers path
        $result=array();
        $dh=opendir($controllerdir);
        while (($file = readdir($dh)) !== false) {
            if (substr($file,0,1)!=".") {
                if (filetype($controllerdir.$file)=="file") {
                    $classes=self::file_get_php_classes($controllerdir.$file,$onlypublic);
                    foreach($classes['methods'] as $class=>$method) {
                        $result[]=array("file"=>$controllerdir.$file,"class"=>$class,"namespace"=>$classes['namespace'],"method"=>$method);
                    }
                } else {
                    $result=array_merge($result,self::mapSystemClasses($controllerdir.$file."/",$onlypublic));
                }
            }
        }
        closedir($dh);
        return $result;
    }

    private static function file_get_php_classes($filepath,$onlypublic=true) {
        $php_code = file_get_contents($filepath);
        return self::get_php_classes($php_code,$onlypublic);
    }

    private static function  get_php_classes($php_code,$onlypublic) {
        $methods=array();
        $namespace = "";
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i-2][0] === T_NAMESPACE) {
                for ($j=$i+1;$j<count($tokens); $j++) {
                    if ($tokens[$j][0] === T_STRING) $namespace .= '\\'.$tokens[$j][1];
                    else if ($tokens[$j] === '{' || $tokens[$j] === ';') break;
                }
                $namespace = str_replace("\\Http\\Controllers","",$namespace);
                $namespace = ltrim($namespace,"\\");
            }
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $class_name = $tokens[$i][1];
                $methods[$class_name] = [];
            }
            if ($tokens[$i - 2][0] == T_FUNCTION && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                if ($onlypublic) {
                    if ( !in_array($tokens[$i-4][0],array(T_PROTECTED, T_PRIVATE))) {
                        $method_name = $tokens[$i][1];
                        $methods[$class_name][] = $method_name;
                    }
                } else {
                    $method_name = $tokens[$i][1];
                    $methods[$class_name][] = $method_name;
                }
            }
        };
        return ['namespace'=>$namespace,'methods'=>$methods];
    }
}