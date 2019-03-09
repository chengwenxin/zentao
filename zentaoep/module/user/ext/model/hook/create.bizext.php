<?php
if(isset($this->config->bizVersion) and empty($_POST['feedback']) and $this->checkUserLimit()) die(js::alert($this->lang->user->noticeUserLimit));
