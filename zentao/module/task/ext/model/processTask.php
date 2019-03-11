<?php
function processTask($task)
{
    $today = helper::today();

    /* Delayed or not?. */
    if($task->status !== 'done' and $task->status !== 'cancel' and $task->status != 'closed')
    {
        if($task->deadline != '0000-00-00')
        {
            $delay = helper::diffDate($today, $task->deadline);
            if($delay > 0) $task->delay = $delay;
        }
    }

    /* Story changed or not. */
    $task->needConfirm = false;
    if(!empty($task->storyStatus) and $task->storyStatus == 'active' and $task->latestStoryVersion > $task->storyVersion) $task->needConfirm = true;

    /* Set product type for task. */
    if(isset($task->product))
    {
        $product = $this->loadModel('product')->getById($task->product);
        $task->productType = $product->type;
    }

    /* Set closed realname. */
    if($task->assignedTo == 'closed') $task->assignedToRealName = 'Closed';

    /* Compute task progress. */
    if($task->consumed == 0 and $task->left == 0)
    {
        $task->progress = 0;
    }
    elseif($task->consumed != 0 and $task->left == 0)
    {
        $task->progress = 100;
    }
    else
    {
        $task->progress = round($task->consumed / ($task->consumed + $task->left), 2) * 100;
    }

    return $task;
}