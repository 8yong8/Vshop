<?php 
$config['appid'] ='201514446448906596';
$config['appkey'] = 'TgjPeys33wGE6YeSNatbNTKHcRWsWn5D';
$config['sign_type'] = strtoupper('RSA'); //MD5��RSA
$config['gateway'] = 'http://localhost/guoji/yunwang/BaseApi/?'; //���ص�ַ
//˽Կ����׺��.pem���ļ����·��
$config['private_key_path']	= dirname(__FILE__).'/key/my_rsa_private_key.pem';
//��Կ����׺��.pem���ļ����·��
$config['public_key_path'] = dirname(__FILE__).'/key/my_rsa_public_key.pem';
$config['input_charset'] = strtolower('utf-8');
$config['transport'] ='http';
$config['version'] = '1.0';
?>