<?php
class Cli
{
    use Di_Magic;

    protected $_running = true;

    protected $_welcome = [];

    protected $_history = [];

    protected $_columns;

    protected $_lines;

    protected function _processString($string)
    {
        if (preg_match("#^(show task|st) (.*)#", $string, $match)) {
            $this->_di()->getTasks()->process($match[1]);
        }
        return $string;
    }


    public function autoComplete($message)
    {
        $result = [];
        $message = trim(preg_replace('#\s+#', ' ', $message));

        return $result;
    }


    protected function _iterator()
    {
        $this->_columns = exec('tput cols');
        $this->_lines = exec('tput lines');
    }


    public function getSizes()
    {
        return ['columns' => $this->_columns, 'lines' => $this->_lines];
    }


    public function run()
    {
        $this->_running = true;
        $this->_welcome[] = '> ';

        readline_completion_function(array($this, 'autoComplete'));
        while($this->_running) {
            try {
                $message = readline(end($this->_welcome));
                $message = preg_replace('#\s+#', ' ', $message);
                $this->_iterator();
                $this->_processString($message);
                readline_add_history($message);
            } catch (Cli_Exception $e) {
                if ($e->getCode() == -1) {
                    var_dump($e);
                    $this->_running = false;
                }
            }
        }
    }

    public function terminate($msg)
    {
    }


    public function _di()
    {
        return $this->_di;
    }
}

