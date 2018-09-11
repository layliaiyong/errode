<?php

namespace Lay\Errode\Tests;

use Lay\Errode\Errode;
use PHPUnit\Framework\TestCase;
use stdClass;

define('ERRODE_USER_NOT_FOUND', '用户未找到');

class Tests extends TestCase
{
    public function testErrcode()
    {
        $errode = Errode::user_not_found();
        echo "\n";
        $message = $errode->getMessage();
        $code = $errode->getCode();
        var_dump($message);
        var_dump($code);
        // var_dump($errode->getCode());
        // $this->assertEx
    }
}
