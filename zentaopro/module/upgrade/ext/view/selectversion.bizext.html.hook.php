<?php
$bizext = $this->dao->select('*')->from(TABLE_EXTENSION)->where('code')->like('bizext%')->orderBy('version desc')->fetch();
$version = empty($bizext) ? $version : 'pro' . str_replace('.', '_', $bizext->version);
?>
<script type='text/javascript'>$(function(){$('#fromVersion').val('<?php echo $version?>');});</script>
