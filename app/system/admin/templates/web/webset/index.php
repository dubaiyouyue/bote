<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.resonance.com.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
$disabled='';
$weburltext = "{$_M[word][upfiletips10]}{$_M[url][site]}";
if($_M[langlist][web][$_M[lang]][link]){
	$gz_weburl = $_M[langlist][web][$_M[lang]][link];
	$disabled = 'disabled';
	$weburltext = "{$_M[word][unitytxt_8]}";
}
if($_M[config][gz_weburl]=='')$_M[config][gz_weburl]=$_M[url][site];
$data_key = md5(md5(substr($_M['config']['gz_webkeys'],0,8))); 
$time = time();

$now_gz_weburl=explode('http',$weburltext);
$now_gz_weburl='http'.$now_gz_weburl['1'];

echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doseteditor" target="_self">
<div class="v52fmbx" data-gent="{$_M[form][gent]}" data-webset-record="{$record}">
	<h3 class="v52fmbx_hr">{$_M['word']['setbasicWebInfoSet']}</h3>
	<dl>
		<dt>{$_M[word][setbasicWebName]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_webname" type="text" value="{$_M[config][gz_webname]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setbasicWebName]}英文</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="engz_webname" type="text" value="{$_M[config][engz_webname]}" />
			</div>
		</dd>
	</dl>
	
	
	<dl>
		<dt>{$_M[word][upfiletips9]}</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_logo" type="text" data-upload-type="doupimg" class="text" value="{$_M['config']['gz_logo']}">
			</div>
			<span class="tips">{$_M['word']['suggested_size']} 180 * 60 ({$_M['word']['setimgPixel']})</span>
		</dd>
	</dl>
	<dl>
		<dt>地址栏图标</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_ico" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="../favicon.ico?{$time}">
			</div>
			<span class="tips">{$_M['word']['suggested_size']} 32 * 32 ({$_M['word']['setimgPixel']})的.ico文件。<a href="http://www.bitbug.net/" target="_blank">点击制作ICO</a>
			<br />
			如果无法正常显示新上传图标，请空浏览器缓存后访问。
			</span>
		</dd>
	</dl>
<!--<dl>
		<dt>电话号码图片</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_ewmdh" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_ewmdh']}">
			</div>
			
		</dd>
	</dl>-->
	
<!--<dl>
		<dt>旗下品牌图片</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_ewmdhzbtp" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_ewmdhzbtp']}">
			</div>
			
		</dd>
	</dl>
	
