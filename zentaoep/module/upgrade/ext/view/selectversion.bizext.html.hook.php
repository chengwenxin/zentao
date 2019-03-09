<?php
$zentaobiz = $this->dao->select('*')->from(TABLE_EXTENSION)->where('code')->like('zentaobiz%')->orderBy('version desc')->fetch();
$version = empty($zentaobiz) ? $version : 'biz' . str_replace('.', '_', $zentaobiz->version);
?>
<script type='text/javascript'>$(function(){$('#fromVersion').val('<?php echo $version?>');});</script>
