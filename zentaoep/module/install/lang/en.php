<?php
/**
 * The install module English file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     install
 * @version     $Id: en.php 4972 2013-07-02 06:50:10Z zhujinyonging@gmail.com $
 * @link        http://www.zentao.net
 */
$lang->install = new stdclass();

$lang->install->common  = 'Install';
$lang->install->next    = 'Next';
$lang->install->pre     = 'Back';
$lang->install->reload  = 'Reload';
$lang->install->error   = 'Error ';

$lang->install->officeDomain     = 'https://www.zentao.pm';

$lang->install->start            = 'Start';
$lang->install->keepInstalling   = 'Keep installing this version.';
$lang->install->seeLatestRelease = 'View Latest Version';
$lang->install->welcome          = 'Thanks for choosing ZenTao!';
$lang->install->license          = 'ZenTao PMS is under Z PUBLIC LICENSE(ZPL) 1.2';
$lang->install->desc             = <<<EOT
ZenTao Project Management Software is an Open Source software released under <a href='http://zpl.pub/page/zplv12.html' target='_blank'>ZPL</a> license. It integrates with Product Management, Project Management, QA Management, Document Management, Todos Management, Company Management etc. ZenTao is the best choice for software project management.

ZenTao PMS is built on PHP + MySQL and based on ZenTaoPHP framework, an independent framework developed by our team. Third party developers/organizations can develop extensions or customize for their requirements.
EOT;
$lang->install->links = <<<EOT
ZenTao PMS is developed by <strong><a href='http://easysoft.ltd' target='_blank' class='text-danger'>Nature Easy Soft Co., LTD</a></strong>.
Official Website : <a href='https://www.zentao.pm' target='_blank'>https://www.zentao.pm</a>
Technical Support : <a href='https://www.zentao.pm/forum/' target='_blank'>https://www.zentao.pm/forum/</a>
WhatsApp Group : <a href='https://chat.whatsapp.com/B6pi6b3gv0S7x7jqMxwhbF' target='_blank'>https://chat.whatsapp.com/B6pi6b3gv0S7x7jqMxwhbF</a>
Twitter: <a href='https://twitter.com/cneasysoft' target='_blank'>cneasysoft</a>

You are installing ZenTao <strong class='text-danger'>%s</strong> Version.
EOT;

$lang->install->newReleased= "<strong class='text-danger'>Notice</strong>：Official Website has the latest version<strong class='text-danger'>%s</strong>, released on %s.";
$lang->install->or         = 'Or';
$lang->install->checking   = 'System Checkup';
$lang->install->ok         = 'Passed(√)';
$lang->install->fail       = 'Failed(×)';
$lang->install->loaded     = 'Loaded';
$lang->install->unloaded   = 'Not Loaded';
$lang->install->exists     = 'Found ';
$lang->install->notExists  = 'Not found ';
$lang->install->writable   = 'Writable ';
$lang->install->notWritable= 'Not Writable ';
$lang->install->phpINI     = 'PHP ini File';
$lang->install->checkItem  = 'Item';
$lang->install->current    = 'Current Setting';
$lang->install->result     = 'Result';
$lang->install->action     = 'Action';

$lang->install->phpVersion = 'PHP Version';
$lang->install->phpFail    = 'PHP Version has to be 5.2.0+';

