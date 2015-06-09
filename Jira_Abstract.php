<?php
class Jira_Abstract
{
    use Di_Magic;

    protected $_initialized;

    protected $_project;

    public function __construct(Di $di)
    {
        $this->setDi($di);

        $config = $this->_di->getConfig();

        if (!empty($config['jira']['project'])) {
            $this->_project = $config['jira']['project'];
        }

        if (!empty($config['jira']['host'])) {
            $this->_host = $config['jira']['host'];
        }
    }

    public function getAll()
    {
        if (!$this->_initialized) {
            $this->init();
        }
    }
}
