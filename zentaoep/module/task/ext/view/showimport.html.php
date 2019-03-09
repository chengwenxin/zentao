<?php include '../../../common/view/header.html.php';?>
<style>
.affix {position:fixed; top:0px; width:95.6%;z-index:10000;}
</style>
<?php if(isset($suhosinInfo)):?>
<div class='alert alert-info'><?php echo $suhosinInfo?></div>
<?php else:?>
<div id="mainContent" class="main-content">
  <div class="main-header clearfix">
    <h2><?php echo $lang->task->import;?></h2>
  </div>
  <form class='main-form' target='hiddenwin' method='post'>
    <table class='table table-form' id='showData'>
      <thead>
        <tr>
          <th class='w-70px'><?php echo $lang->task->id?></th>
          <th class='w-150px'><?php echo $lang->task->name?></th>
          <th class='w-150px'><?php echo $lang->task->module?></th>
          <th class='w-150px'><?php echo $lang->task->story?></th>
          <th class='w-70px'><?php echo $lang->task->pri?></th>
          <th class='w-90px'><?php echo $lang->task->type?></th>
          <th class='w-80px'><?php echo $lang->task->estimate?></th>
          <th class='w-120px'><?php echo $lang->task->estStarted?></th>
          <th class='w-120px'><?php echo $lang->task->deadline?></th>
          <th><?php echo $lang->task->desc?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $insert = true;
        $addID  = 1;
        ?>
        <?php foreach($taskData as $key => $task):?>
        <tr class='text-top'>
          <td>
            <?php
            if(!empty($task->id))
            {
                echo $task->id . html::hidden("id[$key]", $task->id);
                $insert = false;
            }
            else
            {
                $sub = (strpos($task->name, '>') === 0) ? " <sub style='vertical-align:sub;color:red'>{$lang->task->children}</sub>" : " <sub style='vertical-align:sub;color:gray'>{$lang->task->new}</sub>";
                echo $addID++ . $sub;
            }
            echo html::hidden("project[$key]", $projectID);
            ?>
          </td>
          <td><?php echo html::input("name[$key]", htmlspecialchars($task->name, ENT_QUOTES), "class='form-control'")?></td>
          <td style='overflow:visible'><?php echo html::select("module[$key]", $modules, !empty($task->module) ? $task->module : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->module : ''), "class='form-control chosen'")?></td>
          <td style='overflow:visible'><?php echo html::select("story[$key]", $stories, !empty($task->story) ? $task->story : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->story : ''), "class='form-control chosen'")?></td>
          <td><?php echo html::select("pri[$key]", $lang->task->priList, !empty($task->pri) ? $task->pri : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->pri : ''), "class='form-control'")?></td>
          <td><?php echo html::select("type[$key]", $lang->task->typeList, !empty($task->type) ? $task->type : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->type : ''), "class='form-control'")?></td>
          <td><?php echo html::input("estimate[$key]", !empty($task->estimate) ? $task->estimate : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->estimate : ''), "class='form-control' autocomplete='off'")?></td>
          <td><?php echo html::input("estStarted[$key]", !empty($task->estStarted) ? $task->estStarted : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->estStarted : ''), "class='form-control form-date'")?></td>
          <td><?php echo html::input("deadline[$key]", !empty($task->deadline) ? $task->deadline : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->deadline : ''), "class='form-control form-date'")?></td>
          <td><?php echo html::textarea("desc[$key]", $task->desc, "class='form-control' cols='50' rows='1'")?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan='10' class='text-center form-actions'>
            <?php
            if(!$insert)
            {
              echo "<button type='button' data-toggle='modal' data-target='#importNoticeModal' class='btn btn-primary btn-wide'>{$lang->save}</button>";
            }
            else
            {   
                echo html::submitButton();
            }   
            echo html::backButton();
            ?>  
          </td>
        </tr>
      </tfoot>
    </table>
    <?php if(!$insert) include '../../../common/view/noticeimport.html.php';?>
  </form>
</div>
<?php endif;?>
<script>
$(function(){$.fixedTableHead('#showData');});
</script>
<?php include '../../../common/view/footer.html.php';?>
