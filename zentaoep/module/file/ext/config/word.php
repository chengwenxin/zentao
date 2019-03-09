<?php
$config->word->story->exportFields[] = 'id';
$config->word->story->exportFields[] = 'spec';
$config->word->story->exportFields[] = 'verify';
$config->word->story->exportFields[] = 'pri';
$config->word->story->exportFields[] = 'estimate';
$config->word->story->exportFields[] = 'stage';
$config->word->story->exportFields[] = 'status';
$config->word->story->exportFields[] = 'files';

$config->word->story->titleField = 'title';

$config->word->story->style['title']  = 'title';
$config->word->story->style['spec']   = 'showImage';
$config->word->story->style['verify'] = 'showImage';

$config->word->tableName        = new stdclass();
$config->word->tableName->story = TABLE_STORY;

$config->word->header        = new stdclass();
$config->word->header->story = array( 'name' => 'product', 'tableName' => TABLE_PRODUCT);
$config->word->header->task  = array( 'name' => 'project', 'tableName' => TABLE_PROJECT);

$config->word->size->titles[1] = 20;
$config->word->size->titles[2] = 16;
$config->word->size->titles[3] = 12;
$config->word->size->titles[4] = 8;

$config->word->imageExtension = array('png', 'jpg', 'gif', 'jpeg');

global $app;
$config->word->filePath = $app->getBasePath() . 'www/';
