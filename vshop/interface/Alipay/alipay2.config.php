<?php
/* *
 * �����ļ�
 * �汾��3.3
 * ���ڣ�2012-07-19
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���
	
 * ��ʾ����λ�ȡ��ȫУ����ͺ��������id
 * 1.������ǩԼ֧�����˺ŵ�¼֧������վ(www.alipay.com)
 * 2.������̼ҷ���(https://b.alipay.com/order/myorder.htm)
 * 3.�������ѯ���������(pid)��������ѯ��ȫУ����(key)��
	
 * ��ȫУ����鿴ʱ������֧�������ҳ��ʻ�ɫ��������ô�죿
 * ���������
 * 1�������������ã������������������������
 * 2���������������ԣ����µ�¼��ѯ��
 */
 
//�����������������������������������Ļ�����Ϣ������������������������������
//���������id����2088��ͷ��16λ������
//$alipay_config['partner']		= '2088411854918234';
$alipay_config['partner']		= '2088411553531200';
//��ȫ�����룬�����ֺ���ĸ��ɵ�32λ�ַ�
//$alipay_config['key']			= '8axuw32aizap0pa3w0n74z38jjti4dny';
$alipay_config['key']			= '9mzf5xxuxq2hjlytfawqer96c5juve6y';

//�����������������������������������Ļ�����Ϣ������������������������������


//ǩ����ʽ �����޸�
$alipay_config['sign_type']    = strtoupper('MD5');

//�ַ������ʽ Ŀǰ֧�� gbk �� utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//ca֤��·����ַ������curl��sslУ��
//�뱣֤cacert.pem�ļ��ڵ�ǰ�ļ���Ŀ¼��
//$alipay_config['cacert']    = getcwd().'\\cacert.pem';
$alipay_config['cacert']    = '../cacert.pem';
//����ģʽ,�����Լ��ķ������Ƿ�֧��ssl���ʣ���֧����ѡ��https������֧����ѡ��http
$alipay_config['transport']    = 'http';

//֧�����˺�
//$seller_email = '271548517@qq.com';
$seller_email = 'candy@sunnybeauty-china.com';
//�������첽֪ͨҳ��·��
//$notify_url = "http://weixin.guoji.biz/oupai/obj/Alipay/notify_url.php";
$notify_url = 'http://oupai.w20.guoji.biz/index.php/Ali_Payment';
//$notify_url = "http://192.168.2.185/guoji/oupai/obj/member/index.php/Payment/ali_notify";
//��http://��ʽ������·�������ܼ�?id=123�����Զ������
//ҳ����תͬ��֪ͨҳ��·��
//$return_url = "http://sh.eejuimg.com/zhifu/record_list.php";
$return_url = 'http://192.168.2.185/guoji/oupai/obj/index.php/Ali_Payment/ali_return';
//$return_url = "http://192.168.2.185/guoji/oupai/obj/member/index.php/Public/ali_notify";
?>