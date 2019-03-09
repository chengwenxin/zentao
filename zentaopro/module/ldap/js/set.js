$(function(){
    showAnonymous();
    $(document).on('change', '#anonymous', function(){toggleHide();});
    $(document).on('change', '#type', function(){showAnonymous();});
});
function toggleHide()
{
    $('.adshow').toggle(!$('#anonymous').prop('checked'));
}
function showAnonymous()
{
  if($('#type').val() == 'ad')
  {
      $('#anonymous').parent().hide();
      $('#anonymous').prop('checked', false);
  }
  else
  {
      $('#anonymous').parent().show();
  }
  toggleHide();
}
