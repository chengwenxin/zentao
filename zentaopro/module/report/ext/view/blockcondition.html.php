<div class='panel'>
  <div class='panel-heading'>
    <div class='panel-title'><?php echo $lang->crystal->condition?></div>
  </div>
  <form action='<?php echo inlink('custom', "step=2&reportID=$reportID")?>' target='hiddenwin' method='post' class='main-form'>
    <table class='table table-form'>
      <tr>
        <th class='w-80px'><?php echo $lang->crystal->group?></th>
        <td style='overflow: visible'>
          <div class='input-group'>
            <span class='input-group-addon'><?php echo $lang->crystal->group1?></span>
            <?php echo html::select('group1', $fields, empty($condition['group1']) ? '' : $condition['group1'], "class='form-control chosen'")?>
            <span class='input-group-addon'>
              <div class='checkbox-primary'>
              <?php echo html::checkbox('isUser[group1]', array('1' => $lang->crystal->isUser), empty($condition['isUser']['group1']) ? '' : 1)?>
              </div>
            </span>
          </div>
        </td>
        <td style='overflow: visible'>
          <div class='input-group'>
            <span class='input-group-addon'><?php echo $lang->crystal->group2?></span>
            <?php echo html::select('group2', array('' => '') + $fields, empty($condition['group2']) ? '' : $condition['group2'], "class='form-control chosen'")?>
            <span class='input-group-addon'>
              <div class='checkbox-primary'>
              <?php echo html::checkbox('isUser[group2]', array('1' => $lang->crystal->isUser), empty($condition['isUser']['group2']) ? '' : 1)?>
              </div>
            </span>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->crystal->statistics?></th>
        <td colspan='2' style='overflow:visible'>
          <table class='table table-fixed table-form table-condensed'>
            <thead class='text-center'>
              <tr>
                <th><?php echo $lang->crystal->reportField?></th>
                <th class='w-250px'><?php echo $lang->crystal->reportType?></th>
                <th class='w-70px'><?php echo $lang->crystal->reportTotal?></th>
                <th><?php echo $lang->crystal->percent?></th>
                <th class='w-100px'></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style='overflow: visible'>
                  <div class='input-group'>
                    <?php echo html::select('reportField[]', $fields, empty($condition['reportField'][0]) ? '' : $condition['reportField'][0], "class='form-control chosen'")?>
                    <span class='input-group-addon'>
                      <div class='checkbox-primary'>
                      <?php echo html::checkbox('isUser[reportField][0]', array('1' => $lang->crystal->isUser), empty($condition['isUser']['reportField'][0]) ? '' : 1)?>
                      </div>
                    </span>
                  </div>
                </td>
                <td style='overflow: visible'>
                  <div class='input-group'>
                    <?php echo html::select('reportType[]', $lang->crystal->reportTypeList, empty($condition['reportType'][0]) ? '' : $condition['reportType'][0], "class='form-control' onchange='toggleSumAppend(this)'")?>
                    <span class="input-group-addon fix-border fix-padding"></span>
                    <?php echo html::select('sumAppend[]', array('' => $lang->crystal->sumPlaceholder) + $fields, empty($condition['sumAppend'][0]) ? '' : $condition['sumAppend'][0], "class='form-control " . (empty($condition['reportType'][0]) ? 'hidden' : ($condition['reportType'][0] == 'count' ? 'hidden' : '')) . "'")?>
                  </div>
                </td>
                <td class='text-center'>
                  <div class='checkbox-primary' style='margin-left:20px'>
                    <input type='checkbox' name='reportTotal[0]' value=1 <?php echo empty($condition['reportTotal'][0]) ? '' : 'checked'?> />
                    <label></label>
                  </div>
                </td>
                <td class='text-center' style='overflow: visible'>
                  <div class='input-group'>
                    <span class='input-group-addon'>
                      <div class='checkbox-primary'>
                        <input type='checkbox' name='percent[0]' value=1 <?php echo empty($condition['percent'][0]) ? '' : 'checked'?> onchange='toggleContrast(this)'/>
                        <label></label>
                      </div>
                    </span>
                    <?php $class = empty($condition['percent'][0]) ? 'disabled' : '';?>
                    <span class='input-group-addon'><?php echo $lang->crystal->contrast?></span>
                    <?php echo html::select('contrast[0]', array('' => '') + $fields + array('crystalTotal' => $lang->report->total), empty($condition['contrast'][0]) ? '' : $condition['contrast'][0], "class='form-control contrastField' $class");?>
                    <span class='input-group-addon'>
                      <div class='checkbox-primary'>
                        <input type='checkbox' name='showAlone[0]' value=1 class='contrastField' <?php echo $class?> <?php echo empty($condition['showAlone'][0]) ? '' : 'checked'?> />
                        <label><?php echo $lang->crystal->showAlone;?></label>
                      </div>
                    </span>
                  </div>
                </td>
                <td>
                  <div class='btn-group'>
                    <?php echo html::a('javascript:;', '<i class="icon-plus"></i>', '', "onclick='addField(this)' class='btn'")?></a>
                    <?php echo html::a('javascript:;', '<i class="icon-close"></i>', '', "onclick='deleteField(this)' class='btn'")?></a>
                  </div>
                </td>
              </tr>
              <?php if(!empty($condition['reportField']) and count($condition['reportField']) >= 2):?>
              <?php for($i = 1; $i < count($condition['reportField']); $i++):?>
              <tr>
                <td style='overflow: visible'>
                  <div class='input-group'>
                    <?php echo html::select("reportField[]", $fields, empty($condition['reportField'][$i]) ? '' : $condition['reportField'][$i], "class='form-control chosen'")?>
                    <span class='input-group-addon'>
                      <div class='checkbox-primary'>
                        <?php echo html::checkbox("isUser[reportField][$i]", array('1' => $lang->crystal->isUser), empty($condition['isUser']['reportField'][$i]) ? '' : 1)?>
                      </div>
                    </span>
                  </div>
                </td>
                <td style='overflow: visible'>
                  <div class='input-group'>
                    <?php echo html::select("reportType[]", $lang->crystal->reportTypeList, empty($condition['reportType'][$i]) ? '' : $condition['reportType'][$i], "class='form-control' onchange='toggleSumAppend(this)'")?>
                    <span class="input-group-addon fix-border fix-padding"></span>
                    <?php echo html::select("sumAppend[]", $fields, empty($condition['sumAppend'][$i]) ? '' : $condition['sumAppend'][$i], "class='form-control " . (empty($condition['reportType'][$i]) ? 'hidden' : ($condition['reportType'][$i] == 'count' ? 'hidden' : '')) . "'")?>
                  </div>
                </td>
                <td class='text-center'>
                  <div class='checkbox-primary' style='margin-left:20px'>
                    <input type='checkbox' name='reportTotal[<?php echo $i?>]' value=1 <?php echo empty($condition['reportTotal'][$i]) ? '' : 'checked'?> />
                    <label></label>
                  </div>
                </td>
                <td class='text-center' style='overflow: visible'>
                  <div class='input-group'>
                    <span class='input-group-addon'>
                      <div class='checkbox-primary'>
                        <input type='checkbox' name='percent[<?php echo $i?>]' value=1 <?php echo empty($condition['percent'][$i]) ? '' : 'checked'?>  onchange='toggleContrast(this)'/>
                        <label></label>
                      </div>
                    </span>
                    <?php $class = empty($condition['percent'][$i]) ? 'disabled' : '';?>
                    <span class='input-group-addon'>
                      <?php echo $lang->crystal->contrast?>
                    </span>
                    <?php echo html::select("contrast[$i]", array('' => '') + $fields + array('crystalTotal' => $lang->report->total), empty($condition['contrast'][$i]) ? '' : $condition['contrast'][$i], "class='form-control contrastField' $class");?>
                    <span class='input-group-addon'>
                      <div class='checkbox-primary'>
                        <input type='checkbox' name='showAlone[<?php echo $i?>]' class='contrastField' <?php echo $class?> value=1 <?php echo empty($condition['showAlone'][$i]) ? '' : 'checked'?> />
                        <label><?php echo $lang->crystal->showAlone?></label>
                      </div>
                    </span>
                  </div>
                </td>
                <td>
                  <div class='btn-group'>
                    <?php echo html::a('javascript:;', '<i class="icon-plus"></i>', '', "onclick='addField(this)' class='btn'")?></a>
                    <?php echo html::a('javascript:;', '<i class="icon-close"></i>', '', "onclick='deleteField(this)' class='btn'")?></a>
                  </div>
                </td>
              </tr>
              <?php endfor;?>
              <?php endif;?>
            </tbody>
          </table>
        </td>
      </tr>
      <tr><td colspan='3' class='text-center'><?php echo html::submitButton($lang->confirm);?></td></tr>
    </table>
  </form>
</div>
