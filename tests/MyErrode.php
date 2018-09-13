<?php

namespace Lay\Errode\Tests;

use Lay\Errode\Errode;
use PHPUnit\Framework\TestCase;
use stdClass;

class MyErrode extends Errode
{
	const MY_INVALID_DEFINE = '我的异常描述错误';
	const MY_NOT_FOUND = '101001|我的未找到';
	const MY_NOT_FOUND_PARAM = '101002|我的未找到有参数(%d)';
}
