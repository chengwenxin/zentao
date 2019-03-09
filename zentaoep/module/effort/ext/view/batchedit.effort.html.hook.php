<?php
 $nonRDUser = 'false';
 if(!empty($_SESSION['user']->feedback) or !empty($_COOKIE['feedbackView'])) $nonRDUser = 'true';

 global $app;
 ?>

 <script language='Javascript'>
 $(function()
 {
     var nonRDuser = <?php echo $nonRDUser;?>;
     if(nonRDuser == false) return false;

     $('table tr').find('th:eq(4)').hide();
     $('table tr').find('th:eq(5)').hide();
     $('table tr').find('td:eq(4)').hide();
     $('table tr').find('td:eq(5)').hide();

     $("table tr td[colspan]").attr('colspan','4');

 });
</script>
