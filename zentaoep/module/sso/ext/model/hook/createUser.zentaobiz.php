<?php
if($this->loadModel('user')->checkBizUserLimit()) return array('status' => 'fail', 'data' => $this->lang->user->noticeBizUserLimit);
