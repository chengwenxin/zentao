<?php
$lang->ldap->common = 'LDAP配置';
$lang->ldap->index  = '配置首頁';
$lang->ldap->base   = '基本配置';
$lang->ldap->attr   = '屬性配置';
$lang->ldap->import = '從LDAP導入用戶';

$lang->ldap->turnon       = '功能狀態';
$lang->ldap->type         = '伺服器類型';
$lang->ldap->host         = 'LDAP伺服器';
$lang->ldap->port         = '連接埠號';
$lang->ldap->version      = 'LDAP版本';
$lang->ldap->admin        = '管理賬號';
$lang->ldap->password     = '賬號密碼';
$lang->ldap->baseDN       = 'Base DN';
$lang->ldap->account      = '登錄名';
$lang->ldap->realname     = '真實姓名';
$lang->ldap->email        = 'Email欄位';
$lang->ldap->phone        = '工作電話';
$lang->ldap->mobile       = '手機';
$lang->ldap->anonymous    = '匿名';
$lang->ldap->charset      = 'LDAP編碼';
$lang->ldap->defaultGroup = '預設用戶組';

$lang->ldap->example   = '例如：';
$lang->ldap->accountPS = 'LDAP伺服器中對應個人用戶名的欄位';
$lang->ldap->groupPS   = 'LDAP用戶登陸後的所處的分組';

$lang->ldap->successSave    = '成功保存';

$lang->ldap->error          = new stdclass();
$lang->ldap->error->connect = '不能連接LDAP伺服器，可能LDAP的地址或連接埠錯誤！';
$lang->ldap->error->verify  = '管理賬號的用戶名或密碼錯誤，或者LDAP版本選擇錯誤';
$lang->ldap->error->noempty = '[%s]不能為空';

$lang->ldap->turnonList[0] = '關閉';
$lang->ldap->turnonList[1] = '開啟';

$lang->ldap->versionList[3] = '3';
$lang->ldap->versionList[2] = '2';

$lang->ldap->typeList['ldap'] = "LDAP伺服器";
$lang->ldap->typeList['ad']   = "活動目錄";

$lang->ldap->noldap          = new stdclass();
$lang->ldap->noldap->header  = 'ERROR：沒加載PHP的LDAP擴展';
$lang->ldap->noldap->content = '本配置依賴于PHP的LDAP擴展，需要加載LDAP擴展，你可以修改php.ini檔案，或者可以安裝LDAP擴展。具體安裝可以參考該文檔 <a href="https://www.zentao.net/help-read-79704.html" target="_blank">安裝PHP的LDAP擴展</a> 。';
