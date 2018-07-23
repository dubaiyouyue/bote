<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.resonance.com.cn). All rights reserved.
require_once '../include/common.inc.php';
if($class1)$id=$class1;
if(!is_numeric($id)){okinfo('../404.html');exit();}
$job=$db->get_one("select * from $gz_job where id='$id' and lang='$lang'");
if(!$job){
	okinfo('../404.html');exit();
}
$job[useful_life_a]=$job[useful_life];
if(intval($job[useful_life])==0)$job[useful_life]=$lang_Nolimit;
$classaccess= $db->get_one("SELECT * FROM $gz_column WHERE module='6' and lang='$lang'");
$class1=$classaccess[id];	
$metaccess=$job[access];
require_once '../include/head.php';
$guanlian=$class_list[$class1][releclass];
$job[content]=contentshow('<div>'.$job[content].'</div>');
$job[cv]=$gz_pseudo?'jobcv-'.$job[id].'-'.$lang.'.html':$cv[url].$job[id];
$job[count]=$job[count]?$job[count]:$lang_several;
$class1_info=$class_list[$class1][releclass]?$class_list[$class_list[$class1][releclass]]:$class_list[$class1];
$class2_info=$class_list[$class1][releclass]?$class_list[$class1]:$class_list[$class2];	
if($dataoptimize[$pagemark][nextlist]){
if($gz_member_use==2){
    $prejob=$db->get_one("select * from $gz_job where lang='$lang' and (access<='$metinfo_member_type') and id > '$id' limit 0,1");
    $nextjob=$db->get_one("select * from $gz_job where lang='$lang' and (access<='$metinfo_member_type') and id < '$id' order by id desc limit 0,1");
}else{
    $prejob=$db->get_one("select * from $gz_job where lang='$lang' and id > '$id' limit 0,1");
    $nextjob=$db->get_one("select * from $gz_job where lang='$lang' and id < '$id' order by id desc limit 0,1");
}
}
if($dataoptimize[6][otherlist]){
	$serch_sql=" where lang='$lang' ";
	if($gz_member_use==2)$serch_sql .= " and access<='$metinfo_member_type'";
	$order_sql="order by addtime desc ";
    $query = "SELECT * FROM $gz_job $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	if(intval($list[useful_life])==0)$list[useful_life]=$lang_Nolimit;
	$list[top]=$list[top_ok]?"<img class='listtop' src='".$img_url."top.gif"."' />":"";
	$list[news]=$list[top_ok]?"":((((strtotime($m_now_date)-strtotime($list[addtime]))/86400)<$gz_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' />":"");
	$list[addtime] = date($gz_listtime,strtotime($list[addtime]));
	if($gz_webhtm){
	switch($gz_htmpagename){
    case 0:
	$htmname="showjob".$list[id];	
	break;
	case 1:
	$list[updatetime1] = date('Ymd',strtotime($list[addtime]));
	$htmname=$list[updatetime1].$list[id];	
	break;
	case 2:
	$htmname="job".$list[id];	
	break;
	}
    $htmname=($list[filename]<>"" and $metadmin[pagename])?$list[filename]."_".$htmname:$htmname;
    }	
	$panyid = $list['filename']!=''?$list['filename']:$list['id'];
	$list[url]=$gz_pseudo?$panyid.'-'.$lang.'.html':($gz_webhtm?$htmname.$gz_htmtype:$phpname);
	$list[title]=$list[position];
	if($prejob[id]==$list[id])$preinfo=$list;  
	if($nextjob[id]==$list[id])$nextinfo=$list;
	$list[cv]=$gz_pseudo?'cv-'.$lang.'-'.$list[id].'.html':$cv[url].$list[id];
	$job_list[]=$list;
    }
}elseif($dataoptimize[$pagemark][nextlist]){
    switch($gz_htmpagename){
    case 0:
	$prehtmname="showjob";	
	$nexthtmname="showjob";
	break;
	case 1:
	$prehtmname = date('Ymd',strtotime($prejob[addtime]));	
	$nexthtmname = date('Ymd',strtotime($nextjob[addtime]));
	break;
	case 2:
	$prehtmname='job';
    $nexthtmname='job';		
	break;
	}
	$preid = $prejob['filename']!=''?$prejob['filename']:$prejob['id'];
	$nextid = $nextjob['filename']!=''?$nextjob['filename']:$nextjob['id'];
	
	$preid_html = $prejob['filename']!=''?$prejob['filename']:$prehtmname.$prejob[id];
	$nextid_html = $nextjob['filename']!=''?$nextjob['filename']:$nexthtmname.$nextjob[id];
	
	$phpname="showjob.php?".$langmark."&id=";
	if($prejob)$prejob[url]=$gz_pseudo?$preid.'-'.$lang.'.html':($gz_webhtm?$preid_html.$gz_htmtype:$phpname.$prejob[id]);
    if($nextjob)$nextjob[url]=$gz_pseudo?$nextid.'-'.$lang.'.html':($gz_webhtm?$nextid_html.$gz_htmtype:$phpname.$nextjob[id]);
	$preinfo=$prejob;
	$nextinfo=$nextjob;
	if($preinfo)$preinfo[title]=$preinfo[position];
	if($nextinfo)$nextinfo[title]=$nextinfo[position];
}
$class2=$class_list[$class1][releclass]?$class1:$class2;
$class1=$class_list[$class1][releclass]?$class_list[$class1][releclass]:$class1;
$class_info=$class2?$class2_info:$class1_info;
if($class2!=""){
$class_info[name]=$class2_info[name]."--".$class1_info[name];
}
     $show[description]=$job[description]?$job[description]:$gz_description;
     $show[keywords]=$job[keywords]?$job[keywords]:$gz_keywords;
	 $gz_title=$gz_title?$job['position'].'-'.$gz_title:$job['position'];
if(!$guanlian){
	if(count($nav_list2)){
	$nav_list2[$class1][0]=$class1_info;
	$nav_list2[$class1][1]=array('id'=>10004,'url'=>$cv[url],'name'=>$lang_cvtitle);
	}else{
	$k=count($nav_list2);
	$nav_list2[$class1][$k]=array('id'=>10004,'url'=>$cv[url],'name'=>$lang_cvtitle);
	}
}
$csnow=$cvidnow?$cvidnow:$classnow;
	 require_once '../public/php/methtml.inc.php';
	 require_once '../public/php/jobhtml.inc.php';
	 $nav_x[name]=$nav_x[name]." > ".$job[position];
include template('showjob');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.resonance.com.cn). All rights reserved.
?>