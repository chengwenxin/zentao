<?php
global $app;
if(!empty($app->user->feedback) or !empty($_COOKIE['feedbackView']))
{
    unset($lang->doc->libTypeList['product']);
    unset($lang->doc->libTypeList['project']);

    unset($lang->doc->aclList['custom']);
    $lang->doc->aclList['dept'] = '部門';
    $lang->doc->customAB = $lang->doclib->all;
}

$lang->doc->editBook      = '編輯手冊';
$lang->doc->manageBook    = '維護手冊';
$lang->doc->catalog       = '章節';
$lang->doc->chapter       = '所屬章節';
$lang->doc->chapterName   = '章節名稱';
$lang->doc->editChapter   = '編輯章節';
$lang->doc->bookBrowseTip = '點擊左側章節文章樹狀圖查看手冊詳情，您也可以';
$lang->doc->addCatalogTip = '當前文檔還沒有章節，您可以';

$lang->doc->libTypeList['book']  = '手冊';

$lang->doc->libIconList['book']  = 'icon-book';

$lang->doclib->tabList['book']  = '手冊';

$lang->doclib->nameList['book']  = '手冊名稱';

$lang->book = new stdclass();

$lang->book->type = '類型';
$lang->book->title = '標題';
$lang->book->keywords = '關鍵字';

$lang->book->typeList['chapter'] = '章節';
$lang->book->typeList['article'] = '文章';
