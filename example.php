<?php
/**
 * Created by PhpStorm.
 * Author: Baykier<1035666345@qq.com>
 * Date: 2017/7/26
 * Time: 17:44
 */
use Baykier\Float2rmb\Float2rmb;

require_once __DIR__ . '/vendor/autoload.php';

$n = '2000000000003.98';
echo PHP_EOL;
echo $n;
echo PHP_EOL;
echo Float2rmb::convert($n);
echo PHP_EOL;