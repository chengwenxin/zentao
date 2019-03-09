<?php
/**
 * The control file of tree module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     tree
 * @version     $Id: control.php 5002 2013-07-03 08:25:39Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
class tree extends control
{
    const NEW_CHILD_COUNT = 5;

    /**
     * Module browse.
     * 
     * @param  int    $rootID 
     * @param  string $viewType         story|bug|case|doc
     * @param  int    $currentModuleID 
     * @access public
     * @return void
     */
    public function browse($rootID, $viewType, $currentModuleID = 0, $branch = 0)
    {
        $this->loadModel('product');

        /* According to the type, set the module root and modules. */
        if(strpos('story|bug|case', $viewType) !== false)
        {
            $product = $this->product->getById($rootID);
            if(empty($product)) $this->locate($this->createLink('product', 'create'));
            if(!empty($product->type) && $product->type != 'normal')
            {
                $branches = $this->loadModel('branch')->getPairs($product->id);
                if($currentModuleID)
                {
                    $branchName = $branches[$branch];
                    unset($branches);
                    $branches[$branch] = $branchName;
                }
                $this->view->branches = $branches;
            }
            $this->view->root = $product;
        }
        elseif(strpos($viewType, 'doc') !== false)
        {
            /* The viewType is doc. */
            $this->loadModel('doc');
            $viewType = 'doc';
            $lib      = $this->doc->getLibById($rootID);
            $this->view->root = $lib;
        }
        elseif(strpos($viewType, 'caselib') !== false)
        {
            $this->loadModel('testsuite');
            $lib = $this->testsuite->getById($rootID);
            $this->view->root = $lib;
        }

        if($viewType == 'story')
        {
            $this->lang->set('menugroup.tree', 'product');
            $this->product->setMenu($this->product->getPairs(), $rootID, $branch, 'story', '', 'story');
            $this->lang->tree->menu      = $this->lang->product->menu;
            $this->lang->tree->menuOrder = $this->lang->product->menuOrder;

            $products = $this->product->getPairs();
            unset($products[$rootID]);
            $currentProduct = key($products);

            $this->view->allProduct     = $products;
            $this->view->currentProduct = $currentProduct;
            $this->view->productModules = $this->tree->getOptionMenu($currentProduct, 'story');

            $title      = $this->lang->tree->manageProduct;
            $position[] = html::a($this->createLink('product', 'browse', "product=$rootID"), $product->name);
            $position[] = $this->lang->tree->manageProduct;
        }
        elseif($viewType == 'bug')
        {
            $this->loadModel('bug')->setMenu($this->product->getPairs(), $rootID);
            $this->lang->tree->menu      = $this->lang->bug->menu;
            $this->lang->tree->menuOrder = $this->lang->bug->menuOrder;
            if($this->config->global->flow == 'onlyTest') $this->lang->set('menugroup.tree', 'bug');
            if($this->config->global->flow != 'onlyTest') $this->lang->set('menugroup.tree', 'qa');

            $title      = $this->lang->tree->manageBug;
            $position[] = html::a($this->createLink('bug', 'browse', "product=$rootID"), $product->name);
            $position[] = $this->lang->tree->manageBug;
        }
        elseif($viewType == 'case')
        {
            $this->loadModel('testcase')->setMenu($this->product->getPairs(), $rootID);
            $this->lang->tree->menu      = $this->lang->testcase->menu;
            $this->lang->tree->menuOrder = $this->lang->testcase->menuOrder;
            if($this->config->global->flow == 'onlyTest') $this->lang->set('menugroup.tree', 'testcase');
            if($this->config->global->flow != 'onlyTest') $this->lang->set('menugroup.tree', 'qa');

            $title      = $this->lang->tree->manageCase;
            $position[] = html::a($this->createLink('testcase', 'browse', "product=$rootID"), $product->name);
            $position[] = $this->lang->tree->manageCase;
        }
        elseif($viewType == 'caselib')
        {
            $this->testsuite->setLibMenu($this->testsuite->getLibraries(), $rootID);
            $this->lang->tree->menu      = $this->lang->testsuite->menu;
            $this->lang->tree->menuOrder = $this->lang->testsuite->menuOrder;
            $this->lang->set('menugroup.tree', 'qa');

            $title      = $this->lang->tree->manageCaseLib;
            $position[] = html::a($this->createLink('testsuite', 'library', "libID=$rootID"), $lib->name);
            $position[] = $this->lang->tree->manageCaseLib;
        }
        elseif(strpos($viewType, 'doc') !== false)
        {
            $type = $lib->product ? 'product' : ($lib->project ? 'project' : 'custom');
            $this->doc->setMenu($type, $rootID, $currentModuleID);
            $this->lang->tree->menu      = $this->lang->doc->menu;
            $this->lang->tree->menuOrder = $this->lang->doc->menuOrder;
            $this->lang->set('menugroup.tree', 'doc');

            $title      = $this->lang->tree->manageCustomDoc;
            $position[] = html::a($this->createLink('doc', 'browse', "libID=$rootID"), $lib->name);
            $position[] = $this->lang->tree->manageCustomDoc;
        }
        elseif($viewType == 'line')
        {
            $this->lang->set('menugroup.tree', 'product');
            $this->product->setMenu($this->product->getPairs(), $rootID, $branch, 'line', '', 'line');
            $this->lang->tree->menu      = $this->lang->product->menu;
            $this->lang->tree->menuOrder = $this->lang->product->menuOrder;

            $products = $this->product->getPairs();
            unset($products[$rootID]);
            $currentProduct = key($products);

            $this->view->allProduct     = $products;
            $this->view->currentProduct = $currentProduct;
            $this->view->productModules = $this->tree->getOptionMenu($currentProduct, 'line');

            $title      = $this->lang->tree->manageLine;
            $position[] = $this->lang->tree->manageLine;
        }

        $parentModules = $this->tree->getParents($currentModuleID);
        $this->view->title           = $title;
        $this->view->position        = $position;
        $this->view->rootID          = $rootID;
        $this->view->viewType        = $viewType;
        $this->view->modules         = $this->tree->getTreeMenu($rootID, $viewType, $rooteModuleID = 0, array('treeModel', 'createManageLink'));
        $this->view->sons            = $this->tree->getSons($rootID, $currentModuleID, $viewType, $branch);
        $this->view->currentModuleID = $currentModuleID;
        $this->view->parentModules   = $parentModules;
        $this->view->branch          = $branch;
        $this->view->tree            = $this->tree->getProductStructure($rootID, $viewType);
        $this->display();
    }

    /**
     * Browse task module.
     * 
     * @param  int    $rootID 
     * @param  int    $productID 
     * @param  int    $currentModuleID 
     * @access public
     * @return void
     */
    public function browseTask($rootID, $productID = 0, $currentModuleID = 0)
    {
        $project = $this->loadModel('project')->getById($rootID);
        $this->view->root = $project;

        $products = $this->project->getProducts($rootID);
        $this->view->products = $products;

        $this->lang->set('menugroup.tree', 'project');
        $this->project->setMenu($this->project->getPairs(), $rootID);
        $this->lang->tree->menu      = $this->lang->project->menu;
        $this->lang->tree->menuOrder = $this->lang->project->menuOrder;

        $projects = $this->project->getPairs();
        unset($projects[$rootID]);
        $currentProject = key($projects);
        $parentModules  = $this->tree->getParents($currentModuleID);
        $newModule      = (version_compare($project->openedVersion, '4.1', '>') and $products) ? true : false;

        $title      = $this->lang->tree->manageProject;
        $position[] = html::a($this->createLink('project', 'task', "projectID=$rootID"), $project->name);
        $position[] = $this->lang->tree->manageProject;

        $this->view->title           = $title;
        $this->view->position        = $position;
        $this->view->rootID          = $rootID;
        $this->view->productID       = $productID;
        $this->view->allProject      = $projects;
        $this->view->newModule       = $newModule;
        $this->view->currentProject  = $currentProject;
        $this->view->projectModules  = $this->tree->getTaskOptionMenu($currentProject, $productID);
        $this->view->modules         = $this->tree->getTaskTreeMenu($rootID, $productID, $rooteModuleID = 0, array('treeModel', 'createTaskManageLink'));
        $this->view->sons            = $this->tree->getTaskSons($rootID, $productID, $currentModuleID);
        $this->view->parentModules   = $parentModules;
        $this->view->currentModuleID = $currentModuleID;
        $this->view->tree            = $this->tree->getTaskStructure($rootID, $productID);
        $this->display();
    } 

    /**
     * Edit a module.
     * 
     * @param  int    $moduleID 
     * @access public
     * @return void
     */
    public function edit($moduleID, $type, $branch = 0)
    {
        if(!empty($_POST))
        {
            $this->tree->update($moduleID);
            echo js::alert($this->lang->tree->successSave);
            die(js::reload('parent'));
        }

        $module = $this->tree->getById($moduleID);
        if($module->owner == null and $module->root != 0 and $module->type != 'task' and $type != 'doc')
        {
            $module->owner = $this->loadModel('product')->getById($module->root)->QD;
        }

        if($type == 'task')
        {
            $optionMenu = $this->tree->getTaskOptionMenu($module->root);
            $this->view->optionMenu = $optionMenu;
        }
        else
        {
            $this->view->optionMenu = $this->tree->getOptionMenu($module->root, $module->type, 0, $branch);
        }

        $this->view->module = $module;
        $this->view->type   = $type;
        $this->view->libs   = $this->loadModel('doc')->getLibs($type = 'all', $extra = 'withObject');
        $this->view->branch = $branch;
        $this->view->users  = $this->loadModel('user')->getPairs('noclosed|nodeleted', $module->owner);

        $showProduct = strpos('story|bug|case', $type) !== false ? true : false;
        $this->view->showProduct = $showProduct;
        if($showProduct) $this->view->products = $this->loadModel('product')->getPairs();

        /* Remove self and childs from the $optionMenu. Because it's parent can't be self or childs. */
        $childs = $this->tree->getAllChildId($moduleID);
        foreach($childs as $childModuleID) unset($this->view->optionMenu[$childModuleID]);

        die($this->display());
    }

    /**
     * Fix path, grades.
     * 
     * @param  string    $root 
     * @param  string    $type 
     * @access public
     * @return void
     */
    public function fix($root, $type)
    {
        $this->tree->fixModulePath($root, $type);
        die(js::alert($this->lang->tree->successFixed) . js::reload('parent'));
    }

    /**
     * Update modules' orders.
     * 
     * @access public
     * @return void
     */
    public function updateOrder()
    {
        if(!empty($_POST))
        {
            $this->tree->updateOrder($_POST['orders']);
            die(js::reload('parent'));
        }
    }

    /**
     * Manage child modules.
     * 
     * @param  int    $rootID 
     * @param  string $viewType 
     * @access public
     * @return void
     */
    public function manageChild($rootID, $viewType)
    {
        if(!empty($_POST))
        {
            $this->tree->manageChild($rootID, $viewType);

            if(isonlybody()) die(js::closeModal('parent.parent', '', "function(){parent.parent.$('a.refresh').click()}"));

            die(js::reload('parent'));
        }
    }

    /**
     * Delete a module.
     * 
     * @param  int    $rootID 
     * @param  int    $moduleID 
     * @param  string $confirm  yes|no
     * @access public
     * @return void
     */
    public function delete($rootID, $moduleID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            $module = $this->tree->getByID($moduleID);
            $confirmLang = $module->type == 'line' ? $this->lang->tree->confirmDeleteLine : $this->lang->tree->confirmDelete;
            die(js::confirm($confirmLang, $this->createLink('tree', 'delete', "rootID=$rootID&moduleID=$moduleID&confirm=yes")));
        }
        else
        {
            $result = $this->tree->delete($moduleID);
            if(!$result) die();

            die(js::reload('parent'));
        }
    }

    /**
     * AJAX: Get the option menu of modules.
     * 
     * @param  int    $rootID 
     * @param  string $viewType
     * @param  int    $branch
     * @param  int    $rootModuleID
     * @param  string $returnType
     * @param  string $fieldID
     * @param  bool   $needManage
     * @access public
     * @return string the html select string.
     */
    public function ajaxGetOptionMenu($rootID, $viewType = 'story', $branch = 0, $rootModuleID = 0, $returnType = 'html', $fieldID = '', $needManage = false)
    {
        if($viewType == 'task')
        {
            $optionMenu = $this->tree->getTaskOptionMenu($rootID); 
        }
        else
        {
            $optionMenu = $this->tree->getOptionMenu($rootID, $viewType, $rootModuleID, $branch);
        }
        if($returnType == 'html')
        {
            //Code for task #5081.
            if($viewType == 'line')
            {
                $lineID = $this->dao->select('id')->from(TABLE_MODULE)->where('type')->eq('line')->andWhere('deleted')->eq(0)->orderBy('id_desc')->limit(1)->fetch('id');
                $output = html::select("line", $optionMenu, $lineID, "class='form-control'");
                $output .=  "<span class='input-group-addon' style='border-radius: 0px 2px 2px 0px; border-right-width: 1px;'>";
                $output .= html::a($this->createLink('tree', 'browse', "rootID=$rootID&view=$viewType&currentModuleID=0&branch=$branch", '', true), $viewType == 'line' ? $this->lang->tree->manageLine : $this->lang->tree->manage, '', "class='text-primary' data-toggle='modal' data-type='iframe' data-width='95%'");
                $output .= '</span>';
            }
            else
            {
                $changeFunc = '';
                if($viewType == 'task' or $viewType == 'bug' or $viewType == 'case') $changeFunc = "onchange='loadModuleRelated()'";
                $field = $fieldID ? "modules[$fieldID]" : 'module';
                $output = html::select("$field", $optionMenu, '', "class='form-control' $changeFunc");
                if(count($optionMenu) == 1 and $needManage)
                {
                    $output .=  "<span class='input-group-addon'>";
                    $output .= html::a($this->createLink('tree', 'browse', "rootID=$rootID&view=$viewType&currentModuleID=0&branch=$branch", '', true), $this->lang->tree->manage, '', "class='text-primary' data-toggle='modal' data-type='iframe' data-width='95%'");
                    $output .= '&nbsp; ';
                    $output .= html::a("javascript:void(0)", $this->lang->refresh, '', "class='refresh' onclick='loadProductModules($rootID)'");
                    $output .= '</span>';
                }
            }

            die($output);
        }
        if($returnType == 'mhtml')
        {
            $changeFunc = '';
            if($viewType == 'task' or $viewType == 'bug' or $viewType == 'case') $changeFunc = "onchange='loadModuleRelated()'";
            $field = $fieldID ? "modules[$fieldID]" : 'module';
            $output = html::select("$field", $optionMenu, '', "class='input' $changeFunc");
            die($output);
        }
        if($returnType == 'json') die(json_encode($optionMenu));
    }

    /**
     * Ajax get drop menu.
     * 
     * @param  int    $rootID 
     * @param  string $module 
     * @param  string $method 
     * @param  string $extra 
     * @access public
     * @return void
     */
    public function ajaxGetDropMenu($rootID, $module, $method, $extra = '')
    {
        $this->view->productID = $rootID;
        $this->view->module    = $module;
        $this->view->method    = $method;
        $this->view->extra     = $extra;

        if($module == 'bug') $viewType = 'bug';
        if($module == 'testcase')  $viewType = 'case';
        if($module == 'testsuite') $viewType = 'caselib';

        $modules = $this->tree->getOptionMenu($rootID, $viewType);
        $modulesPinyin = common::convert2Pinyin($modules);

        $this->view->link          = $viewType == 'caselib' ? helper::createLink($module, $method, "rootID=%s&type=byModule&param=%s") : helper::createLink($module, $method, "rootID=%s&branch=&type=byModule&param=%s");
        $this->view->viewType      = $viewType;
        $this->view->modules       = $modules;
        $this->view->modulesPinyin = $modulesPinyin;
        $this->display();
    }

    /**
     * AJAX: get modules.
     *
     * @param  int    $productID
     * @param  string $viewType
     * @param  int    $branchID
     * @param  int    $number
     * @access public
     * @return string the html select string.
     */
    public function ajaxGetModules($productID, $viewType = 'story', $branchID, $number)
    {
        $modules = $this->tree->getOptionMenu($productID, $viewType, $startModuleID = 0, $branchID);

        $moduleName = $viewType == 'bug' ? "modules[$number]" : "module[$number]";
        $modules    = empty($modules) ? array('' => '') : $modules;
        die(html::select($moduleName, $modules, '', 'class=form-control'));
    }

    /**
     * AJAX: get a module's son modules.
     * 
     * @param  int    $moduleID 
     * @param  int    $rootID 
     * @param  string $type
     * @access public
     * @return string json_encoded modules.
     */
    public function ajaxGetSonModules($moduleID, $rootID = 0, $type = 'story')
    {
        $modules = $this->dao->select('id,name,short')->from(TABLE_MODULE)
            ->where('root')->eq($rootID)
            ->andWhere('parent')->eq((int)$moduleID)
            ->andWhere('type')->eq($type)
            ->andWhere('deleted')->eq(0)
            ->fetchAll('id');
        die(json_encode($modules));
    }
}
