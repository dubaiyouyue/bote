<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.resonance.com.cn). All rights reserved. 
require_once '../login/login_check.php';
$css_url="../templates/".$gz_skin."/css";
$img_url="../templates/".$gz_skin."/images";
if($action=='modify'){
	require_once $depth.'../include/config.php';
	die;
}
/*一级栏目处理*/
foreach($gz_class1 as $key=>$val){
	$purview='admin_popc'.$val['id'];
	$purview=$$purview;
	$metcmspr=$metinfo_admin_pop=="metinfo" || $purview=='metinfo'?1:0;
	$metcmspr1=$val[classtype]==1 || $val[releclass]?1:0;
	$metcmspr=$metcmspr1?$metcmspr:1;
	$val['name']=str_replace('"', '&#34;', str_replace("'", '&#39;',$val['name']));
	if($metcmspr){
		$val['modulename']=module($val['module']);
		$classnow1=count($gz_class2[$val['id']]);
		if($val['module']<6 && $val['if_in']!=1){
			$val['addclass']="<div><a href='add.php?anyid={$anyid}&lang={$lang}&id={$val[id]}&type=2&action=add' onclick=\"return addcolumn($(this),'$val[id]',2);\">{$lang_columnnew2}</a></div>";
		}
		$val['openclass']="<div style='width:22px; height:10px; overflow:hidden; float:left;'></div>";
		if($classnow1){
			$val['openclass']="
			<img src='$img_url/colum1nx.gif' class='columnimg' id='img_$val[id]' onclick=\"oncolumn($(this),'$val[id]');\" />";
		}
		if($val['if_in']&&$val['module']<1000)$val['foldername']=$val['out_url'];
		$val['navpotion']='';
		for($u=0;$u<4;$u++){
			$navtypes = navdisplay($u);
			$navselect = $u == $val['nav']?"selected='selected'":'';
			$val['navpotion'].= "<option value='{$u}' {$navselect}>{$navtypes}</option>";
		}
		/*二级栏目处理*/
		foreach($gz_class2[$val['id']] as $key=>$val2){
			$metcmspr2=1;
			if($val2[releclass]){
				$purview2='admin_popc'.$val2['id'];
				$purview2=$$purview2;
				$metcmspr2=$metinfo_admin_pop=="metinfo" || $purview2=='metinfo'?1:0;
			}
			if($metcmspr2==1){
				$val2['name']=str_replace('"', '&#34;', str_replace("'", '&#39;',$val2['name']));
				$val2['modulename']=module($val2['module']);
				$classnow2=count($gz_class3[$val2['id']]);
				if($val2['module']<6 && $val2['if_in']!=1){
					$val2['addclass']="<div><a href='add.php?anyid={$anyid}&lang=$lang&id=$val2[id]&type=3&action=add' onclick=\"return addcolumn($(this),'{$val2[id]}',3);\">{$lang_columnnew3}</a></div>";
				}
				$val2['openclass']='';
				if($classnow2){
					$val2['openclass']="<img src='{$img_url}/colum1nx.gif' class='columnimg' id='img_{$val2[id]}' style='margin:0px;' onclick=\"oncolumn($(this),'{$val2[id]}');\" />";
				}
				$val2['navpotion']='';
				for($u=0;$u<4;$u++){
					$navtypes = navdisplay($u);
					$navselect = $u == $val2['nav']?"selected='selected'":'';
					$val2['navpotion'].= "<option value='{$u}' {$navselect}>{$navtypes}</option>";
				}
				$val2['imgxurl'] = $classnow2?'bg_columnx.gif':'bg_column.gif';
				if($val2['if_in']&&$val2['module']<1000)$val2['foldername']=$val2['out_url'];
				$gz_class2x[$val['id']][] = $val2;
				if($val2['releclass'])$val['moveno']=1;
				/*三级栏目处理*/
				foreach($gz_class3[$val2['id']] as $key=>$val3){
					$val3['name']=str_replace('"', '&#34;', str_replace("'", '&#39;',$val3['name']));
					$val3['modulename']=module($val3['module']);
					$val3['navpotion']='';
					for($u=0;$u<4;$u++){
						$navtypes = navdisplay($u);
						$navselect = $u == $val3['nav']?"selected='selected'":'';
						$val3['navpotion'].= "<option value='{$u}' {$navselect}>{$navtypes}</option>";
					}
					if($val3['if_in']&&$val3['module']<1000)$val3['foldername']=$val3['out_url'];
					$val['moveno']=1;
					$gz_class3x[$val2['id']][] = $val3;
				}
			}
		}
		$gz_class1x[] = $val;
	}
}
$gz_class1=$gz_class1x;
$gz_class2=$gz_class2x;
$gz_class3=$gz_class3x;
include template('column/column');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.resonance.com.cn). All rights reserved.
?>