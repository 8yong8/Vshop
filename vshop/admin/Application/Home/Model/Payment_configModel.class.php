<?php 
namespace Home\Model;
use Think\Model;
class Payment_configModel extends CommonModel{

	// �Զ��������
	protected $_auto	 =	 array(
		array('status','1','ADD'),
		array('create_time','time','ADD','function'),
		);
}
?>