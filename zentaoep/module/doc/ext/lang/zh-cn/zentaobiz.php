<?php
global $app;
if(!empty($app->user->feedback) or !empty($_COOKIE['feedbackView']))
{
    unset($lang->doc->libTypeList['product']);
    unset($lang->doc->libTypeList['project']);

    unset($lang->doc->aclList['custom']);
    $lang->doc->aclList['dept'] = '部门';
    $lang->doc->customAB = $lang->doclib->all;
}

$lang->doc->editBook      = '编辑手册';
$lang->doc->manageBook    = '维护手册';
$lang->doc->catalog       = '章节';
$lang->doc->chapter       = '所属章节';
$lang->doc->chapterName   = '章节名称';
$lang->doc->editChapter   = '编辑章节';
$lang->doc->bookBrowseTip = '点击左侧章节文章树状图查看手册详情，您也可以';
$lang->doc->addCatalogTip = '当前文档还没有章节，您可以';

$lang->doc->libTypeList['book']  = '手册';

$lang->doc->libIconList['book']  = 'icon-book';

$lang->doclib->tabList['book']  = '手册';

$lang->doclib->nameList['book']  = '手册名称';

$lang->book = new stdclass();

$lang->book->type = '类型';
$lang->book->title = '标题';
$lang->book->keywords = '关键字';

$lang->book->typeList['chapter'] = '章节';
$lang->book->typeList['article'] = '文章';
