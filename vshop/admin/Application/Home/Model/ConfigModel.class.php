<?php 
namespace Home\Model;
use Think\Model;
class ConfigModel extends Model {
	// �Զ���֤����
	protected $_validate	 =	 array(
		array('title','require','������룡',1),
		array('value','require','�������룡',1),
		);
	// �Զ��������
	protected $_auto	 =	 array(
		array('status','1','ADD'),
		array('create_time','time','ADD','function'),
		);


}


?>