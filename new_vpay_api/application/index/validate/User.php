<?php
/**
 * Created by @Panco.
 * User: @Panco
 * Date: 2017/11/1
 * Time: 15:12
 */

namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    //用户登录验证器
    protected $rule = [
        'account' => 'require',
        'password' => 'require',
        'captcha|验证码' => 'require|captcha'
    ];

    protected $message = [
        'account.require' => '账号不能为空',
        'password.require' => '密码不能为空',
    ];

}