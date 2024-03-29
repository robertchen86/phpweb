<?php
/////////////////////////////////////////////////////////////////////////////
//
// SpeedPHP - 快速的中文PHP框架
//
// Copyright (c) 2008 - 2009 SpeedPHP.com All rights reserved.
//
// 许可协议请查看 http://www.speedphp.com/
//
/////////////////////////////////////////////////////////////////////////////

$__speedy_compression_level = 9;

/**
 * speedy 简单的PHP模板引擎，仅通过PHP本身来作为模板的语法。让开发者除了Smarty等模板引擎之外，可以有一个快速并且简单的模板引擎方案。
 *
 * speedy拥有的功能：按模板路径来获取模板并显示，通过assign对模板内变量进行赋值，检查模板文件是否存在，GZip压缩等。
 */
class speedy{
	/**
	 * 模板目录
	 */
	public $template_dir = null;
	/**
	 * 是否开启GZip压缩
	 */
	public $enable_gzip	= FALSE;
	/**
	 * GZip压缩级别
	 */
	public $compression_level	=  9;
	/**
	 * 模板内使用的变量值
	 */
	private $_vars = array();
	
	/**
	 * 对模板赋值
	 * @param key 变量名称，或变量数组
	 * @param value 变量值
	 */
	public function assign($key, $value = null){
		if (is_array($key)){
			foreach($key as $var => $val)if($var != "")$this->_vars[$var] = $val;
		}else{
			if ($key != "")$this->_vars[$key] = $value;
		}
	}
	
	/**
	 * 检测模板是否存在
	 * @param tplname 模板名称
	 */	
	public function template_exists($tplname){
		if (file_exists(realpath($this->template_dir).'/'.$tplname))return TRUE;
		if (file_exists($tplname))return TRUE;
		return FALSE;
	}
	
	/**
	 * 显示模板
	 * @param tplname 模板名称
	 */	
	public function display($tplname){
		if (file_exists(realpath($this->template_dir).'/'.$tplname)){
			$tplpath = realpath($this->template_dir).'/'.$tplname;
		}elseif (file_exists($tplname)){
			$tplpath = $tplname;
		}else{
			spError("speedy引擎：无法找到模板 ".$tplname);
		}
		extract($this->_vars);
		if( TRUE == $this->enable_gzip ){
			GLOBAL $__speedy_compression_level;
			$__speedy_compression_level = $this->compression_level;
			ob_start('speedy_ob_gzip');
		}
		include $tplpath;
	}
	
}

function speedy_ob_gzip($content){ 
	if( !headers_sent() && extension_loaded("zlib") && strstr($_SERVER["HTTP_ACCEPT_ENCODING"],"gzip") ){
		GLOBAL $__speedy_compression_level;
		$content = gzencode($content,$__speedy_compression_level); 
		header("Content-Encoding: gzip"); 
		header("Vary: Accept-Encoding"); 
		header("Content-Length: ".strlen($content)); 
	} 
	return $content; 
} 