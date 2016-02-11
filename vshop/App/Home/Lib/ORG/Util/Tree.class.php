<?php
/**
* ͨ�õ������࣬���������κ����ͽṹ
*/
class Tree
{
	/**
	* �������ͽṹ����Ҫ��2ά����
	* @var array
	*/
	var $arr = array();

	/**
	* �������ͽṹ�������η��ţ����Ի���ͼƬ
	* @var array
	*/
	var $icon = array('��','��','��');

	/**
	* @access private
	*/
	var $ret = array();

	/**
	* ���캯������ʼ����
	* @param array 2ά���飬���磺
	* array(
	*      1 => array('id'=>'1','parentid'=>0,'name'=>'һ����Ŀһ'),
	*      2 => array('id'=>'2','parentid'=>0,'name'=>'һ����Ŀ��'),
	*      3 => array('id'=>'3','parentid'=>1,'name'=>'������Ŀһ'),
	*      4 => array('id'=>'4','parentid'=>1,'name'=>'������Ŀ��'),
	*      5 => array('id'=>'5','parentid'=>2,'name'=>'������Ŀ��'),
	*      6 => array('id'=>'6','parentid'=>3,'name'=>'������Ŀһ'),
	*      7 => array('id'=>'7','parentid'=>3,'name'=>'������Ŀ��')
	*      )
	*/
	function tree($arr=array())
	{
       $this->arr = $arr;
	   //$this->ret = "";
	   return is_array($arr);
	}

    /**
	* �õ���������
	* @param int
	* @return array
	*/
	function get_parent($myid)
	{
		$newarr = array();
		if(!isset($this->arr[$myid])) return false;
		$pid = $this->arr[$myid]['pid'];
		$pid = $this->arr[$pid]['pid'];
		if(is_array($this->arr))
		{
			foreach($this->arr as $id => $a)
			{
				if($a['pid'] == $pid) $newarr[$id] = $a;
			}
		}
		return $newarr;
	}

    /**
	* �õ��Ӽ�����
	* @param int
	* @return array
	*/
	function get_child($myid)
	{
		$a = $newarr = array();
		if(is_array($this->arr))
		{
			foreach($this->arr as $id => $a)
			{
				if($a['pid'] == $myid) $newarr[$id] = $a;
			}
		}
		return $newarr ? $newarr : false;
	}

    /**
	* �õ���ǰλ������
	* @param int
	* @return array
	*/
	function get_pos($myid,&$newarr)
	{
		$a = array();
		if(!isset($this->arr[$myid])) return false;
        $newarr[] = $this->arr[$myid];
		$pid = $this->arr[$myid]['pid'];
		if(isset($this->arr[$pid]))
		{
		    $this->get_pos($pid,$newarr);
		}
		if(is_array($newarr))
		{
			krsort($newarr);
			foreach($newarr as $v)
			{
				$a[$v['id']] = $v;
			}
		}
		return $a;
	}

    /**
	* �õ����ͽṹ
	* @param int ID����ʾ������ID�µ������Ӽ�
	* @param string �������ͽṹ�Ļ������룬���磺"<option value=\$id \$selected>\$spacer\$name</option>"
	* @param int ��ѡ�е�ID���������������������ʱ����Ҫ�õ�
	* @return string
	*/
	function get_tree($pid,$sid=0,$adds='')
	{
		$number=1;
		$child = $this->get_child($pid);
		if(is_array($child))
		{
		    $total = count($child);
			foreach($child as $id=>$a)
			{  
				$j=$k='';
				if($number==$total){
					$j .= $this->icon[2];
					$child[$key]['name'] = $j. $child[$key]['name'];
				}else{
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				$a['name'] = $adds ? $adds.$j.$a['name'] : ''.$a['name'];
				@extract($a);
				$array = $this->ret;
				$array[] = $a;
				$this->ret = $array;
				$this->get_tree($id,$sid,$adds.$k.'&nbsp;');
				$number++;
			}
		}
		return $this->ret;
	}
}
?>