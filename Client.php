<?php
class Client
{
    use Di_Magic;

    protected $_curl;

    public function init()
    {
        $config = $this->_di->getConfig()->get('curl');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    }

    protected function _setOptions($url, $params = null, $method = 'GET')
    {
        if (is_array($params)) {
            $params = http_build_query($params);
        }

        if (!empty($params)) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);
        }

        curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, $method);
    }

    protected function _call()
    {
        $result = curl_exec($this->_curl);
        return $result;
    }

    public function get($url)
    {
        $this->_setOptions($url);

        return $this->_call();
    }


    public function post($url, $params = null)
    {
        $this->_setOptions($url, $params, 'POST');

        return $this->_call();
    }


    public function put($url, $params)
    {
        $this->_setOptions($url, $params, 'PUT');

        return $this->_call();
    }


    public function delete($url, $params)
    {
        $this->_setOptions($url, $params, 'DELETE');

        return $this->_call();
    }
}
