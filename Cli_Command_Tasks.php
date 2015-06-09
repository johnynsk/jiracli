<?php
class Cli_Command_Tasks extends Cli_Command_Abstract
{
    public function getAll()
    {
        $client = $this->_di->getClient();
    }
}
