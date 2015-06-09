<?php
class Config
{
    protected $_config = [];

    public function get($section = null)
    {
        if (empty($section)) {
            return $this->_config;
        }
    }

    public function read($fileName)
    {
        $content = file_get_contents($fileName);
        $config = json_decode($content, true);

        if (empty($config)) {
            throw new Config_Exception('Не удалось распарсить данные');
        }

        $this->_config = $config;
    }


    public function __construct($fileName = 'config.js')
    {
        $this->read($fileName);
    }
}
