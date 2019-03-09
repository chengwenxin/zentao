<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class myfile extends file
{
    /**
     * Init for word 
     * 
     * @access public
     * @return void
     */
    public function init()
    {
        // post content: kind(string), exportFields(array), fields(array), rows(array), tableName(string), style(array), header(array).
        $this->app->loadClass('phpword', true);
        $this->kind         = $this->post->kind;
        $this->exportFields = isset($this->config->word->{$this->kind}->exportFields) ? $this->config->word->{$this->kind}->exportFields : '';
        $this->fields       = $this->post->fields;
        $this->rows         = $this->post->rows;
        $this->rowKey       = array();
        $this->phpWord      = new PHPWord();
        $this->htmlDom      = new simple_html_dom();
        $this->section      = $this->phpWord->createSection();
        if(!empty($_POST['exprotFields'])) $this->exportFields = $this->post->exportFields;
        foreach($this->config->word->size->titles as $id => $title) $this->addTitleStyle($id);
        $this->phpWord->addParagraphStyle('pStyle', array('spacing'=>100));
        $this->fields['files'] = $this->lang->word->fileField;

        $this->host = common::getSysURL();
        $this->initialState = array(
            'phpword_object' => &$this->phpWord, 
            'base_root' => $this->host, 
            'base_path' => '/', 

            'current_style' => array('size' => '11'), 
            'parents' => array(0 => 'body'), 
            'list_depth' => 0, 
            'context' => 'section',
            'pseudo_list' => TRUE,
            'pseudo_list_indicator_font_name' => 'Wingdings',
            'pseudo_list_indicator_font_size' => '7',
            'pseudo_list_indicator_character' => 'l ',
            'table_allowed' => TRUE,
            'treat_div_as_paragraph' => TRUE,

            'style_sheet' => htmltodocx_styles_example()
        );    
    }

    /**
     * Export to Word 
     * 
     * @access public
     * @return void
     */
    public function export2Word()
    {
        $this->init();
        $header     = isset($this->config->word->header->{$this->kind}) ? $this->config->word->header->{$this->kind} : (isset($this->post->header) ? $this->post->header : '');
        $header     = (object)$header;
        $headerName = empty($header) ? '' : $this->dao->select('*')->from($header->tableName)->where('id')->eq($this->session->{$header->name})->fetch();

        $tableName  = (empty($_POST['tableName'])) ? (isset($this->config->word->tableName->{$this->kind}) ? $this->config->word->tableName->{$this->kind} : '') : $this->post->tableName;
        if(empty($tableName)) die(js::alert($this->lang->word->notice->noexport));
        $modules = $this->dao->select('t2.id, t2.path, t2.name, t2.parent, t2.grade, t1.id as kindID, t2.order')->from($this->config->word->tableName->{$this->kind})->alias('t1')
            ->leftJoin(TABLE_MODULE)->alias('t2')->on('t1.module=t2.id')
            ->where('t1.id')->in(array_keys($this->rows))
            ->orderBy('t2.grade desc, t2.order')
            ->fetchAll('kindID');

        $treeMenu = array();
        $rowKey   = array();
        foreach($modules as $id => $module)
        {
            $rowKey[(int)$module->id][$id] = empty($module->name) ? '/' : $module->name;
            if(empty($module->id)) continue;

            if(isset($treeMenu[$module->id]) and !empty($treeMenu[$module->id]))
            {
                if(!isset($treeMenu[$module->parent])) $treeMenu[$module->parent] = array();
                $treeMenu[$module->parent][$module->order] = $module->id;
                $treeMenu[$module->parent][$module->order] = $treeMenu[$module->id];
                unset($treeMenu[$module->id]);
            }
            else
            {
                $treeMenu[$module->parent][$module->order] = $module->id;
            }
        }
        $treeMenu[0][0] = 0;
        ksort($treeMenu[0]);
        $this->rowKey = $rowKey;

        if($headerName)
        {
            $this->phpWord->addParagraphStyle('headerStyle', array('align' => 'center'));
            $this->section->addText($headerName->name, array('bold' => true, 'size' => 22), 'headerStyle');
            $textRun = $this->section->createTextRun('headerStyle');
            $textRun->addText('(' .$this->lang->word->headNotice, array('color' => 'CCCCCC'));
            $textRun->addLink($this->host, $this->lang->word->visitZentao, array('color'=>'0000FF', 'underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE));
            $textRun->addText(')', array('color' => 'CCCCCC'));
            $this->section->addTextBreak(2);
        }

        foreach($treeMenu as $moduleID => $module)
        {
            $this->createWord($module);
        }

        unset($this->htmlDom);
        setcookie('downloading', 1);
        header('Content-Type: application/vnd.ms-word');
        header("Content-Disposition: attachment;filename=\"{$this->post->fileName}.docx\"");
        header('Cache-Control: max-age=0');

        $wordWriter = PHPWord_IOFactory::createWriter($this->phpWord, 'Word2007');
        $wordWriter->save('php://output');
        exit;
    }

    public function createWord($module, $step = 1, $order = 0)
    {
        if(is_array($module))
        {
            foreach($module as $id => $childModule)
            {
                $order = $this->getNextOrder($order, $step + 1);
                if(is_array($childModule))$this->createTitle($id, $step + 1, $order);
                $this->createWord($childModule, $step + 1, $order);
            }
        }
        else
        {
            $this->createTitle($module, $step, $order);
        }
    }

    public function createTitle($moduleID, $step, $order)
    {
        $moduleName = current($this->rowKey[$moduleID]);
        $this->section->addTitle($order . " " . $moduleName . "（#{$moduleID}）", $step);
        $this->section->addTextBreak(1);
        ksort($this->rowKey[$moduleID]);
        foreach($this->rowKey[$moduleID] as $rowID => $moduleName)
        {
            $order = $this->getNextOrder($order, $step + 1);
            $this->createContent($rowID, $step + 1, $order);
        }
    }

    public function createContent($contentID, $step, $order)
    {
        if(!isset($this->rows[$contentID])) return false;
        $content  = $this->rows[$contentID];
        $filePath = $this->app->getBasePath() . 'www/';
        foreach($this->exportFields as $exportField)
        {
            $fieldName = $exportField;
            $style =isset($_POST['style'][$exportField]) ? $_POST['style'][$exportField] : (isset($this->config->word->{$this->kind}->style[$exportField]) ? $this->config->word->{$this->kind}->style[$exportField] : '');
            if($style == 'title')
            {
                $fieldContent = $order . ' ' . $content->$fieldName . "（#{$contentID}）";
                $this->section->addTitle($fieldContent, $step);
                $this->section->addTextBreak();
            }
            elseif($style == 'showImage')
            {
                $this->section->addText($this->fields[$fieldName] . ":", array('bold' => true));
                $fieldContent = preg_replace_callback('/<img src="(.+)" alt=".*" \/>/U', 'checkFileExist', $content->$fieldName);
                if(preg_match('/^\d+/', $fieldContent)) $fieldContent = "<br />" . $fieldContent;

                $this->htmlDom->load('<html><body>' . $fieldContent . '</body></html>');
                $htmlDomArray = $this->htmlDom->find('html', 0)->children();
                htmltodocx_insert_html($this->section, $htmlDomArray[0]->nodes, $this->initialState);
                $this->htmlDom->clear(); 
                $this->section->addTextBreak();
            }
            elseif($fieldName == 'files')
            {
                $this->formatFiles($content);
            }
            else
            {
                $textRun = $this->section->createTextRun('pStyle');
                $textRun->addText($this->fields[$fieldName] . "：", array('bold' => true));
                $textRun->addText($content->$fieldName, null);
            }
        }
        $this->section->addTextBreak();
        $detailLink = substr($this->server->http_referer, 0, strpos($this->server->http_referer, '/', 10)) . $this->createLink($this->kind, 'view', "id=$contentID");
        $textRun = $this->section->createTextRun('pStyle');
        $textRun->addText($this->lang->word->more . '：',  array('bold' => true));
        $textRun->addLink($detailLink, $detailLink, array('color'=>'0000FF', 'underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE));
        $this->section->addTextBreak(2);
    }

    public function formatFiles($content)
    {
        if(empty($content->files)) return;
        $this->section->addText($this->fields['files'] . ':', array('bold' => true));
        $filePath     = $this->app->getBasePath() . 'www/';
        $fieldContent = explode('<br />', $content->files);
        foreach($fieldContent as $linkHtml)
        {
            if(empty($linkHtml)) continue;
            preg_match("/<a href='([^']+)'[^>]*>(.+)<\/a>/", $linkHtml, $out);
            $linkHref = $out[1];
            $extension = strtolower(trim(strrchr($linkHref, '.'), '.'));
            $linkName = $out[2];
            if(in_array($extension, $this->config->word->imageExtension))
            {
                $linkHref = strstr(strstr($linkHref, $this->server->server_name), '/');
                if(!file_exists($filePath . $linkHref)) continue;
                $this->section->addImage($filePath . $linkHref);
                $this->section->addTextBreak();
            }
            else
            {
                $this->section->addLink($linkHref, $linkName . ".$extension", array('color'=>'0000FF', 'underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE));
            }
        }
    }

    public function addTextExcludeTags($text, $style = null)
    {
        $text = str_replace(array('<p>', '</p>', '&nbsp;'), array('','<br />', ' '),$text);
        $text = explode('<br />', $text);
        foreach($text as $line)
        {
            if(empty($line)) continue;
            $this->section->addText(preg_replace('/<.*>/U', '', $line), $style);
        }
    }


    public function addTitleStyle($step)
    {
        $size = isset($this->config->size->titles[$step]) ? $this->config->size->titles[$step] : 12;
        $this->phpWord->addTitleStyle($step, array('size'=> $size, 'color'=>'010101', 'bold'=>true));
    }

    public function getNextOrder($order, $step)
    {
        if($step == 1) return 0;
        $orders = explode('.', $order);
        if(count($orders) + 1 == $step -1)
        {
            $order .= '.1';
        }
        else
        {
            $orders[count($orders) -1] = end($orders) + 1;
            $order = join('.', $orders);
        }
        return $order;
    }
}

function checkFileExist($matches)
{
    global $app;
    $filePath = $app->getBasePath() . 'www/';
    return file_exists($filePath . $matches[1]) ? "<img src='$matches[1]' alt='' />" : '';
public function __construct($moduleName = '', $methodName = '')
{
    parent::__construct($moduleName, $methodName);
    if(function_exists('ioncube_license_properties')) $properties = ioncube_license_properties();
if($this->app->getModuleName() != 'upgrade')
{
    $user = $this->dao->select("COUNT('*') as count")->from(TABLE_USER)
        ->where('deleted')->eq(0)
        ->beginIF(isset($this->config->bizVersion))->andWhere('feedback')->eq('0')->fi()
        ->fetch();
    if(!empty($properties['user']) and $properties['user']['value'] < $user->count) die("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>Error</title>
</head>
<body>
<h2 style='color:red;text-align:center'>专业版人数超出限制</h2>
您版本的用户数是{$properties['user']['value']}，您目前系统中已有{$user->count}人，已经超过了限制，请联系我们增加人数授权。<br>
email：<a href='mailto:co@zentao.net'>co@zentao.net</a><br>
电话：4006 889923<br />
网址：<a href='http://www.zentao.net/goto.php?item=buypro'>www.zentao.net</a><br />
<br /><br /><br />
<h2 style='color:red;text-align:center'>Accounts has exceed the limit.</h2>
The accounts has exceed the limit of {$properties['user']['value']} peoples, please contact us to buy more licenses.<br />
email:<a href='mailto:Max@easysoft.ltd'>Max@easysoft.ltd</a><br />
Web:<a href='http://www.zentao.pm/'>www.zentao.pm/</a><br />
</body>
</html>");
}

if(!empty($properties['domain']))
{
    $host    = $_SERVER['HTTP_HOST'];
    $portPos = strpos($host, ':');
    if($portPos !== false) $host = substr($host, 0, $portPos);
    $host .= $_SERVER['REQUEST_URI'];

    $checkHost  = false;
    $allowHosts = explode(',', $properties['domain']['value']);
    foreach($allowHosts as $allowHost)
    {
        if(strpos($host, $allowHost) !== false)
        {
            $checkHost = true;
            break;
        }
    }
    if(!$checkHost) die("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>Error</title>
</head>
<body>
<h2 style='color:red;text-align:center'>专业版绑定域名访问错误</h2>
您版本绑定的域名是{$properties['domain']['value']}，您目前访问的域名是{$_SERVER['HTTP_HOST']}，如果有问题，请联系我们修改绑定域名。<br>
email：<a href='mailto:co@zentao.net'>co@zentao.net</a><br>
电话：4006 889923<br />
网址：<a href='http://www.zentao.net/goto.php?item=buypro'>www.zentao.net</a><br />
<br /><br /><br />
<h2 style='color:red;text-align:center'>Accounts has exceed the limit.</h2>
The binding domain is {$properties['domain']['value']}, please contact us to change binding domain.<br />
email:<a href='mailto:Max@easysoft.ltd'>Max@easysoft.ltd</a><br />
Web:<a href='http://www.zentao.pm/'>www.zentao.pm/</a><br />
</body>
</html>");
};
}
}
