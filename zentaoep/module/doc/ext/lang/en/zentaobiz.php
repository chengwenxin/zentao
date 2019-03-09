<?php
global $app;
if(!empty($app->user->feedback) or !empty($_COOKIE['feedbackView']))
{
    unset($lang->doc->libTypeList['product']);
    unset($lang->doc->libTypeList['project']);

    unset($lang->doc->aclList['custom']);
    $lang->doc->aclList['dept'] = 'Department';
    $lang->doc->customAB = $lang->doclib->all;
}

$lang->doc->editBook      = 'Edit Book';
$lang->doc->manageBook    = 'Manage Book';
$lang->doc->catalog       = 'Chapter';
$lang->doc->chapter       = 'Chapter';
$lang->doc->chapterName   = 'Chapter Name';
$lang->doc->editChapter   = 'Edit Chapter';
$lang->doc->bookBrowseTip = 'Check the articles on the left column to read the details, or';
$lang->doc->addCatalogTip = 'Current book is empyt, you colud';

$lang->doc->libTypeList['book']  = 'Book';

$lang->doc->libIconList['book']  = 'icon-book';

$lang->doclib->tabList['book']   = 'Book';

$lang->doclib->nameList['book']  = 'Book Name';

$lang->book = new stdclass();

$lang->book->type = 'Type';
$lang->book->title = 'Title';
$lang->book->keywords = 'Keywords';

$lang->book->typeList['chapter'] = 'Chapter';
$lang->book->typeList['article'] = 'Article';
