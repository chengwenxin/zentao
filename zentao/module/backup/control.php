<?php
/**
 * The control file of backup of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     backup
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class backup extends control
{
    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);

        $this->backupPath = $this->backup->getBackupPath();
        if(!is_dir($this->backupPath))
        {
            if(!mkdir($this->backupPath, 0777, true)) $this->view->error = sprintf($this->lang->backup->error->noWritable, dirname($this->backupPath));
        }
        else
        {
            if(!is_writable($this->backupPath)) $this->view->error = sprintf($this->lang->backup->error->noWritable, $this->backupPath);
        }
    }

    /**
     * Index 
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $backups = array();
        if(empty($this->view->error))
        {
            $sqlFiles = glob("{$this->backupPath}*.sql*");
            if(!empty($sqlFiles))
            {
                foreach($sqlFiles as $file)
                {
                    $fileName   = basename($file);
                    $backupFile = new stdclass();
                    $backupFile->time  = filemtime($file);
                    $backupFile->name  = substr($fileName, 0, strpos($fileName, '.'));
                    $backupFile->files[$file] = abs(filesize($file));

                    $fileBackup = $this->backup->getBackupFile($backupFile->name, 'file');
                    if($fileBackup) $backupFile->files[$fileBackup] = $this->backup->getBackupSize($fileBackup);

                    $codeBackup = $this->backup->getBackupFile($backupFile->name, 'code');
                    if($codeBackup) $backupFile->files[$codeBackup] = $this->backup->getBackupSize($codeBackup);

                    $backups[$backupFile->name] = $backupFile;
                }
            }
        }
        krsort($backups);

        $this->view->title      = $this->lang->backup->common;
        $this->view->position[] = $this->lang->backup->common;
        $this->view->backups    = $backups;
        $this->display();
    }

    /**
     * Backup 
     * 
     * @access public
     * @return void
     */
    public function backup($reload = 'no')
    {
        if($reload == 'yes') session_write_close();
        set_time_limit(7200);
        $nozip  = strpos($this->config->backup->setting, 'nozip') !== false;
        $nofile = strpos($this->config->backup->setting, 'nofile') !== false;
        $nosafe = strpos($this->config->backup->setting, 'nosafe') !== false;

        $fileName = date('YmdHis') . mt_rand(0, 9);
        $backFileName = "{$this->backupPath}{$fileName}.sql";
        if(!$nosafe) $backFileName .= '.php';
        $result = $this->backup->backSQL($backFileName);
        if(!$result->result)
        {
            if($reload == 'yes')
            {
                echo js::alert(sprintf($this->lang->backup->error->noWritable, $this->backupPath));
                die(js::reload('parent'));
            }
            else
            {
                printf($this->lang->backup->error->noWritable, $this->backupPath);
            }
        }
        if(!$nosafe) $this->backup->addFileHeader($backFileName);

        if((extension_loaded('zlib') or $nozip) and !$nofile)
        {

            $backFileName = "{$this->backupPath}{$fileName}.file";
            if(!$nozip)  $backFileName .= '.zip';
            if(!$nozip and !$nosafe) $backFileName .= '.php';

            $result = $this->backup->backFile($backFileName);
            if(!$result->result)
            {
                if($reload == 'yes')
                {
                    echo js::alert(sprintf($this->lang->backup->error->backupFile, $result->error));
                    die(js::reload('parent'));
                }
                else
                {
                    printf($this->lang->backup->error->backupFile, $result->error);
                }
            }
            if(!$nozip and !$nosafe) $this->backup->addFileHeader($backFileName);

            $backFileName = "{$this->backupPath}{$fileName}.code";
            if(!$nozip)  $backFileName .= '.zip';
            if(!$nozip and !$nosafe) $backFileName .= '.php';

            $result = $this->backup->backCode($backFileName);
            if(!$result->result)
            {
                if($reload == 'yes')
                {
                    echo js::alert(sprintf($this->lang->backup->error->backupCode, $result->error));
                    die(js::reload('parent'));
                }
                else
                {
                    printf($this->lang->backup->error->backupCode, $result->error);
                }
            }
            if(!$nozip and !$nosafe) $this->backup->addFileHeader($backFileName);
        }

        /* Delete expired backup. */
        $backupFiles = glob("{$this->backupPath}*.php");
        if(!empty($backupFiles))
        {
            $time = time();
            foreach($backupFiles as $file)
            {
                if($time - filemtime($file) > $this->config->backup->holdDays * 24 * 3600) unlink($file);
            }
        }

        if($reload == 'yes')
        {
            die(js::reload('parent'));
        }
        else
        {
            echo $this->lang->backup->success->backup . "\n";
        }
    }

    /**
     * Restore 
     * 
     * @param  string $fileName 
     * @param  string $confirm 
     * @access public
     * @return void
     */
    public function restore($fileName, $confirm = 'no')
    {
        if($confirm == 'no') $this->send(array('result' => 'fail', 'message' => $this->lang->backup->confirmRestore));

        set_time_limit(7200);

        /* Restore database. */
        if(file_exists("{$this->backupPath}{$fileName}.sql.php"))
        {
            $sqlBackup = "{$this->backupPath}{$fileName}.sql.php";
            $this->backup->removeFileHeader($sqlBackup);
            $result = $this->backup->restoreSQL($sqlBackup);
            $this->backup->addFileHeader($sqlBackup);
            if(!$result->result) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->backup->error->restoreSQL, $result->error)));
        }
        elseif(file_exists("{$this->backupPath}{$fileName}.sql"))
        {
            $result = $this->backup->restoreSQL("{$this->backupPath}{$fileName}.sql");
            if(!$result->result) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->backup->error->restoreSQL, $result->error)));
        }

        /* Restore attatchments. */
        if(file_exists("{$this->backupPath}{$fileName}.file.zip.php"))
        {
            $fileBackup = "{$this->backupPath}{$fileName}.file.zip.php";
            $this->backup->removeFileHeader($fileBackup);
            $result = $this->backup->restoreFile($fileBackup);
            $this->backup->addFileHeader($fileBackup);
            if(!$result->result) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->backup->error->restoreFile, $result->error)));
        }
        elseif(file_exists("{$this->backupPath}{$fileName}.file.zip"))
        {
            $result = $this->backup->restoreFile("{$this->backupPath}{$fileName}.file.zip");
            if(!$result->result) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->backup->error->restoreFile, $result->error)));
        }
        elseif(file_exists("{$this->backupPath}{$fileName}.file"))
        {
            $result = $this->backup->restoreFile("{$this->backupPath}{$fileName}.file");
            if(!$result->result) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->backup->error->restoreFile, $result->error)));
        }

        $this->send(array('result' => 'success', 'message' => $this->lang->backup->success->restore));
    }

    /**
     * remove PHP header.
     * 
     * @param  string $fileName 
     * @access public
     * @return void
     */
    public function rmPHPHeader($fileName)
    {
        if(file_exists($this->backupPath . $fileName . '.sql.php'))
        {
            $this->backup->removeFileHeader($this->backupPath . $fileName . '.sql.php');
            rename($this->backupPath . $fileName . '.sql.php', $this->backupPath . $fileName . '.sql');
        }
        if(file_exists($this->backupPath . $fileName . '.file.zip.php'))
        {
            $this->backup->removeFileHeader($this->backupPath . $fileName . '.file.zip.php');
            rename($this->backupPath . $fileName . '.file.zip.php', $this->backupPath . $fileName . '.file.zip');
        }
        if(file_exists($this->backupPath . $fileName . '.code.zip.php'))
        {
            $this->backup->removeFileHeader($this->backupPath . $fileName . '.code.zip.php');
            rename($this->backupPath . $fileName . '.code.zip.php', $this->backupPath . $fileName . '.code.zip');
        }

        die(js::reload('parent'));
    }

    /**
     * Delete 
     * 
     * @param  string $fileName 
     * @param  string $confirm 
     * @access public
     * @return void
     */
    public function delete($fileName, $confirm = 'no')
    {
        if($confirm == 'no') die(js::confirm($this->lang->backup->confirmDelete, inlink('delete', "fileName=$fileName&confirm=yes")));

        /* Delete database file. */
        if(file_exists($this->backupPath . $fileName . '.sql.php') and !unlink($this->backupPath . $fileName . '.sql.php'))
        {
            die(js::alert(sprintf($this->lang->backup->error->noDelete, $this->backupPath . $fileName . '.sql.php')));
        }
        if(file_exists($this->backupPath . $fileName . '.sql') and !unlink($this->backupPath . $fileName . '.sql'))
        {
            die(js::alert(sprintf($this->lang->backup->error->noDelete, $this->backupPath . $fileName . '.sql')));
        }

        /* Delete attatchments file. */
        if(file_exists($this->backupPath . $fileName . '.file.zip.php') and !unlink($this->backupPath . $fileName . '.file.zip.php'))
        {
            die(js::alert(sprintf($this->lang->backup->error->noDelete, $this->backupPath . $fileName . '.file.zip.php')));
        }
        if(file_exists($this->backupPath . $fileName . '.file.zip') and !unlink($this->backupPath . $fileName . '.file.zip'))
        {
            die(js::alert(sprintf($this->lang->backup->error->noDelete, $this->backupPath . $fileName . '.file.zip')));
        }
        if(file_exists($this->backupPath . $fileName . '.file'))
        {
            $zfile = $this->app->loadClass('zfile');
            $zfile->removeDir($this->backupPath . $fileName . '.file');
        }

        /* Delete code file. */
        if(file_exists($this->backupPath . $fileName . '.code.zip.php') and !unlink($this->backupPath . $fileName . '.code.zip.php'))
        {
            die(js::alert(sprintf($this->lang->backup->error->noDelete, $this->backupPath . $fileName . '.code.zip.php')));
        }
        if(file_exists($this->backupPath . $fileName . '.code.zip') and !unlink($this->backupPath . $fileName . '.code.zip'))
        {
            die(js::alert(sprintf($this->lang->backup->error->noDelete, $this->backupPath . $fileName . '.code.zip')));
        }
        if(file_exists($this->backupPath . $fileName . '.code'))
        {
            $zfile = $this->app->loadClass('zfile');
            $zfile->removeDir($this->backupPath . $fileName . '.code');
        }

        die(js::reload('parent'));
    }

    /**
     * Change hold days. 
     * 
     * @access public
     * @return void
     */
    public function change()
    {
        if($_POST)
        {
            $data = fixer::input('post')->get();
            $this->loadModel('setting')->setItem('system.backup.holdDays', $data->holdDays);
            die(js::reload('parent.parent'));
        }

        $this->display();
    }

    /**
     * Setting backup 
     * 
     * @access public
     * @return void
     */
    public function setting()
    {
        if(strtolower($this->server->request_method) == "post")
        {
            $data    = fixer::input('post')->join('setting', ',')->get();
            $setting = '';
            if(isset($data->setting)) $setting = $data->setting;
            $this->loadModel('setting')->setItem('system.backup.setting', $setting);

            $settingDir = $data->settingDir;
            if($settingDir)
            {
                $settingDir = rtrim($settingDir, DS) . DS;
                if(!is_dir($settingDir) and mkdir($settingDir, 0777, true)) die(js::alert($this->lang->backup->error->noCreateDir));
                if(!is_writable($settingDir)) die(js::alert(strip_tags(sprintf($this->lang->backup->error->noWritable, $settingDir))));
                if($data->settingDir == $this->app->getTmpRoot() . 'backup' . DS) $settingDir = '';
            }

            $this->setting->setItem('system.backup.settingDir', $settingDir);

            die(js::reload('parent.parent'));
        }
        $this->display();
    }

    /**
     * Ajax get progress.
     * 
     * @access public
     * @return void
     */
    public function ajaxGetProgress()
    {
        session_write_close();

        $files = glob($this->backupPath . '/*');
        rsort($files);

        $fileName = basename($files[0]);
        $fileName = substr($fileName, 0, strpos($fileName, '.'));

        $sqlFileName = $this->backupPath . $fileName . '.sql';
        if(!file_exists($sqlFileName)) $sqlFileName .= '.php';
        $sqlFileName = $this->backup->getBackupFile($fileName, 'sql');
        if($sqlFileName)
        {
            $fileSize = $this->backup->getBackupSize($sqlFileName);
            $fileSize = $fileSize / 1024 >= 1024 ? round($fileSize / 1024 / 1024, 2) . 'MB' : round($fileSize / 1024, 2) . 'KB';
            $message  = sprintf($this->lang->backup->progressSQL, $fileSize);
        }

        $attachFileName = $this->backup->getBackupFile($fileName, 'file');
        if($attachFileName)
        {
            $fileSize = $this->backup->getBackupSize($attachFileName);
            $fileSize = $fileSize / 1024 >= 1024 ? round($fileSize / 1024 / 1024, 2) . 'MB' : round($fileSize / 1024, 2) . 'KB';
            $message = sprintf($this->lang->backup->progressAttach, $fileSize);
        }

        $codeFileName = $this->backup->getBackupFile($fileName, 'code');
        if($codeFileName)
        {
            $fileSize = $this->backup->getBackupSize($codeFileName);
            $fileSize = $fileSize / 1024 >= 1024 ? round($fileSize / 1024 / 1024, 2) . 'MB' : round($fileSize / 1024, 2) . 'KB';
            $message = sprintf($this->lang->backup->progressCode, $fileSize);
        }
        die($message);
    }
}
