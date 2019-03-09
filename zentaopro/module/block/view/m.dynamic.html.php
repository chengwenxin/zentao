<?php include "../../common/view/m.avatar.html.php";?>
<table class='table bordered'>
  <?php foreach($actions as $action): ?>
  <tr>
    <td>
      <?php echo $action->date;?>
      <?php echo isset($users[$action->actor]) ? $users[$action->actor] : $action->actor;?>
      <?php if($action->action == 'login' or $action->action == 'logout') $action->objectName = $action->objectLabel = '';?>
      <?php echo $action->actionLabel . ' ' . $action->objectLabel;?>
      <?php if(!empty($action->objectLabel)):?>
      <a class='text-link' href='<?php echo $action->objectLink ?>'><?php echo $action->objectName;?></a>
      <?php endif;?>
    </td>
  </tr>
  <?php endforeach;?>
</table>
