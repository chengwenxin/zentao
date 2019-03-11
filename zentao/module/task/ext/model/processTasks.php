<?php
 function processTasks($tasks)
    {
        foreach($tasks as $task)
        {
            $task = $this->processTask($task);
            if(!empty($task->children))
            {
                foreach($task->children as $child) 
                {
                    $tasks[$task->id]->children[$child->id] = $this->processTask($child);
                }
            }
        }
        return $tasks;
    }
?>

