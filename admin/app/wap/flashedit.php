<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.resonance.com.cn). All rights reserved.
$depth='../';
require_once $depth.'../login/login_check.php';
$flashrec1=$db->get_one("SELECT * FROM {$gz_flash} where id='$id'");
$mtype=$gz_flasharray[$module][type];
$flashmdtype=$flashrec1['img_path']!=''?1:2;
$mtype=$flashmdtype==2?2:1;
$flashmdtype1[$flashmdtype]='selected';
$qsql=$gz_wap_ok?"and wap_ok='1'":'';//mobile
$query="select * from $gz_column where lang='$lang' and if_in='0' {$qsql} order by no_order";
$result= $db->query($query);
while($list = $db->fetch_array($result)){
	if(!$gz_flasharray[$list[id]]){
		$gz_flasharray[$list[id]]=$gz_flasharray[10000];
		$name='flash_'.$list[id];
		$value=$gz_flasharray[10000]['wap_type'].'|'.$gz_flasharray[10000]['wap_y'];
		$query = "INSERT INTO $gz_config SET
				name              = '$name',
				mobile_value      = '$value',
				flashid           = '$list[id]',
				lang              = '$lang'
				";
		$db->query($query);
	}
}
if($flashrec1['module']=='metinfo'){
	$gz_clumid_all1='checked';
}else{
	$lmod = explode(',',$flashrec1['module']);
	for($i=0;$i<count($lmod);$i++){
		if($lmod[$i]!='')$feditlist[$lmod[$i]]=1;
	}
}
foreach($gz_flasharray as $key=>$val){
	if($val['wap_type']==$flashmdtype){
		if($key==10001){
			$modclumlist[]=array('id'=>10001,'name'=>$lang_indexhome);
		}else{
			$wpok = $gz_wap_ok?($val[wap_ok]?1:0):1;
			if($wpok)$modclumlist[]=$gz_class[$key];
		}
	}
}
$i=1;
foreach($modclumlist as $key=>$list){
	if($list[classtype]==1 || $list['id']==10001){
		$mod1[$i]=$list;
		$i++;
	}
	if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
	if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
	$mod[$list['id']]=$list;
}
$motop[2]='now';
$css_url=$depth."../templates/".$gz_skin."/css";
$img_url=$depth."../templates/".$gz_skin."/images";
include template('app/wap/flashedit');
footer();

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.resonance.com.cn). All rights reserved.
?>