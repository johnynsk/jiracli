<?php
class Cli_String
{
    protected $_sizes = [];

    protected function _changeColor($textColor, $backgroundColor)
    {
        
    }

    public function output($string, $textColor = null, $backgroundColor = null)
    {
        $this->_sizes = $this->di()->getCli()->getSizes();
    }

}
