<?php
/**
 * @数字金额转人民币大写
 * Created by PhpStorm.
 * Author: Baykier<1035666345@qq.com>
 * Date: 2017/7/26
 * Time: 17:10
 */
namespace Baykier\Float2rmb;

class Float2rmb
{
    /**
     * @数字对应中文
     * @var array
     */
    protected static $c = array(
        '0' => '零',
        '1' => '壹',
        '2' => '贰',
        '3' => '叁',
        '4' => '肆',
        '5' => '伍',
        '6' => '陆',
        '7' => '柒',
        '8' => '捌',
        '9' => '玖',
    );
    /**
     * @log 对数 字典
     * @var array
     */
    protected static $l = array(
        '-2' => '分',
        '-1' => '角',
        '0' => '元',
        '1' => '拾',
        '2' => '佰',
        '3' => '仟',
        '4' => '万',
        '5' => '拾',
        '6' => '佰',
        '7' => '仟',
        '8' => '亿',
        '9' => '拾',
        '10' => '佰',
        '11' => '仟',
        '12' => '万',
    );
    /**
     * @转换
     * @param $string
     */
    public static function convert($string)
    {
        //检查环境是否符合要求
        self::check();
        $rmb = '';
        $loop = true;
        $base = '0.01';
        while ($loop) {
            $t = bcdiv($string,$base,0);
            if ($t >= 1) {
                $b = substr($t,-1);
                $lS = (int) log10($base);
                if ($b >= 1) {
                    $rmb = self::$c[$b] . self::$l[$lS] . $rmb;
                }
                else
                {
                    if ($lS >= '8') {
                        if (mb_strpos($rmb,'亿') === false) {
                            $rmb = '亿' . $rmb;
                        }
                        //存在 贰亿万这样的情况
                        if(mb_strpos($rmb,'亿万') !== false) {
                            $rmb = str_replace('亿万','亿',$rmb);
                        }
                    }elseif ($lS >= '4') {
                        if (mb_strpos($rmb,'万') === false) {
                            $rmb = '万' . $rmb;
                        }
                    }else {
                        $rmb = (mb_substr($rmb,0,1) == '零') ? $rmb : '零' . $rmb;
                    }
                }
            }else
            {
                $loop = false;
            }
            $base = $base * 10;
        }
        if (mb_substr($rmb,-1) == '零') {
            $rmb = mb_substr($rmb,0,mb_strlen($rmb) -1) . '整';
        }
        return $rmb;
    }

    /**
     * @检查依赖是否安装
     * @return bool
     * @throws \Exception
     */
    protected static function check()
    {
        if (!extension_loaded('bcmath'))
        {
            throw new \Exception('请先安装bcmath扩展');
        }
        if (!extension_loaded('mbstring')) {
            throw new \Exception('请先安装mbstring扩展');
        }
        return true;
    }

}