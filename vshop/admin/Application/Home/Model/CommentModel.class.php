<?php 
namespace Home\Model;
use Think\Model;
class CommentModel extends CommonModel{

	// �Զ��������
	protected $_auto	 =	 array(
		array('status','1','ADD'),
		array('create_time','time','ADD','function'),
		);
}
?>