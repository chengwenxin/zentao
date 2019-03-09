<div class='panel'>
  <div class='panel-heading'>
    <div class='panel-title'><?php echo $lang->crystal->sql?></div>
  </div>
  <form method='post' action='<?php echo inlink('custom', "step=1&reportID=$reportID")?>' target='hiddenwin' class='sqlForm'>
    <div style='padding: 10px'>
      <?php echo html::textarea('sql', ($step == 0 and $reportID == 0 and !$this->session->reportSQLError) ? '' : $this->session->reportSQL, "placeholder='{$lang->crystal->sqlPlaceholder}' class='form-control' rows='3'")?>
      <?php if($this->session->reportSQLError) $this->session->set('reportSQLError', false);?>
      <?php if($hasSqlVar):?>
      <div class='row' style='padding-top: 10px'><?php include 'setvarvalues.html.php'?></div>
      <?php endif;?>
    </div>
    <div style='padding: 0 10px 10px;'>
      <?php echo html::submitButton($lang->crystal->query, '', 'btn btn-primary')?>
      <?php echo html::commonButton($lang->crystal->addVar, '', "btn addVar")?>
      <?php echo html::a(inlink('ajaxSetLang', "reportID=$reportID"), $lang->crystal->addLang, '',  "class='btn' data-toggle='modal' data-type='iframe'")?>
      <?php
      if(common::hasPriv('report', 'saveReport'))
      {
          $save = $lang->save;
          echo "<div class='btn-group'>";
          if($reportID)
          {
              echo html::a(inlink('saveReport', "reportID=$reportID&step=$step"), $lang->save, 'hiddenwin', "class='btn'");
              $save = $lang->crystal->saveAs;
          }
          echo html::a(inlink('saveReport', "reportID=0&step=$step"), $save, '', "class='btn' data-type='iframe' data-toggle='modal'");
          echo '</div>';
      }
      ?>
    </div>
  </form>
</div>

<div id='setVar' class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog w-800px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><i class="icon-file-text"></i> <?php echo $lang->crystal->setVar?></h4>
      </div>
      <div class="modal-body">
        <form method='post' action='<?php echo inlink('ajaxCheckVar', "reportID=$reportID")?>' target='hiddenwin' class='main-form'>
          <table class='table active-disabled'>
            <thead>
              <tr class='text-center'>
                <th class='w-80px'><?php echo $lang->crystal->varName?></th>
                <th><?php echo $lang->crystal->showName?></th>
                <th class='w-p50'><?php echo $lang->crystal->requestType?></th>
                <th class='w-120px'><?php echo $lang->crystal->default?></th>
              </tr>
            </thead>
            <tbody class='text-center'>
              <tr>
                <td><span></span><?php echo html::hidden('varName[]', '')?></td>
                <td><?php echo html::input('showName[]', '', "class='form-control'")?></td>
                <td>
                  <div class='input-group'>
                    <span class='input-group-addon' style='text-align:left'>
                    <?php echo html::radio('requestType[]', $lang->crystal->requestTypeList, '', "onchange='toggleSelectList(this)'")?>
                    </span>
                    <?php echo html::select('selectList[]', $lang->crystal->selectList, '', "class='form-control hidden'");?>
                  </div>
                </td>
                <td><?php echo html::input('default[]', '', "class='form-control'")?></td>
              </tr>
            </tbody>
            <tfoot>
              <tr><td colspan='2' class='text-center'><?php echo html::submitButton() . html::hidden('varType', 'set')  . html::textarea('copySql', '', "class='hidden'")?></td></tr>
            </tfoot>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>

<div id='addVar' class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog w-900px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><i class="icon-file-text"></i> <?php echo $lang->crystal->setVar?></h4>
      </div>
      <div class="modal-body">
        <form method='post' action='<?php echo inlink('ajaxCheckVar', "reportID=$reportID")?>' target='hiddenwin' class='main-form'>
          <table class='table table-form'>
            <thead>
              <tr class='text-center'>
                <th class='w-80px'><?php echo $lang->crystal->varName?></th>
                <th><?php echo $lang->crystal->showName?></th>
                <th class='w-p50'><?php echo $lang->crystal->requestType?></th>
                <th class='w-120px'><?php echo $lang->crystal->default?></th>
              </tr>
            </thead>
            <tbody class='text-center'>
              <tr>
                <td><?php echo html::input('varName[]', '', "class='form-control'")?></td>
                <td><?php echo html::input('showName[]', '', "class='form-control'")?></td>
                <td>
                  <div class='input-group'>
                    <span class='input-group-addon' style='text-align:left'>
                    <?php echo html::radio('requestType[]', $lang->crystal->requestTypeList, '', "onchange='toggleSelectList(this)'")?>
                    </span>
                    <?php echo html::select('selectList[]', $lang->crystal->selectList, '', "class='form-control hidden'");?>
                  </div>
                </td>
                <td><?php echo html::input('default[]', '', "class='form-control'")?></td>
              </tr>
            </tbody>
            <tfoot>
              <tr><td colspan='4' class='text-center'><?php echo html::submitButton() . html::hidden('varType', 'add') . html::textarea('copySql', '', "class='hidden'")?></td></tr>
            </tfoot>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