<dl>
		<dt>二维码</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_ewm" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_ewm']}">
			</div>
			
		</dd>
	</dl>-->
	<dl>
		<dt>首页图片1</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_hsjjquhaoossyyimgg" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_hsjjquhaoossyyimgg']}">
			</div>
			
		</dd>
	</dl>
	
	<dl>
		<dt>首页图片1英文</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_hsjjquenginggimgg" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_hsjjquenginggimgg']}">
			</div>
			
		</dd>
	</dl>
	
	<dl>
		<dt>首页财经日历图片</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_hsjjqccssimgg" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_hsjjqccssimgg']}">
			</div>
			
		</dd>
	</dl>
	<dl>
		<dt>首页全球新闻图片</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_hggxxwwg" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_hggxxwwg']}">
			</div>
			
		</dd>
	</dl>
	<dl>
		<dt>首页关于伯顿图片</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_hguanyuwwbdg" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_hguanyuwwbdg']}">
			</div>
			
		</dd>
	</dl>
	<dl>
		<dt>首页伯顿的优势图片</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_hguyoushibdg" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_hguyoushibdg']}">
			</div>
			
		</dd>
	</dl>
	<dl>
		<dt>首页公司新闻图片</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="gz_hggsxinwwbdg" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="{$_M['config']['gz_hggsxinwwbdg']}">
			</div>
			
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setbasicWebSite]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_weburl" type="text" value="{$now_gz_weburl}" {$disabled} />
			</div>
			<span class="tips">{$weburltext}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][upfiletips12]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_keywords" type="text" value="{$_M[config][gz_keywords]}" />
			</div>
			<span class="tips">{$_M[word][upfiletips13]}</span>
		</dd>
	</dl>

	
			<!--<dl>
		<dt>百度地图</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="gz_description">{$_M[config][gz_description]}</textarea>
			</div>
			<span class="tips">{$_M[word][upfiletips15]}（{$_M[word][current_input]} <span class="gz_description_tips"></span> {$_M[word][sys_characters]}）</span>
			
		</dd>
	</dl>-->
	<h3 class="v52fmbx_hr">{$_M[word][unitytxt_13]}</h3>
	<dl>
		<dt>公司名称</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_headquartersaddress" type="text" value="{$_M[config][gz_headquartersaddress]}" /> 
			</div>
		</dd>
	</dl>
	
	<!--<dl>
		<dt>{$_M[word][setfootAddressCode]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_footaddress" type="text" value="{$_M[config][gz_footaddress]}" />
			</div>
		</dd>
	</dl>-->
	<dl><!--联系方式-->
		<dt>邮箱</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_foottel" type="text" value="{$_M[config][gz_foottel]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>传真</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_foottelqq" type="text" value="{$_M[config][gz_foottelqq]}" /> 
			</div>
		</dd>
	</dl>
	<!--电话 2016.12.05-->
	<dl>
		<dt>电话</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_footteldianhua" type="text" value="{$_M[config][gz_footteldianhua]}" /> 
			</div>
		</dd>
	</dl>
	<!--end-->
	<!--电话 2016.12.05
	<dl>
		<dt>邮编</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_footteldianhua2" type="text" value="{$_M[config][gz_footteldianhua2]}" />  
			</div>
		</dd>
	</dl>
	<dl>
		<dt>留言</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_footteldianhua2lyy" type="text" value="{$_M[config][gz_footteldianhua2lyy]}" />  
			</div>
		</dd>
	</dl>-->


	
	
	<dl>
		<dt>QQ</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_headTeless" type="text" value="{$_M[config][gz_headTeless]}" /> 
			</div>
		</dd>
	</dl>

	<dl>
		<dt>重要信息链接</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_headTelesszyxxlj" type="text" value="{$_M[config][gz_headTelesszyxxlj]}" /> 
			</div>
		</dd>
	</dl>
	<dl>
		<dt>登入注册链接</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_heazcsryxxlj" type="text" value="{$_M[config][gz_heazcsryxxlj]}" /> 
			</div>
		</dd>
	</dl>
	<dl>
		<dt>英文版链接</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_heazcsryxxljeeww" type="text" value="{$_M[config][gz_heazcsryxxljeeww]}" /> 
			</div>
		</dd>
	</dl>
	<dl>
		<dt>MT4下载</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_hemmttfffxz" type="text" value="{$_M[config][gz_hemmttfffxz]}" /> 
			</div>
		</dd>
	</dl>
	
	
	<!--<dl>
		<dt>Fax</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_headFaxess" type="text" value="{$_M[config][gz_headFaxess]}" /> 
			</div>
		</dd>
	</dl>-->
	
	
	
	
	
	

	<!--end-->
	<!--头部欢迎语句-->
	<dl>
		<dt>公司地址</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_headeryj" type="text" value="{$_M[config][gz_headeryj]}" />  
			</div>
		</dd>
	</dl>
	<!--end-->
	<dl>
		<dt>{$_M[word][setfootVersion]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_footright" type="text" value="{$_M[config][gz_footright]}" />
			</div>
		</dd>
	</dl>
	<!--ICP备案号-->
<!--<dl>
		<dt>ICP备案号</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="gz_footerbeianhao" type="text" value="{$_M[config][gz_footerbeianhao]}" />  
			</div>
		</dd>
	</dl>-->
	<dl>
		<dt>手机区号</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="gz_hsjjquhaoo">{$_M[config][gz_hsjjquhaoo]}</textarea>  
				<br />
				（每行一个）
			</div>
		</dd>
	</dl>
	<dl>
		<dt>国家</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="gz_hsjjquhaoogg">{$_M[config][gz_hsjjquhaoogg]}</textarea>  
				<br />
				（每行一个）
			</div>
		</dd>
	</dl>
	<dl>
		<dt>国家英文</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="engz_hsjjquhaoogg">{$_M[config][engz_hsjjquhaoogg]}</textarea>  
				<br />
				（每行一个）
			</div>
		</dd>
	</dl>
	
	
	<dl>
		<dt>语言包</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="gz_headeryjhhyy">{$_M[config][gz_headeryjhhyy]}</textarea>  
				<br />
				（上行中文，下行英文）
			</div>
		</dd>
	</dl>
	
	<dl>
		<dt>下载文字</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="gz_hemmttfffxzzxxzwz">{$_M[config][gz_hemmttfffxzzxxzwz]}</textarea>
			</div>
		</dd>
	</dl>
	<dl>
		<dt>下载文字英文</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="engz_hemmttfffxzzxxzwz">{$_M[config][engz_hemmttfffxzzxxzwz]}</textarea>
			</div>
		</dd>
	</dl>
	
	
	<dl>
		<dt>内页底部文字</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="gz_hemmttfffxzzxxzwzttt">{$_M[config][gz_hemmttfffxzzxxzwzttt]}</textarea>
			</div>
		</dd>
	</dl>
	<dl>
		<dt>内页底部文字英文</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="engz_hemmttfffxzzxxzwzttt">{$_M[config][engz_hemmttfffxzzxxzwzttt]}</textarea>
			</div>
		</dd>
	</dl>
	
	
	<dl>
		<dt>{$_M[word][setfootOther]}</dt>
		<dd class="ftype_ckeditor">
			<div class="fbox">
				<textarea name="gz_footother" data-ckeditor-type="2" data-ckeditor-y="100">{$_M['config']['gz_footother']}</textarea>
			</div>
		</dd>
	</dl>
	
	<dl>
		<dt>{$_M[word][setfootOther]}英文</dt>
		<dd class="ftype_ckeditor">
			<div class="fbox">
				<textarea name="gz_eenfootother" data-ckeditor-type="2" data-ckeditor-y="100">{$_M['config']['gz_eenfootother']}</textarea>
			</div>
		</dd>
	</dl>
	
	<dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M['word']['Submit']}" class="submit">
		</dd>
	</dl>
</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.resonance.com.cn). All rights reserved.
?>