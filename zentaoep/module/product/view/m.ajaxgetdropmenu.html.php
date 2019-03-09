<div class='heading divider'>
  <span class='title'>
    <input type='text' class='input' id='search' value='' placeholder='<?php echo $this->app->loadLang('search')->search->common;?>'/>
  </span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
<?php js::set('productID', $productID);?>
<?php js::set('module', $module);?>
<?php js::set('method', $method);?>
<?php js::set('extra', $extra);?>
</div>
<?php
$iCharges = 0;
$others   = 0;
$closeds  = 0;
foreach($products as $product)
{
    if($product->status == 'normal' and $product->PO == $this->app->user->account) $iCharges++;
    if($product->status == 'normal' and !($product->PO == $this->app->user->account)) $others++;
    if($product->status == 'closed') $closeds++;
}
?>
<div id='searchResult' class='content <?php if($closeds) echo 'with-closed'?>'>
  <div id='defaultMenu' class='search-list'>
    <div id='activedItems'>
    <?php
    if($iCharges and $others) echo "<div class='heading'>{$lang->product->mine}</div>";
    echo "<div class='list'>";
    foreach($products as $id => $product)
    {
        if($product->status == 'normal' and $product->PO == $this->app->user->account) 
        {
            echo html::a(sprintf($link, $product->id), "<i class='icon-cube'></i>&nbsp;{$product->name}", '', "class='mine text-important item' data-id='{$product->id}' data-tag=':{$product->status} @{$product->PO} @mine' data-key='{$product->key}'");
            unset($products[$id]);
        }
    }
    echo '</div>';
 
    if($iCharges and $others) echo "<div class='heading'>{$lang->product->other}</div>";
    $class = ($iCharges and $others) ? "other text-special" : '';
    echo "<div class='list'>";
    foreach($products as $id => $product)
    {
        if($product->status == 'normal' and !($product->PO == $this->app->user->account))
        {
            echo html::a(sprintf($link, $product->id), "<i class='icon-cube'></i>&nbsp;{$product->name}", '', "class='$class item' data-id='{$product->id}' data-tag=':{$product->status} @{$product->PO}' data-key='{$product->key}'");
            unset($products[$id]);
        }
    }
    echo '</div>';
    ?>
    </div>
 
    <?php if($closeds):?>
    <div class='box affix dock-bottom'>
      <a class='btn fluid' id='closedCollapse'><?php echo $lang->product->closed;?></a>
      <div class="collapse hidden" id="closedProducts">
        <div class="list">
          <?php
          foreach($products as $product)
          {
              if($product->status == 'closed') echo html::a(sprintf($link, $product->id), "<i class='icon-cube'></i> {$product->name}", '', "data-id='{$product->id}' data-tag=':{$product->status} @{$product->PO}' data-key='{$product->key}' class='closed item'");
          }
          ?>
        </div>
      </div>
    </div>
    <script>
    $(function()
    {
        $('.modal #closedCollapse').click(function()
        {
            if($('.modal #closedProducts').hasClass('hidden'))
            {
                $('.modal #closedProducts').removeClass('hidden');
                $('.modal #closedProducts').addClass('in');
            }
            else
            {
                $('.modal #closedProducts').removeClass('in');
                $('.modal #closedProducts').addClass('hidden');
            }
        })
        if($(window).height() < $('.modal #activedItems').height() + $('.modal .heading.divider').height())
        {
            $('.modal #searchResult').addClass('with-closed');
            $('.modal #closedCollapse').closest('.box').addClass('affix').addClass('dock-bottom');
        }
    })
    </script>
    <?php endif;?>
  </div>
</div>
