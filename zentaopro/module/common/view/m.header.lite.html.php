<?php
/**
 * The header.lite mobile view of common module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     common 
 * @version     $Id: header.lite.html.php 3299 2015-12-02 02:10:06Z daitingting $
 * @link        http://www.zentao.net
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}

// Common variables for views
$webRoot = $config->webRoot;
$jsRoot  = $webRoot . "mobile/js/";
$cssRoot = $webRoot . "mobile/css/";
?>
<!DOCTYPE html>
<html lang='<?php echo $this->app->getClientLang();?>'>
<head profile="http://www.w3.org/2005/10/profile">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
  <?php
  echo html::icon($webRoot . 'favicon.ico');

  echo html::title($title . ' - ' . $lang->zentaoPMS);

  js::exportConfigVars();

  if($config->debug)
  {
      js::import($jsRoot . 'mzui.js');
      js::import($jsRoot . 'my.js');
      
      css::import($cssRoot . 'mzui.min.css');
      css::import($cssRoot . 'style.css');
  }
  else
  {
      js::import($jsRoot . 'all.js');
      css::import($cssRoot . 'all.css');
  }

  if(isset($pageCSS)) css::internal($pageCSS);
  ?>
</head>
<body class='m-<?php echo $this->app->getModuleName() . '-' . $this->app->getMethodName() . (isset($bodyClass) ? ' ' . $bodyClass : ''); ?>'>
