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
class CalendarAction extends BaseAction
{
    public function index()
    {
		//echo date("N",time());exit;
		$n=date("N",time());
		if($n==7) $n=0;
		$t=time();
		$td=array();
		for($x=0;$x<7;$x++){
			$ntt=$x-$n;
			$td[$x]['t']=$t+($ntt*86400);
			$td[$x]['x']=$x;
			$td[$x]['d']=date('j',$td[$x]['t']);
		}
		//dump($td);exit;
		
		$tttmiss=$_GET['tttmiss'];
		if(!$tttmiss) $tttmiss=date(DATE_RFC1123);
		else{
			$n=date("N",$tttmiss);
			$tttmiss=date(DATE_RFC1123,$tttmiss);
		}
		
		$this->assign('lxxqqanmu',$n);
		//echo ;exit;
			$ajax=$_GET['ajax'];
		$kwww=$this->getSafeStr($_GET['k']);
		
		$cid=$_GET['cid']+0;
		global $now_cid_first;
		global $namemark;
		global $foldername;
		global $namemark_tpl;

		$blist=$this->bannerlists(501);
		$getinfolamu=$this->get_column_info(501);$this->assign('getinfolamu',$getinfolamu);
		
		  $lanmu=M('column')->where('bigclass=501')->order('no_order asc,id asc')->select();
		     foreach($lanmu as $kuccc=>&$kuccv){
				$kuccv['foldername']=ucfirst($kuccv['foldername']);
			}
		  $lan=M('column')->where("id=$cid")->find();
		  $news=M('news')->where("class2=$cid")->limit(4)->order('id desc')->select();


       $p=$_GET['p']+0;
		//echo $p;exit;
		$m=5;
		
		if($namemark=='new') $m=4;
		$m=3;
		$m=$lan['listnumber']?$lan['listnumber']:9;
		$cclslss='class2';
		if($cid==501) $cclslss='class1';
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
		$this->assign('td',$td);
		
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
		

		
		$this->assign('getapic',$this->getapic($tttmiss,SHOUJIZHANOKURLIMGTUP));
		$this->assign('news',$news);
		$this->assign('lan',$lan);
		$this->assign('blist',$blist);
        if($ajax=='ajax') $this->display('./GZphp/Tpl/Home/'.SHOUJIZHANOK.'/Trends_ajax.html');
        else $this->display('./GZphp/Tpl/Home/'.SHOUJIZHANOK.'/'.$foldername.'_'.$namemark_tpl.'.html');
    }
	function getapic($tttmiss,$lang){
    

		$url = 'http://www.ausforex.com/data/quotes/init';//POST指向的链接      
		$data = array(      
			'date'=>$tttmiss     
			,'lang'=>$lang 
		);      

		$json_data = $this->postData($url, $data);      
		$ssarray = json_decode($json_data,true);      
		//print_r($array);      
		return $ssarray;
     

		
	}
		function postData($url, $data){      
			$ch = curl_init();      
			$timeout = 300;       
			curl_setopt($ch, CURLOPT_URL, $url);     
			curl_setopt($ch, CURLOPT_REFERER, "http://blog.iswtf.com/");   //构造来路    
			curl_setopt($ch, CURLOPT_POST, true);      
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);      
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);      
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);      
			$handles = curl_exec($ch);      
			curl_close($ch);      
			return $handles;      
		} 
	public function ajax(){
		$cid=$_GET['cid']+0;
		$p=$_GET['p']+0;
		
		global $foldername;
		//listnumber
		$lan=M('column')->where("id=$cid")->find();
		//dump($foldername);exit;
		$m=$lan['listnumber']?$lan['listnumber']:1;
		if($cid==501) $list=$this->new_list('class1',$cid,$p,$m);
		else  $list=$this->new_list('class2',$cid,$p,$m);
		$this->assign('list',$list);
		$this->display('./GZphp/Tpl/Home/'.SHOUJIZHANOK.'/'.$foldername.'_ajax.html');
	}
}