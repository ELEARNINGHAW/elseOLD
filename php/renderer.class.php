<?php

require_once '../smarty/libs/Smarty.class.php';

class Renderer
{

var $smarty;  

function   Renderer()
{
  $this->smarty = new Smarty;

  $conf = getConf();
  $this->smarty->compile_dir  = $conf['templates_compile_dir'];
  $this->smarty->template_dir = "../templates";
  $this->smarty->config_dir   = "../configs";
  $this->smarty->addTemplateDir('./templates');
# $this->smarty->compile_check = true;
}

function smarty_init() {
}

function doRedirect( $url = "index.php?categories=1" ) 
{
  $this->smarty->assign("url", $url);
  header("Location: $url"); 	
	$this->smarty->display('header.tpl');
	$this->smarty->display('redirect.tpl');
	$this->smarty->display('footer.tpl');
	exit(0);	
}

function do_template( $template, $kw, $HuF = true ) 
{   
	#global $_SESSION, $_SERVER, $debug_level;
	$this->smarty->compile_check = TRUE;

	foreach ($kw as $k => $v)  
  {  $this->smarty->assign($k, $v);
	}
    
  if ($HuF) $this->smarty->display('header.tpl');
	{ $this->smarty->display($template);
  }
  
  if ($HuF) $this->smarty->display('footer.tpl');
  {
	  foreach ($kw as $k => $v) 
    {  #$smarty->clear_assign( array($k, $v));
    }
  }
  {  $_SESSION['work']['last_page'] = $_SERVER['REQUEST_URI'];
	}
}

/*

function displayConfirm($INPUT)
{
  $this->smarty->assign( 'mode'     , '' );       
  $this->smarty->assign( 'item'     , $INPUT[ 'item'     ] );
  $this->smarty->assign( 'id'       , $INPUT[ 'id'       ] );
  $this->smarty->assign( 'file'     , $INPUT[ 'file'     ] );
  $this->smarty->assign( 'redirect' , $INPUT[ 'redirect' ] ); 
  $this->smarty->assign( 'action'   , $INPUT[ 'action'   ] );

  $this->smarty->display( "header.tpl"    );
  $this->smarty->display( "confirm.tpl"   );
  $this->smarty->display( "footer.tpl"    );
}
*/

/*
function redirectext($url = "index.php?categories=1") 
{ 	
    $this->smarty->assign("url", $url);
	$this->smarty->display('header.tpl');
	$this->smarty->display('redirectext.tpl');
	$this->smarty->display('footer.tpl');
	exit(0);	
}
*/


/*
function guess_mime_type($fn) {
	global $mime_types;

	$fn = strtolower(basename(strtolower($fn)));

	$mime_type='application/octet-stream'; # catch-all

	foreach ($mime_types as $preg => $value ) {
		if (preg_match($preg, $fn) > 0) {
			$mime_type = $value;
			break;
		} 
	}
	
	return $mime_type;
}
*/


}

?>