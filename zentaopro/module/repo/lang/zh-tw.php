<?php
$lang->repo->common          = '代碼';
$lang->repo->create          = '創建版本庫';
$lang->repo->settings        = '版本庫設置';
$lang->repo->browse          = '瀏覽';
$lang->repo->delete          = '刪除版本庫';
$lang->repo->showSyncComment = '顯示同步進度';
$lang->repo->ajaxSyncComment = '介面：AJAX同步註釋';
$lang->repo->download        = '下載';
$lang->repo->downloadDiff    = '下載Diff';
$lang->repo->addBug          = '添加評審';
$lang->repo->editBug         = '編輯評審';
$lang->repo->deleteBug       = '刪除評審';
$lang->repo->addComment      = '添加備註';
$lang->repo->editComment     = '編輯備註';
$lang->repo->deleteComment   = '刪除備註';

$lang->repo->submit     = '提交';
$lang->repo->cancel     = '取消';
$lang->repo->addComment = '添加評論';

$lang->repo->product  = $lang->productCommon;
$lang->repo->module   = '模組';
$lang->repo->project  = $lang->projectCommon;
$lang->repo->type     = '類型';
$lang->repo->assign   = '指派';
$lang->repo->title    = '標題';
$lang->repo->detile   = '詳情';
$lang->repo->lines    = '代碼行';
$lang->repo->line     = '行';
$lang->repo->expand   = '點擊展開';
$lang->repo->collapse = '點擊摺疊';

$lang->repo->id        = '編號';
$lang->repo->SCM       = '類型';
$lang->repo->name      = '名稱';
$lang->repo->path      = '地址';
$lang->repo->prefix    = '地址擴展';
$lang->repo->config    = '配置目錄';
$lang->repo->account   = '用戶名';
$lang->repo->password  = '密碼';
$lang->repo->encoding  = '編碼';
$lang->repo->client    = '客戶端';
$lang->repo->size      = '大小';
$lang->repo->revision  = '查看版本';
$lang->repo->revisionA = '版本';
$lang->repo->revisions = '版本';
$lang->repo->time      = '提交時間';
$lang->repo->committer = '作者';
$lang->repo->commits   = '提交數';
$lang->repo->synced    = '初始化同步';
$lang->repo->lastSync  = '最後同步時間';
$lang->repo->deleted   = '已刪除';
$lang->repo->commit    = '提交';
$lang->repo->comment   = '註釋';
$lang->repo->view      = '查看檔案';
$lang->repo->viewA     = '查看';
$lang->repo->log       = '版本歷史';
$lang->repo->blame     = '追溯';
$lang->repo->date      = '日期';
$lang->repo->diff      = '比較差異';
$lang->repo->diffAB    = '比較';
$lang->repo->diffAll   = '全部比較';
$lang->repo->viewDiff  = '查看差異';
$lang->repo->allLog    = '所有版本';
$lang->repo->location  = '位置';
$lang->repo->file      = '檔案';
$lang->repo->action    = '操作';
$lang->repo->code      = '代碼';
$lang->repo->review    = '評審';
$lang->repo->acl       = '權限';
$lang->repo->group     = '分組';
$lang->repo->user      = '用戶';
$lang->repo->info      = '版本信息';

$lang->repo->title      = '標題';
$lang->repo->status     = '狀態';
$lang->repo->openedBy   = '創建者';
$lang->repo->assignedTo = '指派給';
$lang->repo->openedDate = '創建日期';

$lang->repo->latestRevision = '最近修訂版本';
$lang->repo->actionInfo     = "由%s在%s添加";
$lang->repo->changes        = "修改記錄";
$lang->repo->reviewLocation = "%s@%s，%s行 - %s行";
$lang->repo->commentEdit    = '<i class="icon-pencil"></i>';
$lang->repo->commentDelete  = '<i class="icon-remove"></i>';
$lang->repo->allChanges     = "其他改動";
$lang->repo->commitTitle    = "第%s次提交";

$lang->repo->viewDiffList['inline'] = '直列';
$lang->repo->viewDiffList['appose'] = '並排';

$lang->repo->logStyles['A'] = '添加';
$lang->repo->logStyles['M'] = '修改';
$lang->repo->logStyles['D'] = '刪除';

$lang->repo->encodingList['utf_8'] = 'UTF-8';
$lang->repo->encodingList['gbk']   = 'GBK';

$lang->repo->scmList['Subversion'] = 'Subversion';
$lang->repo->scmList['Git']        = 'Git';

$lang->repo->notice                 = new stdclass();
$lang->repo->notice->syncing        = '正在同步中, 請稍等...';
$lang->repo->notice->syncComplete   = '同步完成，正在跳轉...';
$lang->repo->notice->syncedCount    = '已經同步記錄條數';
$lang->repo->notice->delete         = '是否要刪除該版本庫？';
$lang->repo->notice->successDelete  = '已經成功刪除版本庫。';
$lang->repo->notice->commentContent = '輸入回覆內容';
$lang->repo->notice->deleteBug      = '確認刪除該Bug？';
$lang->repo->notice->deleteComment  = '確認刪除該回覆？';
$lang->repo->notice->lastSyncTime   = '最後更新于：';

$lang->repo->error               = new stdclass();
$lang->repo->error->useless      = '你的伺服器禁用了exec,shell_exec方法，無法使用該功能';
$lang->repo->error->connect      = '連接版本庫失敗，請填寫正確的用戶名、密碼和版本庫地址！';
$lang->repo->error->version      = "https和svn協議需要1.8及以上版本的客戶端，請升級到最新版本！詳情訪問:http://subversion.apache.org/";
$lang->repo->error->path         = '版本庫地址直接填寫檔案路徑，如：/home/test。';
$lang->repo->error->cmd          = '客戶端錯誤！';
$lang->repo->error->diff         = '必須選擇兩個版本';
$lang->repo->error->product      = "請選擇{$lang->productCommon}！";
$lang->repo->error->commentText  = '請填寫評審內容';
$lang->repo->error->comment      = '請填寫內容';
$lang->repo->error->title        = '請填寫標題';
$lang->repo->error->accessDenied = '你沒有權限訪問該版本庫';
$lang->repo->error->noFound      = '你訪問的版本庫不存在';
$lang->repo->error->noFile       = '目錄 %s 不存在';
$lang->repo->error->noPriv       = '程序沒有權限切換到目錄 %s';
$lang->repo->error->output       = "執行命令：%s\n錯誤結果(%s)： %s\n";

$lang->repo->example           = new stdclass();
$lang->repo->example->client   = "例如：/usr/bin/svn, C:\subversion\svn.exe, /usr/bin/git";
$lang->repo->example->path     = "例如：SVN: http://example.googlecode.com/svn/,  GIT: /homt/test";
$lang->repo->example->config   = "https需要填寫配置目錄的位置，通過config-dir選項生成配置目錄";
$lang->repo->example->encoding = "填寫版本庫中檔案的編碼";

$lang->repo->typeList['standard']    = '規範';
$lang->repo->typeList['performance'] = '性能';
$lang->repo->typeList['security']    = '安全';
$lang->repo->typeList['redundancy']  = '冗餘';
$lang->repo->typeList['logicError']  = '邏輯錯誤';
