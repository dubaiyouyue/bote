<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.resonance.com.cn). All rights reserved. 
require_once '../include/common.inc.php';
$download=$db->get_one("select * from $gz_download where id='$id'");
	if(!$download){
	okinfo('../',$lang_error);
	}
if($type=='para'){
    $metinfodown=$db->get_one("select * from $gz_parameter where id='$paraid'");
    $download[downloadaccess]=$metinfodown[access];
	$metinfoparadown=$db->get_one("select * from $gz_plist where id='$listid' and module='4'");
	$download[downloadurl]=$metinfoparadown[info];
}
$query="select * from $gz_admin_array where id='$download[downloadaccess]'";
$memberacess=$db->get_one($query);
$download[downloadaccess]=$memberacess[user_webpower];
if(intval($metinfo_member_type)>=intval($download[downloadaccess])){
    header("location:$download[downloadurl]");exit;
	}else{
		gz_cooike_unset();
		change_gz_cookie('metinfo_member_name',$metinfo_member_name);
		change_gz_cookie('metinfo_member_pass',$metinfo_member_pass);
		change_gz_cookie('metinfo_member_type',$metinfo_member_type);
		change_gz_cookie('metinfo_admin_name',$metinfo_admin_name);
		save_gz_cookie();
		okinfo('../member/'.$member_index_url,$lang_downloadaccess);
	}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.resonance.com.cn). All rights reserved.
?>
