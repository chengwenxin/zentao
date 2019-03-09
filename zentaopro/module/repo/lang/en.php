<?php
$lang->repo->common          = 'Repo';
$lang->repo->create          = 'Create Repo';
$lang->repo->settings        = 'Settings';
$lang->repo->browse          = 'View';
$lang->repo->delete          = 'Delete';
$lang->repo->showSyncComment = 'Display Synchronization';
$lang->repo->ajaxSyncComment = 'Interface: Ajax Sync Note';
$lang->repo->download        = 'Download';
$lang->repo->downloadDiff    = 'Download Diff';
$lang->repo->addBug          = 'Add Review';
$lang->repo->editBug         = 'Edit';
$lang->repo->deleteBug       = 'Delete';
$lang->repo->addComment      = 'Add Comment';
$lang->repo->editComment     = 'Edit';
$lang->repo->deleteComment   = 'Delete';

$lang->repo->submit     = 'Submit';
$lang->repo->cancel     = 'Cancel';
$lang->repo->addComment = 'Add Comment';

$lang->repo->product  = $lang->productCommon;
$lang->repo->module   = 'Module';
$lang->repo->project  = $lang->projectCommon;
$lang->repo->type     = 'Type';
$lang->repo->assign   = 'Assign';
$lang->repo->title    = 'Title';
$lang->repo->detile   = 'Detail';
$lang->repo->lines    = 'Lines';
$lang->repo->line     = 'Line';
$lang->repo->expand   = 'Unfold';
$lang->repo->collapse = 'Fold';

$lang->repo->id        = 'ID';
$lang->repo->SCM       = 'Type';
$lang->repo->name      = 'Name';
$lang->repo->path      = 'Path';
$lang->repo->prefix    = 'Prefix';
$lang->repo->config    = 'Config';
$lang->repo->account   = 'Username';
$lang->repo->password  = 'Password';
$lang->repo->encoding  = 'Encoding';
$lang->repo->client    = 'Client Path';
$lang->repo->size      = 'Size';
$lang->repo->revision  = 'Revision';
$lang->repo->revisionA = 'Revision';
$lang->repo->revisions = 'Revisions';
$lang->repo->time      = 'Commit on';
$lang->repo->committer = 'Committer';
$lang->repo->commits   = 'Number of commits';
$lang->repo->synced    = 'Initialize Sync';
$lang->repo->lastSync  = 'Last Sync';
$lang->repo->deleted   = 'Deleted';
$lang->repo->commit    = 'Commit';
$lang->repo->comment   = 'Comment';
$lang->repo->view      = 'View File';
$lang->repo->viewA     = 'View';
$lang->repo->log       = 'Revision Log';
$lang->repo->blame     = 'Blame';
$lang->repo->date      = 'Date';
$lang->repo->diff      = 'Diff';
$lang->repo->diffAB    = 'Diff';
$lang->repo->diffAll   = 'DiffAll';
$lang->repo->viewDiff  = 'View diff';
$lang->repo->allLog    = 'All Revisions';
$lang->repo->location  = 'Location';
$lang->repo->file      = 'File';
$lang->repo->action    = 'Action';
$lang->repo->code      = 'Code';
$lang->repo->review    = 'Review';
$lang->repo->acl       = 'Privilege';
$lang->repo->group     = 'Group';
$lang->repo->user      = 'User';
$lang->repo->info      = 'Version Info';

$lang->repo->title      = 'Title';
$lang->repo->status     = 'Status';
$lang->repo->openedBy   = 'Creator';
$lang->repo->assignedTo = 'To';
$lang->repo->openedDate = 'Time';

$lang->repo->latestRevision = 'Latest Revision';
$lang->repo->actionInfo     = "Add by %s in %s";
$lang->repo->changes        = "Amendant Record";
$lang->repo->reviewLocation = "File: %s@%s, line:%s - %s";
$lang->repo->commentEdit    = '<i class="icon-pencil"></i>';
$lang->repo->commentDelete  = '<i class="icon-remove"></i>';
$lang->repo->allChanges     = "Other Changes";
$lang->repo->commitTitle    = "The %sth Commit";

$lang->repo->viewDiffList['inline'] = 'Inline';
$lang->repo->viewDiffList['appose'] = 'Parallel';

$lang->repo->logStyles['A'] = 'Add';
$lang->repo->logStyles['M'] = 'Modification';
$lang->repo->logStyles['D'] = 'Delete';

$lang->repo->encodingList['utf_8'] = 'UTF-8';
$lang->repo->encodingList['gbk']   = 'GBK';

$lang->repo->scmList['Subversion'] = 'Subversion';
$lang->repo->scmList['Git']        = 'Git';

$lang->repo->notice                 = new stdclass();
$lang->repo->notice->syncing        = 'Synchronizing. Please wait ...';
$lang->repo->notice->syncComplete   = 'Synchronized. Now redirecting ...';
$lang->repo->notice->syncedCount    = 'The number of records synchronized is ';
$lang->repo->notice->delete         = 'Are you sure delete this repo?';
$lang->repo->notice->successDelete  = 'Repository is removed.';
$lang->repo->notice->commentContent = 'Comment';
$lang->repo->notice->deleteBug      = 'Are you sure to delete this bug?';
$lang->repo->notice->deleteComment  = 'Are you sure to delete this comment?';
$lang->repo->notice->lastSyncTime   = 'Last Sync:';

$lang->repo->error               = new stdclass();
$lang->repo->error->useless      = 'Your server disabled exec and shell_exec, so it cannot be applied.';
$lang->repo->error->connect      = 'Connection to the repo failed. Please enter username, password and repo address correctly!';
$lang->repo->error->version      = 'Version 1.8+ of https and svn protocol is required. Please update to latest version! Go to http://subversion.apache.org/';
$lang->repo->error->path         = 'Repo address is the file path, e.g. /home/test.';
$lang->repo->error->cmd          = 'Client Error!';
$lang->repo->error->diff         = 'Two versions must be selected.';
$lang->repo->error->product      = "Please select {$lang->productCommon}!";
$lang->repo->error->commentText  = 'Please enter content for review!';
$lang->repo->error->comment      = 'Please enter content!';
$lang->repo->error->title        = 'Please enter title!';
$lang->repo->error->accessDenied = 'You do not have the privilege to access the repository.';
$lang->repo->error->noFound      = 'The repo is not found.';
$lang->repo->error->noFile       = '%s does not exist.';
$lang->repo->error->noPriv       = 'The program does not have the privilege  to switch to %s';
$lang->repo->error->output       = "The command is: %s\nThe error is(%s): %s\n";

$lang->repo->example           = new stdclass();
$lang->repo->example->client   = "For example, /usr/bin/svn, C:\subversion\svn.exe, /usr/bin/git";
$lang->repo->example->path     = "For example, SVN: http://example.googlecode.com/svn/, GIT: /home/test";
$lang->repo->example->config   = "Config directory is required in https. Use '--config-dir' to generate config dir.";
$lang->repo->example->encoding = "input encoding of files";

$lang->repo->typeList['standard']    = 'Standard';
$lang->repo->typeList['performance'] = 'Performance';
$lang->repo->typeList['security']    = 'Security';
$lang->repo->typeList['redundancy']  = 'Redundancy';
$lang->repo->typeList['logicError']  = 'Logic Error';
