<?php
class Cli_Commands
{
    use Di_Magic;

    protected $_collection = [];

    protected function _getItem($name)
    {
        if (!empty($this->_collection[$name])) {
            return $this->_collection[$name];
        }

        switch ($name) {
            case 'tasks':
                $object = new Cli_Tasks($name);
                break;
            default:
                throw new Cli_Exception('Неизвестная модель');
        }

        $this->_collection[$name] = $object;
    }

    public function getTasks()
    {
        
    }
}
