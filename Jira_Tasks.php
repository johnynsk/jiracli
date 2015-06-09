<?php
class Jira_Tasks extends Jira_Abstract
{
    public function getAll()
    {
        $this->_di->getClient();
    }
}
