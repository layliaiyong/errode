<?php
namespace Lay\Errode;

use Exception;

define('ERRODE_UNKNOWN', '900000|未知错误');
define('ERRODE_INVALID_DEFINE', '900001|无效的错误描述');
define('ERRODE_UNMATCHED_ARGUMENTS', '900002|不匹配的错误参数信息(错误：%s,描述：%s,参数：%s)');

class Errode extends Exception
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }

    public static function __callStatic($method, $arguments)
    {
        $define = 'ERRODE_'.strtoupper($method);
        if(!defined($define)) {
            if(!defined("static::$define")) {
                $errcode = ERRODE_UNKNOWN;
            } else {
                $errcode = eval("static::$define");
            }
        } else {
            print_r("\$errcode = $define;");exit;
            eval("\$errcode = $define");//$errcode = eval($define);
        }

        if(preg_match('/^(\d+)\|(.*)$/', $errcode, $matches) == 0) {
            $errcode = ERRODE_INVALID_DEFINE;
            $match = preg_match('/^(\d+)\|(.*)$/', $errcode, $matches);
        }
        list(, $code, $message) = $matches;
        try {
            $args = $arguments;
            array_unshift($args, $message);
            $message = call_user_func_array('sprintf', $args);
            return new static($message, $code);
        } catch(Exception $e) {
            throw static::errode_unmatched_arguments($method, $message, json_encode($arguments));
        }
    }
}
