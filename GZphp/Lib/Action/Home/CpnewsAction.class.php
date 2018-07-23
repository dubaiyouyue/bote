<?php
/**
 * 
 * IndexAction.class.php (前台首页)
 *
 * @package      	GZPHP
 * @author          wen QQ:52009619 <admin@resonance.com.cn>
 * @copyright     	Copyright (c) 2008-2011  (http://www.resonance.com.cn)
 * @license         http://www.resonance.com.cn/license.txt
 * @version        	GzPHP企业网站管理系统 v2.1 2011-03-01 resonance.com.cn $
 */
if(!defined("GZPHP")) exit("Access Denied"); 
class CpnewsAction extends BaseAction
{
    public function index()
    {
			$ajax=$_GET['ajax'];
		$kwww=$this->getSafeStr($_GET['k']);
		
		$cid=$_GET['cid']+0;
		global $now_cid_first;
		global $namemark;
		global $foldername;
		global $location_two_id;
		global $namemark_tpl;

		$blist=$this->bannerlists(523);
		$getinfolamu=$this->get_column_info(523);$this->assign('getinfolamu',$getinfolamu);
		
		  $lanmu=M('column')->where('bigclass=523')->order('no_order asc,id asc')->select();
		  $lanmuff=M('column')->where('bigclass='.$location_two_id)->order('no_order asc,id asc')->select();
		     foreach($lanmu as $kuccc=>&$kuccv){
				$kuccv['foldername']=ucfirst($kuccv['foldername']);
			} foreach($lanmuff as $kuccc=>&$kuccv){
				$kuccv['foldername']=ucfirst($kuccv['foldername']);
			}
		  $lan=M('column')->where("id=$cid")->find();
		  $news=M('news')->where("class2=$cid")->limit(4)->order('id desc')->select();

			
       $p=$_GET['p']+0;
		//echo $p;exit;
		$m=5;
		
		if($namemark=='new') $m=4;
		$m=3;
		$m=$lan['listnumber']?$lan['listnumber']:30;
		$cclslss='class2';
		if($cid==523) $cclslss='class1';
			$cclslss='class1';
		$list=$this->new_list($cclslss,$cid,$p,$m,0,$kwww);
		if(empty($list) && $ajax=='ajax') exit;
		$this->assign('list',$list);
		$this->assign('kwww',$kwww);
		//print_r($list);exit;
		$now_lanmu=$this->get_column_info($cid);
		$this->assign('now_lanmu',$now_lanmu);
		
		$allpage=$this->Pagenewinfo($cclslss,$cid,0,$k);
		$allpage=ceil($allpage/$m);
		
		//上一页
		$sp=$p-1;
		if($sp<1) $sp=1;
		//下一页
		$np=$p+1;
		if($np<2) $np=2;
		if($np>$allpage) $np=$allpage;
		
		$this->assign('sp',$sp);
		$this->assign('np',$np);
		
		//$list=$this->new_list('class2',$cid,$p,$m,0);
		//$this->assign('list',$list);
		//print_r($now_cid_first);exit();
		//print_r($new_column_list_top);exit();
		//print_r($news);exit();
      //	print_r($list);exit();

		//dump($list);exit;
		//$this->assign('ishome','home');namemark_tpl
		$this->assign('p',$p);
		$this->assign('allpage',$allpage);
		$this->assign('lanmu',$lanmu);
		$this->assign('lanmuff',$lanmuff);
		$this->assign('news',$news);
		$this->assign('lan',$lan);
		$this->assign('blist',$blist);
        if($ajax=='ajax') $this->display('./GZphp/Tpl/Home/'.SHOUJIZHANOK.'/Trends_ajax.html');
        else $this->display('./GZphp/Tpl/Home/'.SHOUJIZHANOK.'/'.$foldername.'_'.$namemark_tpl.'.html');
    }
	public function ajax(){
		$cid=$_GET['cid']+0;
		$p=$_GET['p']+0;
		
		global $foldername;
		//listnumber
		$lan=M('column')->where("id=$cid")->find();
		//dump($foldername);exit;
		$m=$lan['listnumber']?$lan['listnumber']:1;
		if($cid==523) $list=$this->new_list('class1',$cid,$p,$m);
		else  $list=$this->new_list('class2',$cid,$p,$m);
		$this->assign('list',$list);
		$this->display('./GZphp/Tpl/Home/'.SHOUJIZHANOK.'/'.$foldername.'_ajax.html');
	}
}