<header class='heading primary'>
  <div class='title muted'><strong><?php echo $lang->user->profile ?></strong></div>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</header>

<section class='content'>
  <div class='box'>
    <table class='table bordered table-detail'>
      <tr>
        <td class='w-100px'><?php echo $lang->user->dept;?></td>
        <td>
        <?php
        if(empty($deptPath))
        {   
            echo "/";
        }   
        else
        {   
            foreach($deptPath as $key => $dept)
            {   
                if($dept->name) echo $dept->name;
                if(isset($deptPath[$key + 1])) echo $lang->arrow;
            }   
        }   
        ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $lang->user->account;?></td>
        <td><?php echo $user->account;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->realname;?></td>
        <td><?php echo $user->realname;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->role;?></td>
        <td><?php echo $lang->user->roleList[$user->role];?></td>
      </tr>
      <tr>
        <td><?php echo $lang->group->priv;?></td>
        <td><?php foreach($groups as $group) echo $group->name . ' '; ?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->commiter;?></td>
        <td><?php echo $user->commiter;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->email;?></td>
        <td><?php echo $user->email;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->join;?></td>
        <td><?php echo $user->join;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->visits;?></td>
        <td><?php echo $user->visits;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->ip;?></td>
        <td><?php echo $user->ip;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->last;?></td>
        <td><?php echo $user->last;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->skype;?></td>
        <td><?php if($user->skype) echo html::a("callto://$user->skype", $user->skype);?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->qq;?></td>
        <td><?php if($user->qq) echo html::a("tencent://message/?uin=$user->qq", $user->qq);?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->yahoo;?></td>
        <td><?php echo $user->yahoo;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->gtalk;?></td>
        <td><?php echo $user->gtalk;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->wangwang;?></td>
        <td><?php echo $user->wangwang;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->mobile;?></td>
        <td><?php echo $user->mobile;?></td>
      </tr>
       <tr>
        <td><?php echo $lang->user->phone;?></td>
        <td><?php echo $user->phone;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->address;?></td>
        <td><?php echo $user->address;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->user->zipcode;?></td>
        <td><?php echo $user->zipcode;?></td>
      </tr>
    </table>
  </div>
</section>
