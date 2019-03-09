<?php
/**
 * The reportData view file of report module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2014 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     report
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php
$sqlLangs   = json_decode($this->session->sqlLangs, true);
$clientLang = $this->app->getClientLang();
?>
<table class='reportData table table-condensed table-striped table-bordered table-fixed datatable' style='width: auto; min-width: 100%' data-fixed-left-width='400'>
  <thead>
    <tr>
      <th data-flex='false' data-width='auto' class="text-center"><?php echo $fields[$condition['group1']]?></th>
      <?php if($condition['group2']):?>
      <th data-flex='false' data-width='auto' class="text-center"><?php echo $fields[$condition['group2']]?></th>
      <?php endif;?>
      <?php
      /* Set dataCols. */
      $dataCols = array();
      foreach($headers as $i => $reportFields)
      {
          $showed[$i] = false;
          foreach($reportFields as $reportField)
          {
              if(isset($headerNames[$i]))
              {
                  foreach($headerNames[$i] as $key => $headerName)
                  {
                      echo "<th data-flex='true' data-type='number' data-width='80' class='text-center'>" . (empty($headerName) ? $lang->report->null : $headerName) . '</th>';
                      $percentKey = (empty($key) ? 'null' : $key) . 'Percent';
                      if(isset($condition['percent'][$i]) and isset($condition['showAlone'][$i]) and $condition['contrast'][$i] != 'crystalTotal') echo "<th data-flex='true' data-type='number' data-width='80'>" . (isset($sqlLangs[$percentKey][$clientLang]) ? $sqlLangs[$percentKey][$clientLang] : $lang->crystal->percentAB) . "</th>";
                      $dataCols[$i][] = $key;
                  }
                  $showed[$i] = true;
              }
              elseif(isset($condition['isUser']['reportField'][$i]))
              {
                  $user = zget($users, $reportField, $reportField);
                  echo "<th data-flex='true' data-type='number' data-width='80'>" . (empty($user) ? $lang->report->null : $user) . '</th>';
                  $dataCols[$i][] = $reportField;
              }
              else
              {
                  echo "<th data-flex='true' data-type='number' data-width='80'>" . zget($fields, $reportField, $reportField) . '</th>';
                  $dataCols[$i][] = $reportField;
              }
              if($showed[$i]) break;
              $percentKey = $reportField . 'Percent';
              if(isset($condition['percent'][$i]) and isset($condition['showAlone'][$i]) and $condition['contrast'][$i] != 'crystalTotal') echo "<th data-flex='true' data-type='number' data-width='80'>" . (isset($sqlLangs[$percentKey][$clientLang]) ? $sqlLangs[$percentKey][$clientLang] : $lang->crystal->percentAB) . "</th>";
          }
          if(isset($condition['reportTotal'][$i])) echo "<th data-flex='true' data-type='number' data-width='80' class='text-center'>{$lang->crystal->total}</th>";
          $percentKey = $reportField . 'Percent';
          if(isset($condition['percent'][$i]) and isset($condition['showAlone'][$i]) and $condition['contrast'][$i] == 'crystalTotal') echo "<th data-flex='true' data-type='number' data-width='80' class='text-center'>" . (isset($sqlLangs[$percentKey][$clientLang]) ? $sqlLangs[$percentKey][$clientLang] : $lang->crystal->percentAB) . "</th>";
      }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php $methodName = $this->app->getMethodName();?>
    <?php if($condition['group2']):?>
    <?php foreach($reportData as $group1 => $group1Data):?>
    <?php $group2Num = 0;?>
    <?php foreach($group1Data as $group2 => $data):?>
    <?php $group2Num++;?>
    <tr class='text-center'>
      <?php if($group2Num == 1 or $methodName == 'show'):?>
      <?php
      $group1Name = $group1;
      if(!empty($condition['isUser']['group1']))
      {
          $group1Name = zget($users, $group1, $group1);
      }
      elseif($groupLang['group1'])
      {
          $group1Name = zget($groupLang['group1'], $group1, $group1);
      }
      ?>
      <td <?php if(count($group1Data) > 1 and $methodName != 'show') echo 'rowspan=' . count($group1Data)?> title='<?php echo $group1Name?>'>
        <?php echo empty($group1Name) ? $lang->report->null : $group1Name;?>
      </td>
      <?php endif;?>
      <?php
      $group2Name = $group2;
      if(!empty($condition['isUser']['group2']))
      {
          $group2Name = zget($users, $group2, $group2);
      }
      elseif($groupLang['group2'])
      {
          $group2Name = zget($groupLang['group2'], $group2, $group2);
      }
      ?>
      <td title='<?php echo $group2Name?>'><?php echo empty($group2Name) ? $lang->report->null : $group2Name;?></td>
      <?php
      $data         = $this->report->getCellData($data, $dataCols, $condition);
      $allTotal     = $data['allTotal'];
      $cellDataList = $data['cellData'];
      foreach($cellDataList as $i => $cellData) echo '<td>' . (empty($cellData) ? 0 : $cellData) . '</td>';
      ?>
    </tr>
    <?php endforeach;?>
    <?php endforeach;?>
    <?php else:?>
    <?php foreach($reportData as $group1 => $data):?>
    <tr class='text-center'>
      <?php
      $group1Name = $group1;
      if(!empty($condition['isUser']['group1']))
      {
          $group1Name = zget($users, $group1, $group1);
      }
      elseif($groupLang['group1'])
      {
          $group1Name = zget($groupLang['group1'], $group1, $group1);
      }
      ?>
      <td title='<?php echo $group1Name?>'><?php echo empty($group1Name) ? $lang->report->null : $group1Name;?></td>
      <?php
      $data         = $this->report->getCellData($data, $dataCols, $condition);
      $allTotal     = $data['allTotal'];
      $cellDataList = $data['cellData'];
      foreach($cellDataList as $i => $cellData) echo '<td>' . (empty($cellData) ? 0 : $cellData) . '</td>';
      ?>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
    <tr class='text-center'>
      <td class='text-right' <?php if($condition['group2']) echo 'colspan=2'?>><?php echo $lang->crystal->total?></td>
      <?php ksort($allTotal);?>
      <?php foreach($allTotal as $total):?>
      <td><?php echo $total?></td>
      <?php endforeach;?>
    </tr>
  </tbody>
</table>
