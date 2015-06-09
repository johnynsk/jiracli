<?php
trait Di_Magic
{
    protected $_di;

    public function setDi($di)
    {
        $this->_di = $di;
    }
}
