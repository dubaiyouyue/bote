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
class LearningAction extends BaseAction
{
    public function index()
    {
		$cid=$_GET['cid']+0;
		global $now_cid_first;
		global $namemark;
		global $foldername;
		global $location_two_id;
		global $namemark_tpl;
		$blist=$this->bannerlists(486);
		$getinfolamu=$this->get_column_info(486);$this->assign('getinfolamu',$getinfolamu);
		//dump($getinfolamu);exit;
		   $lanmu=M('column')->where('bigclass=486')->order('no_order asc,id asc')->select();
			$lanmuff=M('column')->where('bigclass='.$location_two_id)->order('no_order asc,id asc')->select();
		  /*  $news=M('news')->where("class1=486")->select();
		  
		   
		   foreach($news as $ck=>$cv){
					foreach($lanmu as $pk=>&$pv){
						if($pv['id']==$cv['class2']){
							
							$pv['imgurl']=$cv['imgurl'];
							
						}
					}
				}			 */
		    
		   
		  foreach($lanmu as $kuccc=>&$kuccv){
				$kuccv['foldername']=ucfirst($kuccv['foldername']);
			}  
		  foreach($lanmuff as $kuccc=>&$kuccv){
				$kuccv['foldername']=ucfirst($kuccv['foldername']);
			} 
			
			
		    $lan=M('column')->where("id=$cid")->find();
		    $lanfffcc=M('column')->where("id=$location_two_id")->find();
//dump($lan);exit;
		    $introduce=M('news')->where("class2=$cid")->order('id desc')->find();

		
		
		if($now_cid_first==$cid){
			//一级栏目
			$newlist=$this->new_page_info('131,132,133,134');
			foreach($newlist as $k=>$v){
				$new_list[$v['id']]=$v;
			}
			$this->assign('newlist',$new_list);
		}else{
			$newlist=$this->new_page_info($cid);
			$this->assign('newlist',$newlist);
		}
		
		
		//dump($newlist);exit();
		
		$this->assign('blist',$blist);
		$this->assign('introduce',$introduce);
		$this->assign('lanmu',$lanmu);
		$this->assign('lanmuff',$lanmuff);
		$this->assign('lan',$lan);
		$this->assign('lanfffcc',$lanfffcc);
        $this->display('./GZphp/Tpl/Home/'.SHOUJIZHANOK.'/'.$foldername.'_'.$namemark_tpl.'.html');
    }
}
?>