<?php
/**
 * The model file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id: model.php 5118 2013-07-12 07:41:41Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
class productModel extends model
{
    /**
     *
     * Set menu.
     *
     * @param array  $products
     * @param int    $productID
     * @param int    $branch
     * @param int    $module
     * @param string $moduleType
     * @param string $extra
     *
     * @access public
     * @return void
     */
    public function setMenu($products, $productID, $branch = 0, $module = 0, $moduleType = '', $extra = '')
    {
        /* Has access privilege?. */
        if($products and !isset($products[$productID]) and !$this->checkPriv($productID))
        {
            echo(js::alert($this->lang->product->accessDenied));
            $loginLink = $this->config->requestType == 'GET' ? "?{$this->config->moduleVar}=user&{$this->config->methodVar}=login" : "user{$this->config->requestFix}login";
            if(strpos($this->server->http_referer, $loginLink) !== false) die(js::locate(inlink('index')));
            die(js::locate('back'));
        }

        $currentModule = $this->app->getModuleName();
        $currentMethod = $this->app->getMethodName();

        /* init currentModule and currentMethod for report and story. */
        if($currentModule == 'story')
        {
            if($currentMethod != 'create' and $currentMethod != 'batchcreate') $currentModule = 'product';
            if($currentMethod == 'view') $currentMethod = 'browse';
        }
        if($currentMethod == 'report') $currentMethod = 'browse';

        $selectHtml = $this->select($products, $productID, $currentModule, $currentMethod, $extra, $branch, $module, $moduleType);

        $label = $this->lang->product->index;
        if($this->config->global->flow != 'full') $label = $this->lang->product->all;
        if($currentModule == 'product' && $currentMethod == 'all')    $label = $this->lang->product->all;
        if($currentModule == 'product' && $currentMethod == 'create') $label = $this->lang->product->create;

        $pageNav  = '';
        $isMobile = $this->app->viewType == 'mhtml';
        if($isMobile)
        {
            $pageNav  = html::a(helper::createLink('product', 'index'), $this->lang->product->index) . $this->lang->colon;
            $pageNav .= $selectHtml;
        }
        else
        {
            $pageNav  = '<div class="btn-group angle-btn' . ($currentMethod == 'index' ? ' active' : '') . '"><div class="btn-group"><button data-toggle="dropdown" type="button" class="btn">' . $label . ' <span class="caret"></span></button>';
            $pageNav .= '<ul class="dropdown-menu">';
            if($this->config->global->flow == 'full' && common::hasPriv('product', 'index')) $pageNav .= '<li>' . html::a(helper::createLink('product', 'index', 'locate=no'), '<i class="icon icon-home"></i> ' . $this->lang->product->index) . '</li>';
            if(common::hasPriv('product', 'all')) $pageNav .= '<li>' . html::a(helper::createLink('product', 'all'), '<i class="icon icon-cards-view"></i> ' . $this->lang->product->all) . '</li>';
            if(common::isTutorialMode())
            {
                $wizardParams = helper::safe64Encode('');
                $link = helper::createLink('tutorial', 'wizard', "module=product&method=create&params=$wizardParams");
                $pageNav .= '<li>' . html::a($link, "<i class='icon icon-plus'></i> {$this->lang->product->create}", '', "class='create-product-btn'") . '</li>';
            }
            else
            {
                if(common::hasPriv('product', 'create')) $pageNav .= '<li>' . html::a(helper::createLink('product', 'create'), '<i class="icon icon-plus"></i> ' . $this->lang->product->create) . '</li>';
            }
            $pageNav .= '</ul></div></div>';
            $pageNav .= $selectHtml;
        }

        $pageActions = '';
        if($this->config->global->flow != 'full')
        {
            if($currentMethod == 'build' && common::hasPriv('build', 'create'))
            {
                $this->app->loadLang('build');
                $pageActions .= html::a(helper::createLink('build', 'create', "productID=$productID"), "<i class='icon icon-plus'></i> {$this->lang->build->create}", '', "class='btn btn-primary'");
            }
        }

        $this->lang->modulePageNav     = $pageNav;
        $this->lang->modulePageActions = $pageActions;
        foreach($this->lang->product->menu as $key => $menu)
        {
            $replace = $productID;
            common::setMenuVars($this->lang->product->menu, $key, $replace);
        }
    }

    /**
     * Create the select code of products.
     *
     * @param  array  $products
     * @param  int    $productID
     * @param  string $currentModule
     * @param  string $currentMethod
     * @param  string $extra
     *
     * @access public
     * @return string
     */
    public function select($products, $productID, $currentModule, $currentMethod, $extra = '', $branch = 0, $module = 0, $moduleType = '')
    {
        if(!$productID)
        {
            unset($this->lang->product->menu->branch);
            return;
        }
        $isMobile = $this->app->viewType == 'mhtml';

        setCookie("lastProduct", $productID, $this->config->cookieLife, $this->config->webRoot);
        $currentProduct = $this->getById($productID);
        $this->session->set('currentProductType', $currentProduct->type);

        $dropMenuLink = helper::createLink('product', 'ajaxGetDropMenu', "objectID=$productID&module=$currentModule&method=$currentMethod&extra=$extra");
        $output  = "<div class='btn-group angle-btn'><div class='btn-group'><button data-toggle='dropdown' type='button' class='btn btn-limit' id='currentItem' title='{$currentProduct->name}'>{$currentProduct->name} <span class='caret'></span></button><div id='dropMenu' class='dropdown-menu search-list' data-ride='searchList' data-url='$dropMenuLink'>";
        $output .= '<div class="input-control search-box has-icon-left has-icon-right search-example"><input type="search" class="form-control search-input" /><label class="input-control-icon-left search-icon"><i class="icon icon-search"></i></label><a class="input-control-icon-right search-clear-btn"><i class="icon icon-close icon-sm"></i></a></div>';
        $output .= "</div></div>";
        if($isMobile) $output = "<a id='currentItem' href=\"javascript:showSearchMenu('product', '$productID', '$currentModule', '$currentMethod', '$extra')\">{$currentProduct->name} <span class='icon-caret-down'></span></a><div id='currentItemDropMenu' class='hidden affix enter-from-bottom layer'></div>";

        if($currentProduct->type == 'normal') unset($this->lang->product->menu->branch);
        if($currentProduct->type != 'normal')
        {
            $this->lang->product->branch = sprintf($this->lang->product->branch, $this->lang->product->branchName[$currentProduct->type]);
            $this->lang->product->menu->branch = str_replace('@branch@', $this->lang->product->branchName[$currentProduct->type], $this->lang->product->menu->branch);
            $branches   = $this->loadModel('branch')->getPairs($productID);
            $branchName = isset($branches[$branch]) ? $branches[$branch] : $branches[0];
            if(!$isMobile)
            {
                $dropMenuLink = helper::createLink('branch', 'ajaxGetDropMenu', "objectID=$productID&module=$currentModule&method=$currentMethod&extra=$extra");
                $output .= "<div class='btn-group'><button id='currentBranch' data-toggle='dropdown' type='button' class='btn btn-limit'>{$branchName} <span class='caret'></span></button><div id='dropMenu' class='dropdown-menu search-list' data-ride='searchList' data-url='$dropMenuLink'>";
                $output .= '<div class="input-control search-box has-icon-left has-icon-right search-example"><input type="search" class="form-control search-input" /><label class="input-control-icon-left search-icon"><i class="icon icon-search"></i></label><a class="input-control-icon-right search-clear-btn"><i class="icon icon-close icon-sm"></i></a></div>';
                $output .= "</div></div>";
            }
            else
            {
                $output .= "<a id='currentBranch' href=\"javascript:showSearchMenu('branch', '$productID', '$currentModule', '$currentMethod', '$extra')\">{$branchName} <span class='icon-caret-down'></span></a><div id='currentBranchDropMenu' class='hidden affix enter-from-bottom layer'></div>";
            }
        }

        if($this->config->global->flow == 'onlyTest' and $moduleType)
        {
            if($module) $module = $this->loadModel('tree')->getById($module);
            $moduleName = $module ? $module->name : $this->lang->tree->all;
            if(!$isMobile)
            {
                $dropMenuLink = helper::createLink('tree', 'ajaxGetDropMenu', "objectID=$productID&module=$currentModule&method=$currentMethod&extra=$extra");
                $output .= "<div class='btn-group'><button id='currentModule' data-toggle='dropdown' type='button' class='btn btn-limit'>{$moduleName} <span class='caret'></span></button><div id='dropMenu' class='dropdown-menu search-list' data-ride='searchList' data-url='$dropMenuLink'>";
                $output .= '<div class="input-control search-box has-icon-left has-icon-right search-example"><input type="search" class="form-control search-input" /><label class="input-control-icon-left search-icon"><i class="icon icon-search"></i></label><a class="input-control-icon-right search-clear-btn"><i class="icon icon-close icon-sm"></i></a></div>';
                $output .= "</div></div>";
            }
            else
            {
                $output .= "<a id='currentModule' href=\"javascript:showSearchMenu('tree', '$productID', '$currentModule', '$currentMethod', '$extra')\">{$moduleName} <span class='icon-caret-down'></span></a><div id='currentBranchDropMenu' class='hidden affix enter-from-bottom layer'></div>";
            }
        }
        if(!$isMobile) $output .= '</div>';

        return $output;
    }

    /**
     * Save the product id user last visited to session.
     *
     * @param  int   $productID
     * @param  array $products
     * @access public
     * @return int
     */
    public function saveState($productID, $products)
    {
        if($productID > 0) $this->session->set('product', (int)$productID);
        if($productID == 0 and $this->cookie->lastProduct)    $this->session->set('product', (int)$this->cookie->lastProduct);
        if($productID == 0 and $this->session->product == '') $this->session->set('product', key($products));
        if(!isset($products[$this->session->product]))
        {
            $this->session->set('product', key($products));
            if($productID > 0)
            {
                echo(js::alert($this->lang->product->accessDenied));
                $loginLink = $this->config->requestType == 'GET' ? "?{$this->config->moduleVar}=user&{$this->config->methodVar}=login" : "user{$this->config->requestFix}login";
                if(strpos($this->server->http_referer, $loginLink) !== false) die(js::locate(inlink('index')));
                die(js::locate('back'));
            }
        }
        if($this->cookie->preProductID != $productID)
        {
            $this->cookie->set('preBranch', 0);
            setcookie('preBranch', 0, $this->config->cookieLife, $this->config->webRoot);
        }

        return $this->session->product;
    }

    /**
     * Check privilege.
     *
     * @param  int    $product
     * @access public
     * @return bool
     */
    public function checkPriv($productID)
    {
        if(empty($productID)) return false;

        /* Is admin? */
        if($this->app->user->admin) return true;
        return (strpos(",{$this->app->user->view->products},", ",{$productID},") !== false);
    }

    /**
     * Get product by id.
     *
     * @param  int    $productID
     * @access public
     * @return object
     */
    public function getById($productID)
    {
        if(defined('TUTORIAL')) return $this->loadModel('tutorial')->getProduct();
        $product = $this->dao->findById($productID)->from(TABLE_PRODUCT)->fetch();
        if(!$product) return false;

        return $this->loadModel('file')->replaceImgURL($product, 'desc');
    }

    /**
     * Get by idList.
     *
     * @param  array    $productIDList
     * @access public
     * @return array
     */
    public function getByIdList($productIDList)
    {
        return $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->in($productIDList)->fetchAll('id');
    }

    /**
     * Get products.
     *
     * @param  string $status
     * @param  int    $limit
     * @param  int    $line
     * @access public
     * @return array
     */
    public function getList($status = 'all', $limit = 0, $line = 0)
    {
        return $this->dao->select('*')->from(TABLE_PRODUCT)
            ->where('deleted')->eq(0)
            ->beginIF($line > 0)->andWhere('line')->eq($line)->fi()
            ->beginIF(!$this->app->user->admin)->andWhere('id')->in($this->app->user->view->products)->fi()
            ->beginIF($status == 'noclosed')->andWhere('status')->ne('closed')->fi()
            ->beginIF($status != 'all' and $status != 'noclosed' and $status != 'involved')->andWhere('status')->in($status)->fi()
            ->beginIF($status == 'involved')
            ->andWhere('PO', true)->eq($this->app->user->account)
            ->orWhere('QD')->eq($this->app->user->account)
            ->orWhere('RD')->eq($this->app->user->account)
            ->orWhere('createdBy')->eq($this->app->user->account)
            ->markRight(1)
            ->fi()
            ->orderBy('`order` desc')
            ->beginIF($limit > 0)->limit($limit)->fi()
            ->fetchAll('id');
    }

    /**
     * Get product pairs.
     *
     * @param  string $mode
     * @return array
     */
    public function getPairs($mode = '')
    {
        if(defined('TUTORIAL')) return $this->loadModel('tutorial')->getProductPairs();

        $orderBy  = !empty($this->config->product->orderBy) ? $this->config->product->orderBy : 'isClosed';
        $products = $this->dao->select('*,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed')
            ->from(TABLE_PRODUCT)
            ->where('deleted')->eq(0)
            ->beginIF(strpos($mode, 'noclosed') !== false)->andWhere('status')->ne('closed')->fi()
            ->beginIF(!$this->app->user->admin)->andWhere('id')->in($this->app->user->view->products)->fi()
            ->orderBy($orderBy)
            ->fetchPairs('id', 'name');
        return $products;
    }

    /**
     * Get products by project.
     *
     * @param  int    $projectID
     * @access public
     * @return array
     */
    public function getProductsByProject($projectID)
    {
        if($this->config->global->flow == 'onlyTask') return array();

        return $this->dao->select('t1.product, t2.name')
            ->from(TABLE_PROJECTPRODUCT)->alias('t1')
            ->leftJoin(TABLE_PRODUCT)->alias('t2')
            ->on('t1.product = t2.id')
            ->where('t1.project')->eq($projectID)
            ->andWhere('t2.deleted')->eq(0)
            ->orderBy('t2.order desc')
            ->fetchPairs();
    }

    /**
     * Get grouped products.
     *
     * @access public
     * @return void
     */
    public function getStatusGroups()
    {
        $products = $this->dao->select('id, name, status')->from(TABLE_PRODUCT)->where('deleted')->eq(0)->fetchGroup('status');
    }

    /**
     * Create a product.
     *
     * @access public
     * @return int
     */
    public function create()
    {
        $product = fixer::input('post')
            ->setIF($this->post->acl != 'custom', 'whitelist', '')
            ->setDefault('status', 'normal')
            ->setDefault('createdBy', $this->app->user->account)
            ->setDefault('createdDate', helper::now())
            ->setDefault('createdVersion', $this->config->version)
            ->join('whitelist', ',')
            ->stripTags($this->config->product->editor->create['id'], $this->config->allowedTags)
            ->remove('uid')
            ->get();
        $product = $this->loadModel('file')->processImgURL($product, $this->config->product->editor->create['id'], $this->post->uid);
        $this->dao->insert(TABLE_PRODUCT)->data($product)->autoCheck()
            ->batchCheck($this->config->product->create->requiredFields, 'notempty')
            ->checkIF(strlen($product->code) == 0, 'code', 'notempty') //the value of product code can be 0 or 00.00
            ->check('name', 'unique', "deleted = '0'")
            ->check('code', 'unique', "deleted = '0'")
            ->exec();

        $productID = $this->dao->lastInsertID();
        $this->file->updateObjectID($this->post->uid, $productID, 'product');
        $this->dao->update(TABLE_PRODUCT)->set('`order`')->eq($productID * 5)->where('id')->eq($productID)->exec();

        /* Create doc lib. */
        $this->app->loadLang('doc');
        $lib = new stdclass();
        $lib->product = $productID;
        $lib->name    = $this->lang->doclib->main['product'];
        $lib->type    = 'product';
        $lib->main    = '1';
        $lib->acl     = $product->acl == 'open' ? 'open' : 'private';
        $this->dao->insert(TABLE_DOCLIB)->data($lib)->exec();
        $this->loadModel('user')->updateUserView($productID, 'product');

        return $productID;
    }

    /**
     * Update a product.
     *
     * @param  int    $productID
     * @access public
     * @return array
     */
    public function update($productID)
    {
        $productID  = (int)$productID;
        $oldProduct = $this->dao->findById($productID)->from(TABLE_PRODUCT)->fetch();
        $product = fixer::input('post')
            ->setIF($this->post->acl != 'custom', 'whitelist', '')
            ->join('whitelist', ',')
            ->stripTags($this->config->product->editor->edit['id'], $this->config->allowedTags)
            ->remove('uid')
            ->get();
        $product = $this->loadModel('file')->processImgURL($product, $this->config->product->editor->edit['id'], $this->post->uid);
        $this->dao->update(TABLE_PRODUCT)->data($product)->autoCheck()
            ->batchCheck($this->config->product->edit->requiredFields, 'notempty')
            ->checkIF(strlen($product->code) == 0, 'code', 'notempty') //the value of product code can be 0 or 00.0
            ->check('name', 'unique', "id != $productID and deleted = '0'")
            ->check('code', 'unique', "id != $productID and deleted = '0'")
            ->where('id')->eq($productID)
            ->exec();
        if(!dao::isError())
        {
            if($product->acl != $oldProduct->acl) $this->dao->update(TABLE_DOCLIB)->set('acl')->eq($product->acl == 'open' ? 'open' : 'private')->where('product')->eq($productID)->exec();

            $this->file->updateObjectID($this->post->uid, $productID, 'product');
            if($product->acl != $oldProduct->acl or $product->whitelist != $oldProduct->whitelist) $this->loadModel('user')->updateUserView($productID, 'product');
            return common::createChanges($oldProduct, $product);
        }
    }

    /**
     * Batch update products.
     *
     * @access public
     * @return void
     */
    public function batchUpdate()
    {
        $products    = array();
        $allChanges  = array();
        $data        = fixer::input('post')->get();
        $oldProducts = $this->getByIdList($this->post->productIDList);
        foreach($data->productIDList as $productID)
        {
            $productID = (int)$productID;
            $products[$productID] = new stdClass();
            $products[$productID]->name   = $data->names[$productID];
            $products[$productID]->code   = $data->codes[$productID];
            $products[$productID]->PO     = $data->POs[$productID];
            $products[$productID]->QD     = $data->QDs[$productID];
            $products[$productID]->RD     = $data->RDs[$productID];
            $products[$productID]->type   = $data->types[$productID];
            $products[$productID]->line   = $data->lines[$productID];
            $products[$productID]->status = $data->statuses[$productID];
            $products[$productID]->desc   = strip_tags($this->post->descs[$productID], $this->config->allowedTags);
            $products[$productID]->order  = $data->orders[$productID];
        }

        foreach($products as $productID => $product)
        {
            $oldProduct = $oldProducts[$productID];
            $this->dao->update(TABLE_PRODUCT)
                ->data($product)
                ->autoCheck()
                ->batchCheck($this->config->product->edit->requiredFields , 'notempty')
                ->checkIF(strlen($product->code) == 0, 'code', 'notempty') //the value of product code can be 0 or 00.0
                ->check('name', 'unique', "id != $productID and deleted = '0'")
                ->check('code', 'unique', "id != $productID and deleted = '0'")
                ->where('id')->eq($productID)
                ->exec();
            if(dao::isError()) die(js::error('product#' . $productID . dao::getError(true)));
            $allChanges[$productID] = common::createChanges($oldProduct, $product);
        }
        $this->fixOrder();
        return $allChanges;
    }

    /**
     * Close product.
     *
     * @param  int    $productID.
     * @access public
     * @return void
     */
    public function close($productID)
    {
        $oldProduct = $this->getById($productID);
        $now        = helper::now();
        $product= fixer::input('post')
            ->setDefault('status', 'closed')
            ->remove('comment')->get();

        $this->dao->update(TABLE_PRODUCT)->data($product)
            ->autoCheck()
            ->where('id')->eq((int)$productID)
            ->exec();

        if(!dao::isError()) return common::createChanges($oldProduct, $product);
    }

    /**
     * Get stories.
     *
     * @param  int    $productID
     * @param  int    $branch
     * @param  string $browseType
     * @param  int    $queryID
     * @param  int    $moduleID
     * @param  string $sort
     * @param  object $pager
     * @access public
     * @return array
     */
    public function getStories($productID, $branch, $browseType, $queryID, $moduleID, $sort, $pager)
    {
        if(defined('TUTORIAL')) return $this->loadModel('tutorial')->getStories();

        $this->loadModel('story');

        /* Set modules and browse type. */
        $modules    = $moduleID ? $this->loadModel('tree')->getAllChildID($moduleID) : '0';
        $browseType = ($browseType == 'bymodule' and $this->session->storyBrowseType and $this->session->storyBrowseType != 'bysearch') ? $this->session->storyBrowseType : $browseType;

        /* Get stories by browseType. */
        $stories = array();
        if($browseType == 'unclosed')
        {
            $unclosedStatus = $this->lang->story->statusList;
            unset($unclosedStatus['closed']);
            $stories = $this->story->getProductStories($productID, $branch, $modules, array_keys($unclosedStatus), $sort, $pager);
        }
        if($browseType == 'unplan')       $stories = $this->story->getByPlan($productID, $queryID, $modules, '', $sort, $pager);
        if($browseType == 'allstory')     $stories = $this->story->getProductStories($productID, $branch, $modules, 'all', $sort, $pager);
        if($browseType == 'bymodule')     $stories = $this->story->getProductStories($productID, $branch, $modules, 'all', $sort, $pager);
        if($browseType == 'bysearch')     $stories = $this->story->getBySearch($productID, $queryID, $sort, $pager, '', $branch);
        if($browseType == 'assignedtome') $stories = $this->story->getByAssignedTo($productID, $branch, $modules, $this->app->user->account, $sort, $pager);
        if($browseType == 'openedbyme')   $stories = $this->story->getByOpenedBy($productID, $branch, $modules, $this->app->user->account, $sort, $pager);
        if($browseType == 'reviewedbyme') $stories = $this->story->getByReviewedBy($productID, $branch, $modules, $this->app->user->account, $sort, $pager);
        if($browseType == 'closedbyme')   $stories = $this->story->getByClosedBy($productID, $branch, $modules, $this->app->user->account, $sort, $pager);
        if($browseType == 'draftstory')   $stories = $this->story->getByStatus($productID, $branch, $modules, 'draft', $sort, $pager);
        if($browseType == 'activestory')  $stories = $this->story->getByStatus($productID, $branch, $modules, 'active', $sort, $pager);
        if($browseType == 'changedstory') $stories = $this->story->getByStatus($productID, $branch, $modules, 'changed', $sort, $pager);
        if($browseType == 'willclose')    $stories = $this->story->get2BeClosed($productID, $branch, $modules, $sort, $pager);
        if($browseType == 'closedstory')  $stories = $this->story->getByStatus($productID, $branch, $modules, 'closed', $sort, $pager);

        return $stories;
    }

    /**
     * Batch get story stage.
     *
     * @param  array  $stories.
     * @access public
     * @return array
     */
    public function batchGetStoryStage($stories)
    {
        /* Set story id list. */
        $storyIdList = array();
        foreach($stories as $story) $storyIdList[$story->id] = $story->id;

        return $this->loadModel('story')->batchGetStoryStage($storyIdList);
    }

    /**
     * Build search form.
     *
     * @param  int    $productID
     * @param  array  $products
     * @param  int    $queryID
     * @param  int    $actionURL
     * @access public
     * @return void
     */
    public function buildSearchForm($productID, $products, $queryID, $actionURL)
    {
        $this->config->product->search['actionURL'] = $actionURL;
        $this->config->product->search['queryID']   = $queryID;
        $this->config->product->search['params']['plan']['values']    = $this->loadModel('productplan')->getPairs($productID);
        $this->config->product->search['params']['product']['values'] = array($productID => $products[$productID], 'all' => $this->lang->product->allProduct);
        $this->config->product->search['params']['module']['values']  = $this->loadModel('tree')->getOptionMenu($productID, $viewType = 'story', $startModuleID = 0);
        if($this->session->currentProductType == 'normal')
        {
            unset($this->config->product->search['fields']['branch']);
            unset($this->config->product->search['params']['branch']);
        }
        else
        {
            $this->config->product->search['fields']['branch'] = $this->lang->product->branch;
            $this->config->product->search['params']['branch']['values']  = array('' => '') + $this->loadModel('branch')->getPairs($productID, 'noempty') + array('all' => $this->lang->branch->all);
        }

        $this->loadModel('search')->setSearchParams($this->config->product->search);
    }

    /**
     * Get projects of a product in pairs.
     *
     * @param  int    $productID
     * @param  string $param    all|nodeleted
     * @access public
     * @return array
     */
    public function getProjectPairs($productID, $branch = 0, $param = 'all')
    {
        $projects = array();
        $datas = $this->dao->select('t2.id, t2.name, t2.deleted')->from(TABLE_PROJECTPRODUCT)
            ->alias('t1')->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->where('t1.product')->eq((int)$productID)
            ->beginIF($branch)->andWhere('t1.branch')->in($branch)->fi()
            ->beginIF(!$this->app->user->admin)->andWhere('t2.id')->in($this->app->user->view->projects)->fi()
            ->andWhere('t2.deleted')->eq(0)
            ->orderBy('t1.project desc')
            ->fetchAll();

        foreach($datas as $data)
        {
            if($param == 'nodeleted' and $data->deleted) continue;
            $projects[$data->id] = $data->name;
        }
        $projects = array('' => '') +  $projects;
        return $projects;
    }

    /**
     * Get roadmap of a proejct
     *
     * @param  int    $productID
     * @param  int    $branch
     * @param  int    $count
     * @access public
     * @return array
     */
    public function getRoadmap($productID, $branch = 0, $count = 0)
    {
        $plans    = $this->loadModel('productplan')->getList($productID, $branch);
        $releases = $this->loadModel('release')->getList($productID, $branch);
        $roadmap  = array();
        $total    = 0;

        foreach($plans as $plan)
        {
            if(($plan->end != '0000-00-00' and strtotime($plan->end) - time() <= 0) or $plan->end == '2030-01-01') continue;
            $year = substr($plan->end, 0, 4);
            $roadmap[$year][$plan->branch][] = $plan;

            $total++;
        }

        if($count > 0 and $total >= $count)
        {
            krsort($roadmap);
            return $this->sliceRoadmap($roadmap, $count);
        }

        foreach($releases as $release)
        {
            $year = substr($release->date, 0, 4);
            $roadmap[$year][$release->branch][] = $release;

            $total++;
            if($count > 0 and $total >= $count) break;
        }

        krsort($roadmap);
        if($count > 0) return $this->sliceRoadmap($roadmap, $count);

        $groupRoadmap = array();
        foreach($roadmap as $year => $branchRoadmaps)
        {
            foreach($branchRoadmaps as $branch => $roadmaps)
            {
                $totalData = count($roadmaps);
                $rows      = ceil($totalData / 8);
                $maxPerRow = ceil($totalData / $rows);

                $groupRoadmap[$year][$branch] = array_chunk($roadmaps, $maxPerRow);
                foreach($groupRoadmap[$year][$branch] as $row => $rowRoadmaps) krsort($groupRoadmap[$year][$branch][$row]);
            }
        }

        /* Get last 5 roadmap. */
        $lastKeys    = array_slice(array_keys($groupRoadmap), 0, 5);
        $lastRoadmap = array();
        $lastRoadmap['total'] = 0;
        foreach($lastKeys as $key)
        {
            if($key == '2030')
            {
                $lastRoadmap[$this->lang->productplan->future] = $groupRoadmap[$key];
            }
            else
            {
                $lastRoadmap[$key] = $groupRoadmap[$key];
            }

            foreach($groupRoadmap[$key] as $branchRoadmaps) $lastRoadmap['total'] += (count($branchRoadmaps, 1) - count($branchRoadmaps));
        }

        return $lastRoadmap;
    }

    /**
     * Slice roadmap.
     *
     * @param  string $roadmap
     * @param  int    $count
     * @access public
     * @return array
     */
    public function sliceRoadmap($roadmap, $count)
    {
        $i = 0;
        $newRoadmap = array();
        foreach($roadmap as $year => $branches)
        {
            foreach($branches as $branch => $plans)
            {
                krsort($plans);
                foreach($plans as $plan)
                {
                    $newRoadmap[$year][$branch][] = $plan;
                    $i++;
                    if($i >= $count) break;
                }
            }
        }
        return $newRoadmap;
    }

    /**
     * Get team members of a product from projects.
     *
     * @param  object   $product
     * @access public
     * @return array
     */
    public function getTeamMemberPairs($product)
    {
        $members[$product->PO] = $product->PO;
        $members[$product->QD] = $product->QD;
        $members[$product->RD] = $product->RD;
        $members[$product->createdBy] = $product->createdBy;

        /* Set projects and teams as static thus we can only query sql one times. */
        static $projects, $teams;
        if(empty($projects))
        {
            $projects = $this->dao->select('t1.project, t1.product')->from(TABLE_PROJECTPRODUCT)->alias('t1')
                ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
                ->where('t2.deleted')->eq(0)
                ->fetchGroup('product', 'project');
        }
        if(empty($teams))
        {
            $teams = $this->dao->select('t1.root, t1.account')->from(TABLE_TEAM)->alias('t1')
                ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.root = t2.id')
                ->where('t2.deleted')->eq(0)
                ->andWhere('t1.type')->eq('project')
                ->fetchGroup('root', 'account');
        }

        if(!isset($projects[$product->id])) return $members;
        $productProjects = $projects[$product->id];

        $projectTeams = array();
        foreach(array_keys($productProjects) as $projectID) $projectTeams = array_merge($projectTeams, array_keys($teams[$projectID]));

        return array_flip(array_merge($members, $projectTeams));
    }

    /**
     * Get product stat by id
     *
     * @param  int    $productID
     * @access public
     * @return object|bool
     */
    public function getStatByID($productID)
    {
        if(!$this->checkPriv($productID)) return false;
        $product = $this->getById($productID);
        $stories = $this->dao->select('product, status, count(status) AS count')->from(TABLE_STORY)->where('deleted')->eq(0)->andWhere('product')->eq($productID)->groupBy('product, status')->fetchAll('status');
        /* Padding the stories to sure all status have records. */
        foreach(array_keys($this->lang->story->statusList) as $status)
        {
            $stories[$status] = isset($stories[$status]) ? $stories[$status]->count : 0;
        }

        $plans    = $this->dao->select('count(*) AS count')->from(TABLE_PRODUCTPLAN)->where('deleted')->eq(0)->andWhere('product')->eq($productID)->andWhere('end')->gt(helper::now())->fetch();
        $builds   = $this->dao->select('count(*) AS count')->from(TABLE_BUILD)->where('deleted')->eq(0)->andWhere('product')->eq($productID)->fetch();
        $cases    = $this->dao->select('count(*) AS count')->from(TABLE_CASE)->where('deleted')->eq(0)->andWhere('product')->eq($productID)->fetch();
        $bugs     = $this->dao->select('count(*) AS count')->from(TABLE_BUG)->where('deleted')->eq(0)->andWhere('product')->eq($productID)->fetch();
        $docs     = $this->dao->select('count(*) AS count')->from(TABLE_DOC)->where('deleted')->eq(0)->andWhere('product')->eq($productID)->fetch();
        $releases = $this->dao->select('count(*) AS count')->from(TABLE_RELEASE)->where('deleted')->eq(0)->andWhere('product')->eq($productID)->fetch();
        $projects = $this->dao->select('count("t1.*") AS count')->from(TABLE_PROJECTPRODUCT)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->where('t2.deleted')->eq(0)
            ->andWhere('t1.product')->eq($productID)
            ->fetch();

        $product->stories  = $stories;
        $product->plans    = $plans    ? $plans->count : 0;
        $product->releases = $releases ? $releases->count : 0;
        $product->builds   = $builds   ? $builds->count : 0;
        $product->cases    = $cases    ? $cases->count : 0;
        $product->projects = $projects ? $projects->count : 0;
        $product->bugs     = $bugs     ? $bugs->count : 0;
        $product->docs     = $docs     ? $docs->count : 0;

        return $product;
    }

    /**
     * Get product stats.
     *
     * @param  string $orderBy
     * @param  object $pager
     * @param  string $status
     * @param  int    $line
     * @access public
     * @return array
     */
    public function getStats($orderBy = 'order_desc', $pager = null, $status = 'noclosed', $line = 0)
    {
        $this->loadModel('report');
        $this->loadModel('story');
        $this->loadModel('bug');

        $products = $this->getList($status, $limit = 0, $line);
        $products = $this->dao->select('*')->from(TABLE_PRODUCT)
            ->where('id')->in(array_keys($products))
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('id');

        $stories = $this->dao->select('product, status, count(status) AS count')
            ->from(TABLE_STORY)
            ->where('deleted')->eq(0)
            ->andWhere('product')->in(array_keys($products))
            ->groupBy('product, status')
            ->fetchGroup('product', 'status');

        /* Padding the stories to sure all products have records. */
        $emptyStory = array_keys($this->lang->story->statusList);
        foreach(array_keys($products) as $productID)
        {
            if(!isset($stories[$productID])) $stories[$productID] = $emptyStory;
        }

        /* Padding the stories to sure all status have records. */
        foreach($stories as $key => $story)
        {
            foreach(array_keys($this->lang->story->statusList) as $status)
            {
                $story[$status] = isset($story[$status]) ? $story[$status]->count : 0;
            }
            $stories[$key] = $story;
        }

        $plans = $this->dao->select('product, count(*) AS count')
            ->from(TABLE_PRODUCTPLAN)
            ->where('deleted')->eq(0)
            ->andWhere('product')->in(array_keys($products))
            ->andWhere('end')->gt(helper::now())
            ->groupBy('product')
            ->fetchPairs();

        $releases = $this->dao->select('product, count(*) AS count')
            ->from(TABLE_RELEASE)
            ->where('deleted')->eq(0)
            ->andWhere('product')->in(array_keys($products))
            ->groupBy('product')
            ->fetchPairs();

        $bugs = $this->dao->select('product,count(*) AS conut')
            ->from(TABLE_BUG)
            ->where('deleted')->eq(0)
            ->andWhere('product')->in(array_keys($products))
            ->groupBy('product')
            ->fetchPairs();
        $unResolved = $this->dao->select('product,count(*) AS count')
            ->from(TABLE_BUG)
            ->where('deleted')->eq(0)
            ->andwhere('status')->eq('active')
            ->andWhere('product')->in(array_keys($products))
            ->groupBy('product')
            ->fetchPairs();
        $assignToNull = $this->dao->select('product,count(*) AS count')
            ->from(TABLE_BUG)
            ->where('deleted')->eq(0)
            ->andwhere('assignedTo')->eq('')
            ->andWhere('product')->in(array_keys($products))
            ->groupBy('product')
            ->fetchPairs();

        $stats = array();
        foreach($products as $key => $product)
        {
            $product->stories  = $stories[$product->id];
            $product->plans    = isset($plans[$product->id])    ? $plans[$product->id]    : 0;
            $product->releases = isset($releases[$product->id]) ? $releases[$product->id] : 0;

            $product->bugs         = isset($bugs[$product->id]) ? $bugs[$product->id] : 0;
            $product->unResolved   = isset($unResolved[$product->id]) ? $unResolved[$product->id] : 0;
            $product->assignToNull = isset($assignToNull[$product->id]) ? $assignToNull[$product->id] : 0;
            $stats[] = $product;
        }

        return $stats;
    }

    /**
     * Get the summary of product's stories.
     *
     * @param  array    $stories
     * @access public
     * @return string.
     */
    public function summary($stories)
    {
        $totalEstimate = 0.0;
        $storyIdList   = array();

        foreach($stories as $key => $story)
        {
            $totalEstimate += $story->estimate;
            /* When the status is not closed or closedReason is done or postponed then add cases rate..*/
            if(
                $story->status != 'closed' or
                ($story->status == 'closed' and ($story->closedReason == 'done' or $story->closedReason == 'postponed'))
            )
            {
                $storyIdList[] = $story->id;
            }
        }

        $cases = $this->dao->select('DISTINCT story')->from(TABLE_CASE)->where('story')->in($storyIdList)->andWhere('deleted')->eq(0)->fetchAll();
        $rate  = count($stories) == 0 ? 0 : round(count($cases) / count($stories), 2);

        return sprintf($this->lang->product->storySummary, count($stories), $totalEstimate, $rate * 100 . "%");
    }

    /**
     * Judge an action is clickable or not.
     *
     * @param  object $product
     * @param  string $action
     * @access public
     * @return void
     */
    public static function isClickable($product, $action)
    {
        $action = strtolower($action);

        if($action == 'close') return $product->status != 'closed';

        return true;
    }

    /**
     * Create the link from module,method,extra
     *
     * @param  string  $module
     * @param  string  $method
     * @param  mix     $extra
     * @access public
     * @return void
     */
    public function getProductLink($module, $method, $extra, $branch = false)
    {
        $link = '';
        if(strpos('product,roadmap,bug,testcase,testtask,story,qa,testsuite,testreport,build', $module) !== false)
        {
            if($module == 'product' && $method == 'project')
            {
                $link = helper::createLink($module, $method, "status=all&productID=%s" . ($branch ? "&branch=%s" : ''));
            }
            elseif($module == 'product' && ($method == 'dynamic' or $method == 'doc' or $method == 'view'))
            {
                $link = helper::createLink($module, $method, "productID=%s");
            }
            elseif($module == 'qa' && $method == 'index')
            {
                $link = helper::createLink('bug', 'browse', "productID=%s" . ($branch ? "&branch=%s" : ''));
            }
            elseif($module == 'product' && ($method == 'browse' or $method == 'index' or $method == 'all'))
            {
                $link = helper::createLink($module, 'browse', "productID=%s" . ($branch ? "&branch=%s" : ''));
            }
            else
            {
                $link = helper::createLink($module, $method, "productID=%s" . ($branch ? "&branch=%s" : ''));
            }
        }
        else if($module == 'productplan' || $module == 'release')
        {
            if($method != 'browse' && $method != 'create') $method = 'browse';
            $link = helper::createLink($module, $method, "productID=%s" . ($branch ? "&branch=%s" : ''));
        }
        else if($module == 'tree')
        {
            $link = helper::createLink($module, $method, "productID=%s&type=$extra&currentModuleID=0" . ($branch ? "&branch=%s" : ''));
        }
        else if($module == 'branch')
        {
            $link = helper::createLink($module, $method, "productID=%s");
        }
        else if($module == 'doc')
        {
            $link = helper::createLink('doc', 'objectLibs', "type=product&objectID=%s&from=product");
        }

        return $link;
    }

    /**
     * Fix order.
     *
     * @access public
     * @return void
     */
    public function fixOrder()
    {
        $products = $this->dao->select('id,`order`')->from(TABLE_PRODUCT)->orderBy('order')->fetchPairs('id', 'order');

        $i = 0;
        foreach($products as $id => $order)
        {
            $i++;
            $newOrder = $i * 5;
            if($order == $newOrder) continue;
            $this->dao->update(TABLE_PRODUCT)->set('`order`')->eq($newOrder)->where('id')->eq($id)->exec();
        }
    }

    /**
     * get the latest project of the product.
     *
     * @param  int     $productID
     * @access public
     * @return object
     */
    public function getLatestProject($productID)
    {
        return $this->dao->select('t2.id, t2.name')->from(TABLE_PROJECTPRODUCT)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->where('t1.product')->eq((int)$productID)
            ->andWhere('t2.status')->ne('closed')
            ->andWhere('t2.deleted')->eq('0')
            ->orderBy('t2.begin desc')
            ->limit(1)
            ->fetch();
    }
}
