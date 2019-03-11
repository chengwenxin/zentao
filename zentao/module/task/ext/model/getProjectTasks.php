   <?php
     function getProjectTasks($projectID, $productID = 0, $type = 'all', $modules = 0, $orderBy = 'status_asc, id_desc', $pager = null)
    {
        //demand3 参数：项目ID，产品ID，类型，模块，排序方式，分页
        //全部搞成小写
        if(is_string($type)) $type = strtolower($type);     
        // $type: array (
        //     0 => '',
        //     1 => 'wait',
        //     2 => 'doing',
        //     3 => 'done',
        //     4 => 'pause',
        //     5 => 'cancel',
        //   )

       //$task  获得满足条件的所有记录，并使用字段id作为索引值。此时获取的是parent<1的记录
        $tasks = $this->dao->select('DISTINCT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName')
            ->from(TABLE_TASK)->alias('t1')
            ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
            ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
            ->leftJoin(TABLE_TEAM)->alias('t4')->on('t4.root = t1.id')
            ->leftJoin(TABLE_MODULE)->alias('t5')->on('t1.module = t5.id')
            ->where('t1.project')->eq((int)$projectID)
            ->beginIF($type == 'all' || is_array($type))->andWhere('t1.parent')->lt(1)->fi()
            ->beginIF($type == 'myinvolved')
            ->andWhere("((t4.`account` = '{$this->app->user->account}' AND t4.`type` = 'task') OR t1.`assignedTo` = '{$this->app->user->account}' OR t1.`finishedby` = '{$this->app->user->account}')")
            ->fi()
            ->beginIF($productID)->andWhere("((t5.root=" . (int)$productID . " and t5.type='story') OR t2.product=" . (int)$productID . ")")->fi()
            ->beginIF($type == 'undone')->andWhere("(t1.status = 'wait' or t1.status ='doing')")->fi()
            ->beginIF($type == 'needconfirm')->andWhere('t2.version > t1.storyVersion')->andWhere("t2.status = 'active'")->fi()
            ->beginIF($type == 'assignedtome')->andWhere('t1.assignedTo')->eq($this->app->user->account)->fi()
            ->beginIF($type == 'finishedbyme')
            ->andWhere('t1.finishedby', 1)->eq($this->app->user->account)
            ->orWhere('t1.finishedList')->like("%,{$this->app->user->account},%")
            ->markRight(1)
            ->fi()
            ->beginIF($type == 'delayed')->andWhere('t1.deadline')->gt('1970-1-1')->andWhere('t1.deadline')->lt(date(DT_DATE1))->andWhere('t1.status')->in('wait,doing')->fi()
            ->beginIF(is_array($type) or strpos(',all,undone,needconfirm,assignedtome,delayed,finishedbyme,myinvolved,', ",$type,") === false)->andWhere('t1.status')->in($type)->fi()
            ->beginIF($modules)->andWhere('t1.module')->in($modules)->fi()
            ->andWhere('t1.deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager, 't1.id')
            ->fetchAll('id');

            // 巧妙的console.log()技巧          
            $myfile = fopen("./tasks.txt", "w");
            fwrite($myfile, var_export($tasks, true));
            fclose($myfile);

         //调用common模块的saveQueryCondition方法 保存一个已经执行的查询   ？？？保存到哪里去了？   此时的$type是 包含 doing  wait  pause cancel 名称的数组
        $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'task', ($productID or in_array($type, array('myinvolved', 'needconfirm'))) ? false : true);
        
        //如果父任务都为空  则返回空数组
        if(empty($tasks)) return array();


        $taskList = array_keys($tasks);
        $taskTeam = $this->dao->select('*')->from(TABLE_TEAM)->where('root')->in($taskList)->andWhere('type')->eq('task')->fetchGroup('root');
        if(!empty($taskTeam))
        {
            //将team添加到$task->team属性下
            foreach($taskTeam as $taskID => $team) $tasks[$taskID]->team = $team;
        }

        $parents = array();
        foreach($tasks as $task)
        {
            // 将所有parent属性为-1的id 添加到$parents数组中
            if($task->parent == -1) $parents[] = $task->id;
        }
        if(!empty($parents))
        {
            /* Select children task. */
            $children = $this->dao->select('DISTINCT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName')
                ->from(TABLE_TASK)->alias('t1')
                ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
                ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
                ->leftJoin(TABLE_MODULE)->alias('t4')->on('t1.module = t4.id')
                ->where('t1.parent')->in($parents)
                ->andWhere('t1.deleted')->eq(0)
                ->beginIF($productID)->andWhere("((t4.root=" . (int)$productID . " and t4.type='story') OR t2.product=" . (int)$productID . ")")->fi()
                ->beginIF($type == 'undone')->andWhere("(t1.status = 'wait' or t1.status ='doing')")->fi()
                ->beginIF($type == 'needconfirm')->andWhere('t2.version > t1.storyVersion')->andWhere("t2.status = 'active'")->fi()
                ->beginIF($type == 'assignedtome')->andWhere('t1.assignedTo')->eq($this->app->user->account)->fi()
                ->beginIF($type == 'finishedbyme')
                ->andWhere('t1.finishedby', 1)->eq($this->app->user->account)
                ->orWhere('t1.finishedList')->like("%,{$this->app->user->account},%")
                ->markRight(1)
                ->fi()
                ->beginIF($type == 'delayed')->andWhere('t1.deadline')->gt('1970-1-1')->andWhere('t1.deadline')->lt(date(DT_DATE1))->andWhere('t1.status')->in('wait,doing')->fi()
                ->beginIF(is_array($type) or strpos(',all,undone,needconfirm,assignedtome,delayed,finishedbyme,myinvolved,', ",$type,") === false)->andWhere('t1.status')->in($type)->fi()
                ->beginIF($modules)->andWhere('t1.module')->in($modules)->fi()
                ->orderBy("t1.$orderBy")
                ->fetchAll('id');
            
            if(!empty($children))
            {
                foreach($children as $child)
                {
                    $tasks[$child->parent]->children[$child->id] = $child;
                }
            }
        }

        //判断一下父任务是否为空
        foreach($tasks as $task)
        {
            if($task->parent > 0)
            {
                //判断父任务是否为空
                if(isset($tasks[$task->parent]))
                {
                    $tasks[$task->parent]->children[$task->id] = $task;
                    unset($tasks[$task->id]);
                }
            }
        }
        // 巧妙的console.log()技巧          
$myfile = fopen("./tasksbef.txt", "w");
fwrite($myfile, var_export($tasks, true));
fclose($myfile);



 // 巧妙的console.log()技巧          
 $myfile = fopen("./tasksaf.txt", "w");
 fwrite($myfile, var_export($this->processTasks($tasks), true));
 fclose($myfile);

//  processTasks处理后  
//  父任务
//  'needConfirm' => false,
//  'productType' => 'normal',
//  'progress' => 0,
// 子任务
// 'needConfirm' => false,
// 'progress' => 0,

        //将包含有新增team、children属性的所有父任务记录返回
        return $this->processTasks($tasks);
    }
?>