$lang->install->pdo          = 'PDO';
$lang->install->pdoFail      = 'Edit php.ini to load PDO extsion.';
$lang->install->pdoMySQL     = 'PDO_MySQL';
$lang->install->pdoMySQLFail = 'Edit php.ini to load PDO_MySQL extsion.';
$lang->install->json         = 'JSON Extension';
$lang->install->jsonFail     = 'Edit php.ini to load JSON extension.';
$lang->install->openssl      = 'OpenSSL Extension';
$lang->install->opensslFail  = 'Edit php.ini to load openssl extension.';
$lang->install->mbstring     = 'Mbstring Extension';
$lang->install->mbstringFail = 'Edit php.ini to load mbstring extension.';
$lang->install->zlib         = 'Zlib Extension';
$lang->install->zlibFail     = 'Edit php.ini to load zlib extension.';
$lang->install->curl         = 'Curl Extension';
$lang->install->curlFail     = 'Edit php.ini to load curl extension.';
$lang->install->filter       = 'Filter Extension';
$lang->install->filterFail   = 'Edit the php.ini file to load filter extension.';
$lang->install->gd           = 'GD Extension';
$lang->install->gdFail       = 'Edit the php.ini file to load gd extension.';
$lang->install->iconv        = 'Iconv Extension';
$lang->install->iconvFail    = 'Edit the php.ini file to load iconv extension.';
$lang->install->tmpRoot      = 'Temp Directory';
$lang->install->dataRoot     = 'Uploaded File Directory';
$lang->install->session      = 'Session Save Path';
$lang->install->sessionFail  = 'Edit the php.ini file to set session.save_path.';
$lang->install->mkdirWin     = '<p>%s directory has to be created.<br /> Run <code>mkdir %s</code> to create it.</p>';
$lang->install->chmodWin     = ' "%s" privilege has to be changed.';
$lang->install->mkdirLinux   = '<p>%s directory has to be created.<br /> Run <code>mkdir -p %s</code> to create it.</p>';
$lang->install->chmodLinux   = ' "%s" privilege has to be changed.<br /> Run <code>chmod o=rwx -R %s</code> to change it.';

$lang->install->defaultLang    = 'Default Language';
$lang->install->dbHost         = 'Database Host';
$lang->install->dbHostNote     = 'If 127.0.0.1 is not accessible, try localhost.';
$lang->install->dbPort         = 'Host Port';
$lang->install->dbUser         = 'Database User';
$lang->install->dbPassword     = 'Database Password';
$lang->install->dbName         = 'Database Name';
$lang->install->dbPrefix       = 'Table Prefix';
$lang->install->clearDB        = 'Clean tables if it already exists.';
$lang->install->importDemoData = 'Import Demo Data';
$lang->install->working        = 'Operation Mode';

$lang->install->requestTypes['GET']       = 'GET';
$lang->install->requestTypes['PATH_INFO'] = 'PATH_INFO';

$lang->install->workingList['full']      = 'Application Lifecycle Management';
$lang->install->workingList['onlyTest']  = 'Only Test Management';
$lang->install->workingList['onlyStory'] = 'Only Story Management';
$lang->install->workingList['onlyTask']  = 'Only Task Management';

$lang->install->errorConnectDB      = 'Connection to database Failed. ';
$lang->install->errorDBName         = 'Database name should exclude “.” ';
$lang->install->errorCreateDB       = 'Failed to create the database.';
$lang->install->errorTableExists    = 'Data table has existed. If ZenTao has been installed before, please return to last step and clear data. Then continue the installation.';
$lang->install->errorCreateTable    = 'Failed to create the table.';
$lang->install->errorImportDemoData = 'Failed to import demo data.';

$lang->install->setConfig  = 'Create config file';
$lang->install->key        = 'Item';
$lang->install->value      = 'Value';
$lang->install->saveConfig = 'Save config';
$lang->install->save2File  = '<div class="alert alert-warning">Copy the content in the text box above and save it to "<strong> %s </strong>". You can change this config file later.</div>';
$lang->install->saved2File = 'Config file has been saved to " <strong>%s</strong> ". You can change this file later.';
$lang->install->errorNotSaveConfig = 'Config file is not saved.';

$lang->install->getPriv  = 'Set Admin';
$lang->install->company  = 'Company Name';
$lang->install->account  = 'Admin Account';
$lang->install->password = 'Admin Password';
$lang->install->errorEmptyPassword = 'Password should not be blank.';

