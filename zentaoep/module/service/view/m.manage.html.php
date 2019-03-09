<?php include '../../common/view/m.header.html.php';?>
<section id='page' class='section list-with-actions list-with-pager'>
  <table class="table bordered">
    <thead>
    <tr>
      <th><?php echo $lang->service->all;?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($topServices as $id => $topService):?>
    <?php if($id == 0) continue;?>
    <tr>
      <td><?php echo $topService?></td>
    </tr>
    <?php endforeach;?>
    </tbody>
  </table>
</section>
<?php include '../../common/view/m.footer.html.php';?>
