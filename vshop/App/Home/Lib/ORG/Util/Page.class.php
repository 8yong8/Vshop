<?php
//+---------------------------------------------------------------------
// | Author: zzy <8yong8@163.com>
// | Name :��ҳ��ʾ 
//+---------------------------------------------------------------------
class Page{
  protected $all_page;    //��ҳ��
  protected $nonce_page;  //��ǰҳ
  public $url;         //URL��ַ
  public $parameter;      //ҳ����תʱҪ���Ĳ���
  public $listRows;       //�б�ÿҳ��ʾ����
  public $firstRow;       //��ҳ��ʼ����
  public $style = 'digg'; //��ҳ��ʽ digg,yahoo,meneame,flickr,sabrosus,scott,quotes,black,black2,black-red,grayr,yellow,jogger,starcraft2,tres,megas512,technorati,youtube,msdn,badoo,manu,green-black,viciao,yahoo2
  public $current = 'current';//��ҳ��ʽ
  public $last = '';//����������
  protected $totalRows;   //������


  function __construct($totalRows,$listRows='',$parameter=''){
	 $this->parameter = $parameter;
     $this->totalRows = $totalRows;
     $this->listRows = !empty($listRows)?$listRows:C('LIST_NUMBERS');
     $this->all_page = ceil($this->totalRows/$this->listRows);     //��ҳ��
     $this->nonce_page = !empty($_GET[C('VAR_PAGE')])&&($_GET[C('VAR_PAGE')] >0)?$_GET[C('VAR_PAGE')]:1;//��ҳ

     $this->url = $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
	 $p = C('VAR_PAGE');
	 $parse = parse_url($this->url);
	 if(isset($parse['query'])) {
		parse_str($parse['query'],$params);
		unset($params[$p]);
		$this->url   =  $parse['path'].'?'.http_build_query($params);
	 }
     if(!empty($this->all_page) && $this->nonce_page>$this->all_page) {
          $this->nonce_page = $this->all_page;
	   }
     $this->firstRow = $this->listRows*($this->nonce_page-1);
   }

/**
 * ��DZ��ҳģʽ
 * ��ҳ����ҳ
 * �м�10ҳ����ҳǰ2ҳ+��ҳ+��ҳ��7ҳ
 * βҳ����ҳ
 */
 function Show(){
   if($this->all_page<1){ 
	 return $this->all_page_null();
	}
   if(0<$this->all_page && $this->all_page<=10){ 
     return $this->all_page_small();
	}
   if($this->all_page > 10){
     return $this->all_page_big();
   }	 
  }
//��ҳ��Ϊ��
  function all_page_null(){
    return $this->fenye = "";
  }

//��ҳ��С��10
  function all_page_small(){
    $fenye="<div class='".$this->style."'>";
    if($this->nonce_page>1){
		$fenye.="<a href =".$this->url."&".C('VAR_PAGE')."=".($this->nonce_page-1)."> << </a>";
		}
	for($i=1;$i<=$this->all_page;$i++){
		if($this->nonce_page == $i){ 
			$fenye.= "<span class='".$this->current."'>".$i."</span>\n";
					  }else{
             $fenye.= "<a href=".$this->url."&".C('VAR_PAGE')."=".$i.">".$i."</a>\n";
			 }
		}
	if($this->nonce_page!= $this->all_page){
		$fenye.= "<a href=".$this->url."&".C('VAR_PAGE')."=".($this->nonce_page+1).">>></a>";
		}
	$fenye .= $this->last;
    $fenye .= "</div>";
    return $fenye;
  }

//��ҳ������10
  function all_page_big(){
		 $i=0;$kk=0;$fenye="<div class='".$this->style."'>";  
		 if($this->nonce_page>2){  //��ҳ����2�ӱ�ҳǰ2ҳ��ʼѭ��
			 $i=$this->nonce_page-2;
			 }else{
				 $i=1;
				 }
		 if($this->nonce_page+7<$this->all_page){ //��ҳ+7С����ҳ����ѭ��7��
			 $kk=$this->nonce_page+7;
			 }else{
				 $kk=$this->all_page;             //ѭ������ҳ��
				 }
	     if($this->nonce_page==1){   //��ҳ����1��ѭ��10��
			 $kk=10;
			 }
        if($this->nonce_page<=3 && 1<$this->nonce_page){
	   $fenye.="<a href=".$this->url."&".C('VAR_PAGE')."=".($this->nonce_page-1)."><<</a>\n";
	   $kk=10;
	   }
        if($this->nonce_page>3 && $this->nonce_page<=$this->all_page){
	   $fenye.="<a href=".$this->url."&".C('VAR_PAGE')."=1>1..</a>\n<a href=".$this->url."&".C('VAR_PAGE')."=".($this->nonce_page-1)."><<</a>\n";
	   }
        if($this->nonce_page>=$this->all_page-7){
	$i=$this->all_page-9;
	$kk=$this->all_page;
	}
        for($i;$i<=$kk;$i++){
		 if($this->nonce_page==$i){ 
		 $fenye.= "<span class='".$this->current."'>".$i."</span>\n";}
                 else{
                 $fenye.= "<a href=".$this->url."&".C('VAR_PAGE')."=$i>$i</a>\n";}
		 }
        if($this->nonce_page>=$this->all_page-7 && $this->nonce_page!=$this->all_page){
	$fenye.="<a href=".$this->url."&".C('VAR_PAGE')."=".($this->nonce_page+1).">>></a>\n";
	}
	if($this->all_page-7>$this->nonce_page){
	  $fenye.="<a href=".$this->url."&".C('VAR_PAGE')."=".($this->nonce_page+1).">>></a>\n<a href=".$this->url."&".C('VAR_PAGE')."=".$this->all_page.">..".$this->all_page."</a>\n";
	  }
	$fenye .= '��'.$this->all_page.'ҳ/'.$this->totalRows.'��';
	$fenye .= $this->last;
	$fenye .= "</div>";   
    return $fenye;
  }

/**
 *����ʽ��ҳģʽ
 *�ʺ�ҳ������ҳ��
 */
 function OutSelect(){
   $fenye .="<script language=javascript>";
   $fenye .="function gopage(){
          var aa=document.getElementById('fenye').selectedIndex+1;
          window.location.href='{$this->url}&page='+aa;
		  }";
   $fenye .= "</script>";
   $fenye .= "<select onchange='gopage()' id='fenye' style='width:50px'>";
   for($i=1;$i<=$this->all_page;$i++){
	if($i==$this->nonce_page){
	$fenye .= "<option value={$i} selected='selected'>{$i}</option>";
	}else{
    $fenye .= "<option value={$i}>{$i}</option>";
	}
   }
  $this->fenye = $fenye;
 }

}
?>