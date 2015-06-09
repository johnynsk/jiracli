<?php
class Di
{

    protected $_raw = [];


    protected $_objects = [];


    public function set($nameOrArray, $callback = null)
    {
        if (is_array($nameOrArray)) {
            foreach ($nameOrArray as $name => $callback) {
                $this->set($name, $callback);
            }
            return;
        }
        $name = strtolower($nameOrArray);

        $this->_raw[$name] = $callback;
    }


    public function get($name, $arguments = [], $new = false)
    {
        if (!$new) {
            if (!empty($this->_objects[$name])) {
                return $this->_objects[$name];
            }
        }

        if (!array_key_exists($name, $this->_raw)) {
            throw new Di_Exception('Нет инициализации ресурса ' . $name);
        }

        if (is_callable($this->_raw[$name])) {
            $object = call_user_func($this->_raw[$name], $arguments);
        } elseif (is_scalar($this->_raw[$name])) {
            $object = new $this->_raw[$name]();
            if (method_exists($object, 'setDi')) {
                $object->setDi($this);
            }
        } elseif (is_object($this->_raw[$name])) {
            $object = $this->_raw[$name];
        }

        $this->_objects[$name] = $object;

        return $object;
    }


    public function __call($name, $args)
    {
        $objectName = $name;

        if (preg_match('#get(.*)#', $name, $match)) {
            $objectName = $match[1];
        }

        $objectName = strtolower($objectName);

        return $this->get($objectName);
    }
}
