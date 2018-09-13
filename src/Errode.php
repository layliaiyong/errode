<?php
namespace Lay\Errode;

use Exception;

define('ERRODE_UNKNOWN', '900000|未定义异常(错误：%s,参数：%s)');
define('ERRODE_INVALID_DEFINE', '900001|无效的异常描述(错误：%s,描述：%s,参数：%s)');
define('ERRODE_UNMATCHED_ARGUMENTS', '900002|不匹配的异常参数信息(错误：%s,描述：%s,参数：%s)');

class Errode extends Exception
{
    const UNKNOWN = '900000|未定义异常(类：%s，错误：%s，参数：%s)';
    const INVALID_DEFINE = '900001|无效的异常描述(类：%s，错误：%s,描述：%s,参数：%s)';
    const UNMATCHED_ARGUMENTS = '900002|不匹配的异常参数信息(类：%s，错误：%s,描述：%s,参数：%s)';
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }

    public static function __callStatic($method, $arguments)
    {
        $class = get_called_class();
        if($class != Errode::class) {
            $define = strtoupper($method);
            if(!defined("$class::$define")) {
                return $class::unknown($class, $method, json_encode($arguments));
            } else {
                eval("\$errcode = $class::$define;");
            }
            if(preg_match('/^(\d+)\|(.*)$/', $errcode, $matches) == 0) {
                return $class::invalid_define($class, $method, $errcode, json_encode($arguments));
            }
            list(, $code, $message) = $matches;
            try {
                $args = $arguments;
                array_unshift($args, $message);
                $message = call_user_func_array('sprintf', $args);
                return new $class($message, $code);
            } catch(Exception $e) {
                return $class::unmatched_arguments($class, $method, $message, json_encode($arguments));
            }
        } else {
            $define = 'ERRODE_'.strtoupper($method);
            if(!defined($define)) {
                return static::unknown($method, json_encode($arguments));
            } else {
                eval("\$errcode = $define;");
            }
            if(preg_match('/^(\d+)\|(.*)$/', $errcode, $matches) == 0) {
                return static::invalid_define($method, $errcode, json_encode($arguments));
            }
            list(, $code, $message) = $matches;
            try {
                $args = $arguments;
                array_unshift($args, $message);
                $message = call_user_func_array('sprintf', $args);
                return new static($message, $code);
            } catch(Exception $e) {
                return static::unmatched_arguments($method, $message, json_encode($arguments));
            }
        }
    }
}
