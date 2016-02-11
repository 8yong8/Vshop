<?php
namespace Home\Controller;
use Think\Controller;
class PicController extends CommonController {

  /**
   * �б���Ϣ
   */
  public function index(){
	$name = CONTROLLER_NAME;
    $model = D($name);
	$map = $this->_search ();
	//��ҳ��ѯ����
	if($_GET['projectname']){
	  $map['137_designer_project.name'] = $_GET['projectname'];
	  $this->assign('albumname',$_GET['albumname']);
	}
	if($_GET['uid']){
	  $map['137_pic.uid'] = $_GET['uid'];
	  $this->assign('uid',$_GET['uid']);
	}
	if($_GET['username']){
	  $map['137_pic.username'] = $_GET['username'];
	  $this->assign('username',$_GET['username']);
	}
	$count = $model->join('137_designer_project on 137_pic.albumid=137_designer_project.albumid')->where ( $map )->count ( 'picid' );
	if ($count > 0) {
		if (isset ( $_REQUEST ['_order'] )) {
			$order = $_REQUEST ['_order'];
		} else {
			$order = ! empty ( $sortBy ) ? $sortBy : 'picid';
		}
		//����ʽĬ�ϰ��յ�������
		//���� sost���� 0 ��ʾ���� ��0�� ��ʾ����
		if (isset ( $_REQUEST ['_sort'] )) {
			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
		} else {
			$sort = $asc ? 'asc' : 'desc';
		}
		//������ҳ����
		if (! empty ( $_REQUEST ['listRows'] )) {
			$listRows = $_REQUEST ['listRows'];
		} else {
			$listRows = '20';
		}
		$p = new \My\Page ( $count, $listRows );
		$voList = $model->join('137_designer_project on 137_pic.albumid=137_designer_project.albumid')->where($map)->order( "`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->findAll();
		//echo $model->getlastsql();
		//��ҳ��ת��ʱ��֤��ѯ����
		foreach ( $map as $key => $val ) {
			if (! is_array ( $val )) {
				$p->parameter .= "$key=" . urlencode ( $val ) . "&";
			}
		}
		//��ҳ��ʾ
		$page = $p->show ();
		//�б�������ʾ
		$sortImg = $sort; //����ͼ��
		$sortAlt = $sort == 'desc' ? '��������' : '��������'; //������ʾ
		$sort = $sort == 'desc' ? 1 : 0; //����ʽ
		//ģ�帳ֵ��ʾ
		$this->assign ( 'list', $voList );
		$this->assign ( 'sort', $sort );
		$this->assign ( 'order', $order );
		$this->assign ( 'sortImg', $sortImg );
		$this->assign ( 'sortType', $sortAlt );
		$this->assign ( "page", $page );
	}
	cookie( '_currentUrl_', __SELF__ );
	$this->display();	
  }

  /**
   * ɾ��
   */
  function foreverdelete(){
	//ɾ��ָ����¼
	$name=CONTROLLER_NAME;
	$model = D ($name);
	$this->assign('jumpUrl',__APP__.'/'.$name);
	if (! empty ( $model )) {
		$pk = $model->getPk ();
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
			$condition = array ($pk => array ('in', explode ( ',', $id ) ) );
			$list = $model->where($condition)->findall();
			foreach($list as $val){
			  unlink($val['filepath']);
			}
			if (false !== $model->where ( $condition )->delete ()) {
				$this->success ('ɾ���ɹ���');
			} else {
				$this->error ('ɾ��ʧ�ܣ�');
			}
		} else {
			$this->error ( '�Ƿ�����' );
		}
	}
	$this->forward ();  
  }

}
?>