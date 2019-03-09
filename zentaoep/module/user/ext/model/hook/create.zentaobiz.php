<?php
if($this->post->feedback and $this->checkBizUserLimit('feedback')) die(js::alert($this->lang->user->noticeFeedbackUserLimit));
