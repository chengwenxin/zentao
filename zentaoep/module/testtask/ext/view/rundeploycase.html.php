<?php include '../../../common/view/header.lite.html.php';?>
<?php include '../../../common/view/form.html.php';?>
<?php js::set('caseResultSave', $lang->save);?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2>
      <span class='label label-id'><?php echo $run->case->id;?></span>
      <?php echo $run->case->title;?>
      <small class='text-muted'> <?php echo $lang->testtask->runCase;?> <?php echo html::icon($lang->icons['run']);?></small>
    </h2>
  </div>
  <div class='main'>
    <form method='post' enctype='multipart/form-data' id='dataform' data-type='ajax'>
      <table class='table table-bordered table-form' style='word-break:break-all' id='steps'>
        <thead>
          <tr>
            <td colspan='5' style='word-break: break-all;'><strong><?php echo $lang->testcase->precondition;?></strong> <?php echo $run->case->precondition;?></td>
          </tr>
          <tr>
            <th class='w-40px'><?php echo $lang->testcase->stepID;?></th>
            <th class='w-p30'><?php  echo $lang->testcase->stepDesc;?></th>
            <th class='w-p30'><?php  echo $lang->testcase->stepExpect;?></th>
            <th class='w-100px'><?php echo $lang->testcase->result;?></th>
            <th><?php echo $lang->testcase->real;?></th>
          </tr>
        </thead>
        <?php
        if(empty($run->case->steps))
        {
            $step = new stdclass();
            $step->id     = 0;
            $step->parent = 0;
            $step->case   = $run->case->id;
            $step->type   = 'step';
            $step->desc   = '';
            $step->expect = '';
            $run->case->steps[] = $step;
        }
        $stepId = $childId = 0;
        ?>
        <?php foreach($run->case->steps as $key => $step):?>
        <?php
        $stepClass = "step-{$step->type}";
        if($step->type == 'group' or $step->type == 'step')
        {
            $stepId++;
            $childId = 0;
        }
        ?>
        <tr class='step <?php echo $stepClass?>'>
          <th class='step-id'><?php echo $stepId;?></th>
          <td class='text-left' <?php if($step->type == 'group') echo "colspan='4'"?>>
            <div class='input-group'>
            <?php if($step->type == 'item') echo "<span class='step-item-id'>{$stepId}.{$childId}</span>";?>
            <?php echo nl2br($step->desc);?>
            </div>
          </td>
          <?php if($step->type != 'group'):?>
          <td class='text-left'><?php echo nl2br($step->expect);?></td>
          <td class='text-center'><?php echo html::select("steps[$step->id]", $lang->testcase->resultList, 'pass', "class='form-control'");?></td>
          <td>
            <div class='table-row'>
              <div class='table-col'><?php echo html::textarea("reals[$step->id]", '', "rows=1 class='form-control autosize'");?></div>
              <div class='table-col w-50px'><button type='button' title='<?php echo $lang->testtask->files?>' class='btn' data-toggle='modal' data-target='#fileModal<?php echo $step->id?>'><i class='icon icon-paper-clip'></i></button></div>
            </div>
          </td>
          <?php endif;?>
        </tr>
        <?php $childId ++;?>
        <?php endforeach;?>
        <tr>
          <td colspan='5' class='text-center form-actions'>
            <?php
            if($preCase)  echo html::a(inlink('runDeployCase', "deployID={$deployID}&caseID={$preCase['caseID']}&version={$preCase['version']}"), $lang->testtask->pre, '', "id='pre' class='btn'");
            echo html::submitButton();
            if($nextCase)  echo html::a(inlink('runDeployCase', "deployID={$deployID}&caseID={$nextCase['caseID']}&version={$nextCase['version']}"), $lang->testtask->next, '', "id='next' class='btn'");
            echo html::hidden('deploy',  $deployID);
            echo html::hidden('case',    $run->case->id);
            echo html::hidden('version', $run->case->currentVersion);
            ?>
            <ul id='filesName' class='nav'></ul>
          </td>
        </tr>
      </table>
      <?php foreach($run->case->steps as $key => $step):?>
      <div class="modal fade" id="fileModal<?php echo $step->id;?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title"><?php echo $lang->testtask->files;?></h4>
            </div>
            <div class="modal-body">
              <table class='table table-form'>
                <tr>
                  <td><?php echo $this->fetch('file', 'buildform', array('fileCount' => 1, 'percent' => 0.9, 'filesName' => "files{$step->id}", 'labelsName' => "labels{$step->id}"));?></td>
                </tr>
                <tr>
                  <td class='text-center'><button type="button" class="btn btn-default" onclick='loadFilesName()' data-dismiss="modal" aria-hidden="true"><?php echo $lang->save;?></button></td>
                <tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </form>
  </div>
  <div class='main' id='resultsContainer'>
  </div>
</div>
<script>
$(function()
{
    $('#resultsContainer').load("<?php echo $this->createLink('testtask', 'deployCaseResults', "deployID={$deployID}&caseID=$caseID&version=$version");?> #casesResults", function()
    {
        $('.result-item').click(function()
        {
            var $this = $(this);
            $this.toggleClass('show-detail');
            var show = $this.hasClass('show-detail');
            $this.next('.result-detail').toggleClass('hide', !show);
            $this.find('.collapse-handle').toggleClass('icon-chevron-down', !show).toggleClass('icon-chevron-up', show);;
        });

        $('#casesResults table caption .result-tip').html($('#resultTip').html());
    });

    $("form[data-type='ajax']").unbind('submit');
    $.ajaxForm("form[data-type='ajax']", function(response)
    {
        if(response.locate)
        {
            if(response.locate == 'reload' && response.target == 'parent')
            {
                parent.$.cookie('selfClose', 1);
                parent.$.closeModal(null, 'this');
            }
            else if(response.next)
            {
                location.href = response.locate;
            }
        }
    });
});
<?php
$sessionString  = $config->requestType == 'PATH_INFO' ? '?' : '&';
$sessionString .= session_name() . '=' . session_id();
?>
var sessionString = '<?php echo $sessionString;?>';
</script>
<?php include '../../../common/view/footer.lite.html.php';?>
