<?php

namespace Lay\Errode\Tests;

use Lay\Errode\Errode;
use PHPUnit\Framework\TestCase;
use stdClass;

define('ERRODE_TEST_INVALID_DEFINE', '异常描述错误');
define('ERRODE_TEST_NOT_FOUND', '100001|未找到');
define('ERRODE_TEST_NOT_FOUND_PARAM', '100002|未找到有参数(%d)');

class Tests extends TestCase
{
    public function testErrodeUnknown()
    {
        $errode = Errode::test_not_define('foo');
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testErrodeInvalidDefine()
    {
        $errode = Errode::test_invalid_define();
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testErrode()
    {
        $errode = Errode::test_not_found();
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testErrodeNoParam()
    {
        $errode = Errode::test_not_found_param();
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testErrodeParam()
    {
        $errode = Errode::test_not_found_param(1000);
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testMyErrodeUnknown()
    {
        $errode = MyErrode::my_not_define('bar');
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testMyErrodeInvalidDefine()
    {
        $errode = MyErrode::my_invalid_define();
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testMyErrode()
    {
        $errode = MyErrode::my_not_found();
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testMyErrodeNoParam()
    {
        $errode = MyErrode::my_not_found_param();
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
    public function testMyErrodeParam()
    {
        $errode = MyErrode::my_not_found_param(2000);
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
    }
}
