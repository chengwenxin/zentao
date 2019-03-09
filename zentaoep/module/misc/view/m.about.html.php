<style>
#aboutContent > img {margin: 1rem 0}
#aboutContent ul li{text-align:left;}

.card {position: relative; padding-top: 30px; margin: 0}
.card > .media {position: absolute; left: 0; top: 0; width: 100%; background: #f1f1f1; height:30px; bottom: 0; overflow: hidden; z-index: 90; transition: all 0.4s;}
.card > .media > h5 {display: inline-block; color: #666; z-index: 100; font-size: 14px; padding-top: 7px;}
.card .card-content {padding: 5px 20px}
.card-content > ul {padding-left: 8px;}
.card-content > ul > li {margin-bottom: 3px;}
</style>

<div class='heading divider'>
  <div class='title'><strong><?php echo $lang->misc->zentao->labels['about'];?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
</div>

<div class='content box text-center' id='aboutContent'>
  <img src='<?php echo $config->webRoot . 'mobile/img/zentao.png' ?>' alt='<?php echo $lang->zentaoPMS ?>'>
  <h4><?php printf($lang->misc->zentao->version, $config->version);?></h4>
  <?php unset($lang->misc->zentao->version);?>
  <div class='box'>
    <div class='row'>
      <div class='card cell-6 outline'>
        <div class='media'>
          <?php echo html::icon($lang->misc->zentao->icons['about'], 'icon');?>
          <h5><?php echo $lang->misc->zentao->labels['about'];?></h5>
        </div>
        <div class='card-content'>
          <ul>
            <?php foreach($lang->misc->zentao->about as $item => $label):?>
            <?php $link = html::a("http://api.zentao.net/goto.php?item=$item&from=about", $label, '_blank', "id='$item'");?>
            <li><?php echo $link;?></li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
      <div class='card cell-6 outline'>
        <div class='media'>
          <?php echo html::icon($lang->misc->zentao->icons['support'], 'icon');?>
          <h5><?php echo $lang->misc->zentao->labels['support'];?></h5>
        </div>
        <div class='card-content'>
          <ul>
            <?php foreach($lang->misc->zentao->support as $item => $label):?>
            <?php $link = html::a("http://api.zentao.net/goto.php?item=$item&from=about", $label, '_blank', "id='$item'");?>
            <li><?php echo $link;?></li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    </div>
    <div class='row'>
      <div class='card cell-6 outline'>
        <div class='media'>
          <?php echo html::icon($lang->misc->zentao->icons['cowin'], 'icon');?>
          <h5><?php echo $lang->misc->zentao->labels['cowin'];?></h5>
        </div>
        <div class='card-content'>
          <ul>
            <?php foreach($lang->misc->zentao->cowin as $item => $label):?>
            <?php $link = html::a("http://api.zentao.net/goto.php?item=$item&from=about", $label, '_blank', "id='$item'");?>
            <li><?php echo $link;?></li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
      <div class='card cell-6 outline'>
        <div class='media'>
          <?php echo html::icon($lang->misc->zentao->icons['service'], 'icon');?>
          <h5><?php echo $lang->misc->zentao->labels['service'];?></h5>
        </div>
        <div class='card-content'>
          <ul>
            <?php foreach($lang->misc->zentao->service as $item => $label):?>
            <?php $link = html::a("http://api.zentao.net/goto.php?item=$item&from=about", $label, '_blank', "id='$item'");?>
            <li><?php echo $link;?></li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
