<?php

namespace App\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CaptController extends Controller
{
    public function captchaShow(){
        $phraseBuilder  =  new  PhraseBuilder(4,  'abcdefghjkmnpqrstuvwxy123456789ABCDEFGHJKMNPQRSTUVWXY');  //自定义验证码长度和内容
        //生成验证码图片的Builder对象，配置相应属性
        $builder  =  new  CaptchaBuilder(null,  $phraseBuilder);
        //  设置背景颜色
        $builder->setBackgroundColor(220,  210,  230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(2);
        $builder->setMaxFrontLines(2);
        //可以设置图片宽高及字体
        $builder->build($width  =  100,  $height  =  40,  $font  =  null);
        //获取验证码的内容,并转化为小写
        $phrase  =  strtolower($builder->getPhrase());
        //把内容存入session
        //session(['phrase'  =>  $phrase]);
        Session::put('phrase',  $phrase);
        //生成图片
        header("Cache-Control:  no-cache,  must-revalidate");
        header('Content-Type:  image/jpeg');
        $builder->output();
    }
}