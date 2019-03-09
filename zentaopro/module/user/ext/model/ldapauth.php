<?php
public function identify($account, $password)
{
    /* If ionCube is not loaded, jump to loader-wizard.php. */
    $user = parent::identify($account,$password);
    if($user and !extension_loaded('ionCube Loader'))
    {
        $user->rights = $this->authorize($account);
        $user->groups = $this->getGroups($account);
        $this->session->set('user', $user);

        $documentRoot = isset($_SERVER['SCRIPT_FILENAME']) ? dirname($_SERVER['SCRIPT_FILENAME']) : $_SERVER['DOCUMENT_ROOT'];
        $link         = is_file($documentRoot . '/loader-wizard.php') ? 'loader-wizard.php' : 'http://www.ioncube.com/lw/';
        die(js::locate($link, 'parent'));
    }

    return $this->loadExtension('ldapauth')->identify($account, $password, $user);
}

public function getLDAPConfig()
{
    return $this->loadExtension('ldapauth')->getLDAPConfig();
}

public function getLDAPUser()
{
    return $this->loadExtension('ldapauth')->getLDAPUser();
}

public function importLDAP()
{
    return $this->loadExtension('ldapauth')->importLDAP();
}

public function getUserWithoutLDAP()
{
    return $this->loadExtension('ldapauth')->getUserWithoutLDAP();
}