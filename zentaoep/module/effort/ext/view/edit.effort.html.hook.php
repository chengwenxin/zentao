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

     $('table').find('tr:eq(3)').hide();
     $('table').find('tr:eq(4)').hide();

 });
</script>