$lang->install->groupList['ADMIN']['name']   = 'Admin';
$lang->install->groupList['ADMIN']['desc']   = 'System Admin';
$lang->install->groupList['DEV']['name']     = 'Dev';
$lang->install->groupList['DEV']['desc']     = 'Developer';
$lang->install->groupList['QA']['name']      = 'QA';
$lang->install->groupList['QA']['desc']      = 'tester';
$lang->install->groupList['PM']['name']      = 'PM';
$lang->install->groupList['PM']['desc']      = 'Project Manager';
$lang->install->groupList['PO']['name']      = 'PO';
$lang->install->groupList['PO']['desc']      = 'Product Owner';
$lang->install->groupList['TD']['name']      = 'Dev Manager';
$lang->install->groupList['TD']['desc']      = 'Development Manager';
$lang->install->groupList['PD']['name']      = 'PD';
$lang->install->groupList['PD']['desc']      = 'Product Director';
$lang->install->groupList['QD']['name']      = 'QD';
$lang->install->groupList['QD']['desc']      = 'QA Director';
$lang->install->groupList['TOP']['name']     = 'Senior';
$lang->install->groupList['TOP']['desc']     = 'Senior Manager';
$lang->install->groupList['OTHERS']['name']  = 'Other';
$lang->install->groupList['OTHERS']['desc']  = 'other users';
$lang->install->groupList['LIMITED']['name'] = 'Limited User';
$lang->install->groupList['LIMITED']['desc'] = 'User can only edit contents related to itself';

$lang->install->cronList[''] = 'Monitor cron';
$lang->install->cronList['moduleName=project&methodName=computeburn'] = 'Update Burndown Chart';
$lang->install->cronList['moduleName=report&methodName=remind']       = 'Daily task reminder';
$lang->install->cronList['moduleName=svn&methodName=run']             = 'Synchronize SVN';
$lang->install->cronList['moduleName=git&methodName=run']             = 'Synchronize GIT';
$lang->install->cronList['moduleName=backup&methodName=backup']       = 'Backup data&file';
$lang->install->cronList['moduleName=mail&methodName=asyncSend']      = 'Async sending Message';
$lang->install->cronList['moduleName=webhook&methodName=asyncSend']   = 'Async sending Webhook';
$lang->install->cronList['moduleName=admin&methodName=deleteLog']     = 'Delete overdue log';
$lang->install->cronList['moduleName=todo&methodName=createCycle']    = 'Create repeat todos';

$lang->install->success  = "Installed!";
$lang->install->login    = 'Login ZenTao';
$lang->install->register = 'Register in ZenTao';

$lang->install->joinZentao = <<<EOT
<p>You have installed ZenTao %s.<strong class='text-danger'> Please delete install.php asap</strong>.</p><p>Note: In order to get the latest news of ZenTao, please register in ZenTao(<a href='https://www.zentao.pm' class='alert-link' target='_blank'>www.zentao.pm</a>).</p>
EOT;

$lang->install->product = array('chanzhi', 'ranzhi');

$lang->install->promotion     = "Products from  Nature Easy Soft team:";
$lang->install->chanzhi       = new stdclass();
$lang->install->chanzhi->name = 'ZSITE content management system.';
$lang->install->chanzhi->logo = 'images/main/chanzhi_en.png';
$lang->install->chanzhi->url  = 'http://www.zsite.net';
$lang->install->chanzhi->desc = <<<EOD
<ul>
  <li>Article, Blog, Manual, Member, Shop, Forum, Feedback……</li>
  <li>Customize page freely by theme, effect, widget, css, js and layout</li>
  <li>Support desktop and mobile in one system</li>
  <li>Deeply optimized for search engine</li>
</ul>
EOD;

$lang->install->ranzhi = new stdclass();
$lang->install->ranzhi->name = 'ZDOO Collaborative System';
$lang->install->ranzhi->logo = 'images/main/zdoo_org.png';
$lang->install->ranzhi->url  = 'http://www.zdoo.org';
$lang->install->ranzhi->desc = <<<EOD
<ul>
  <li>CRM: Customer Management and Order Tracking</li>
  <li>OA: Approve, Announce, Trip, Leave and so on. </li>
  <li>Project，Task and Document management </li>
  <li>Money: Income, Expense, Transfer, Invest and Debt</li>
</ul>
EOD;
