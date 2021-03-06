<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function md5()
    {
        echo "接收端>>>>"; echo '</br>';
        echo '<pre>';print_r($_GET);echo '</pre>';

        $key = "1998";          // 计算签名的KEY 与发送端保持一致

        //验签
        $data = $_GET['data'];  //接收到的数据
        $signature = $_GET['signature'];    //发送端的签名

        // 计算签名
        echo "接收到的签名：". $signature;echo '</br>';
        $s = md5($data.$key);
        echo '接收端计算的签名：'. $s;echo '</br>';

        //与接收到的签名 比对
        if($s == $signature)
        {
            echo "验签通过";
        }else{
            echo "验签失败";
        }

//        echo '11122222';
    }

    public function check1()
    {

        $key = "1998";      // 计算签名的key 与发送端 保持一致

        echo '<pre>';print_r($_POST);
        //接收数据 和 签名
        $json_data = $_POST['data'];
        $sign = $_POST['sign'];

        //计算签名
        $sign2 = md5($json_data.$key);
        echo "接收端计算的签名：".$sign2;echo "<br>";

        // 比较接收到的签名
        if($sign2==$sign){
            echo "验签成功";
        }else{
            echo "验签失败";
        }


    }

    public function Check2()
    {
        echo '<pre>';print_r($_GET);echo '</pre>';
        $data=$_GET['qian'];
        $sign=$_GET['sign'];

        $sign_str=base64_decode($sign);
        echo "base64_decode后的数据 ：".$sign_str;echo '</br>';

        //验签
        $path=storage_path('keys/pubkey2');
        $pkeyid=openssl_pkey_get_public("file://".$path);

        $d=openssl_verify($data,$sign_str,$pkeyid);
        openssl_free_key($pkeyid);
        if($d==1){
            echo "验签成功";
        }else{
            echo "验签失败";
        }

    }

    public function decrypt()
    {
        $data = base64_decode($_GET['data']);
        $method = 'AES-256-CBC';
        $key = 'wang';
        $iv = 'WUSD8796IDjhkchd';

        //解密
        $dec_data = openssl_decrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "解密数据：" . $dec_data;

    }

    public function rsadescypt()
    {
        $enc_data_str = $_GET['data'];

        echo "接收到的密文：". $enc_data_str;echo '</br>';
        $base64_decode_str = base64_decode($enc_data_str);
        echo '<hr>';
        //解密
        $pub_key = file_get_contents(storage_path('keys/app_pub'));
        openssl_public_decrypt($base64_decode_str,$dec_data,$pub_key);
        echo "解密数据：" . $dec_data;
    }


}
