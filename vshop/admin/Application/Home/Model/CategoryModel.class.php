<?php 
namespace Home\Model;
use Think\Model;
class CategoryModel extends CommonModel {

	// �����Զ�д��͸��µ�ʱ����ֶ�
	protected $autoCreateTimestamps = array('create_time');
	protected $autoUpdateTimestamps = array('update_time');
	// �Զ���֤����
	protected $_validate	 =	 array(
		array('title','require','������룡'),
		array('email','email','�����ʽ����',2),
		array('content','require','���ݱ���'),
		array('verify','require','��֤����룡'),
		array('verify','CheckVerify','��֤�����',0,'callback'),
		array('title','','�����Ѿ�����',0,'unique','add'),
		);
	// �Զ��������
	protected $_auto	 =	 array(
		array('status','1','ADD'),
		);

	public function CheckVerify() {
		return md5($_POST['verify']) == $_SESSION['verify'];
	}
}
?>