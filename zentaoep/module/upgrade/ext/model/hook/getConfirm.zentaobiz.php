<?php
if($this->session->step != 'pro') return $this->loadExtension('zentaobiz')->getConfirm($fromVersion);
