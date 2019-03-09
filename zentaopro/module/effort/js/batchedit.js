function updateEffort(date)
{
    date = date.replace(/\-/g, '');
    link = createLink('effort', 'batchEdit', 'date=' + date);
    location.href=link;
}

function deleteEffort(id)
{
  $("#row" + id).remove();
}
