<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
//AES解密
    function decrypt1($encryptStr) {
        $localIV = "1067466678061269";
        $encryptKey = "MaiZ4mRoH5fL5AcU";
        $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, $localIV);
       // dump($module);
        //
        mcrypt_generic_init($module, $encryptKey, $localIV);
        $encryptedData = base64_decode($encryptStr);
        //dump($encryptedData);
        //dump($module);exit;
        $encryptedData = mdecrypt_generic($module, $encryptedData);
        $encryptedData= str_replace(array(""," ","","","","","","","","","",""," "," "),"",$encryptedData);
        $encryptedData= trim($encryptedData);
        return $encryptedData;
    }

    //加密
    function encrypt1($encryptStr) {
        $localIV = '1067466678061269';
        $encryptKey = 'MaiZ4mRoH5fL5AcU';
        $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, $localIV);
        mcrypt_generic_init($module, $encryptKey, $localIV);
        $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $pad = $block - (strlen($encryptStr) % $block); //Compute how many characters need to pad
        $encryptStr .= str_repeat(chr($pad), $pad); // After pad, the str length must be equal to block or its integer multiples
        $encrypted = mcrypt_generic($module, $encryptStr);
        mcrypt_generic_deinit($module);
        mcrypt_module_close($module);
        return base64_encode($encrypted);
    }
    function delHtml($str){
        //去除全部的空格
        $str = preg_replace('/\s*/', '',$str); 
        //去除空格
        $str = strip_tags($str);
        return $str;
    }
    function delS($str){
        $str = preg_replace('/\s*/', '',$str); 
        return $str;
    }
    function code($length = 4) {
    $min = pow(10 , ($length - 1));
    $max = pow(10, $length) - 1;
    return rand($min, $max);
}