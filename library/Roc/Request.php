<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/4/3
 * Time: 14:30
 */
class Request
{
    /**
     * Module
     */
    protected $_module;
    /**
     * Controller
     */
    protected $_controller;
    /**
     * Action
     */
    protected $_action;

    /**
     * Method
     */
    protected $_method;

    /**
     * Has the action been dispatched?
     */
    protected $_dispatched = false;

    /**
     * Request parameters
     */
    protected $_params = array();
    /**
     * routed
     */
    protected $_routed;

    /**
     * REQUEST_URI
     */
    protected $_requestUri;

    /**
     * base_uri
     */
    protected $_baseUri;
    protected $_payload;

    /**
     * Retrieve the action name
     *
     * @return string
     */
    public function getActionName ()
    {
        return $this->_action;
    }

    public function getBaseUri ()
    {
        return $this->_baseUri;
    }

    public function setBaseUri ($baseUri = null)
    {
        return $this->_baseUri = $baseUri;
    }

    /**
     * Retrieve the controller name
     *
     * @return string
     */
    public function getControllerName ()
    {
        return $this->_controller;
    }
    /**
     * Retrieve the method
     *
     * @return string
     */
    public function getMethod ()
    {
        if (null === $this->_method) {
            $method = $this->getServer('REQUEST_METHOD');
            if ($method) {
                $this->_method = $method;
            } else {
                $sapiType = php_sapi_name();
                if (strtolower($sapiType) == 'cli' || substr($sapiType, 0, 3) == 'cgi') {
                    $this->_method = 'CLI';
                } else {
                    $this->_method = 'Unknown';
                }
            }
        }

        return $this->_method;
    }

    public function getModuleName ()
    {
        return $this->_module;
    }

    /**
     * Get an action parameter
     *
     * @param string $key
     * @param mixed $default
     *            Default value to use if key not found
     *
     * @return mixed
     */
    public function getParam ($name, $default = null)
    {
        $name = (string) $name;
        if (isset($this->_params[$name])) {
            $value = $this->_params[$name];
            if (is_string($value)) {
                $value = trim($value);
            }

            return $value;
        }

        return $default;
    }

    public function setPayload ($data)
    {
        $this->_payload = $data;
    }

    public function getPayload ()
    {
        return $this->_payload;
    }

    /**
     * Get all action parameters
     *
     * @return array
     */
    public function getParams ()
    {
        return $this->_params;
    }

    public function getRequestUri ()
    {
        return $this->_requestUri;
    }

    /**
     * Retrieve a member of the $_SERVER superglobal
     *
     * If no $key is passed, returns the entire $_SERVER array.
     *
     * @param string $key
     * @param mixed $default
     *            Default value to use if key not found
     *
     * @return mixed Returns null if key does not exist
     */
    public function getServer ($name = null, $default = null)
    {
        if (null === $name) {
            return $_SERVER;
        }

        return (isset($_SERVER[$name])) ? $_SERVER[$name] : $default;
    }

    public function isCli ()
    {
        if ('CLI' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the request has been dispatched
     *
     * @return boolean
     */
    public function isDispatched ()
    {
        return $this->_dispatched;
    }

    /**
     * Was the request made by GET?
     *
     * @return boolean
     */
    public function isGet ()
    {
        if ('GET' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Was the request made by HEAD?
     *
     * @return boolean
     */
    public function isHead ()
    {
        if ('HEAD' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Was the request made by OPTIONS?
     *
     * @return boolean
     */
    public function isOptions ()
    {
        if ('OPTIONS' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Was the request made by POST?
     *
     * @return boolean
     */
    public function isPost ()
    {
        if ('POST' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Was the requst made by AJAX?
     *
     * @return bool
     */
    public function isAjax ()
    {
        return ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) ? true : false;
    }

    /**
     * Was the request made by PUT?
     *
     * @return boolean
     */
    public function isPut ()
    {
        if ('PUT' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Was the request made by DELETE?
     *
     * @return boolean
     */
    public function isDelete ()
    {
        if ('DELETE' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Is the request a Javascript XMLHttpRequest?
     *
     * Should work with Prototype/Script.aculo.us, possibly others.
     *
     * @return boolean
     */
    public function isXmlHttpRequest ()
    {
        return (strcasecmp($this->getServer('HTTP_X_REQUESTED_WITH'), 'XMLHttpRequest') == 0 ? true : false);
    }

    /**
     * Determine if the request has been routed
     *
     * @return boolean
     */
    public function isRouted ()
    {
        return $this->_routed;
    }

    /**
     * Set the action name
     *
     * @param string $value
     *
     * @return Yaf_Request_Abstract
     */
    public function setActionName ($action)
    {
        if (! is_string($action)) {
            throw new Yaf_Exception('Expect a string action name');
        }
        $this->_action = $action;
        if (null === $action) {
            $this->setParam('action', $action);
        }

        return $this;
    }

    /**
     * Set the controller name to use
     *
     * @param string $value
     *
     * @return Yaf_Request_Abstract
     */
    public function setControllerName ($controller)
    {
        if (! is_string($controller)) {
            throw new Yaf_Exception('Expect a string controller name');
        }
        $this->_controller = $controller;

        return $this;
    }

    public function setDispatched ($dispatched = true)
    {
        $this->_dispatched = $dispatched;
    }

    /**
     * Set the module name to use
     *
     * @param string $value
     *
     * @return Yaf_Request_Abstract
     */
    public function setModuleName ($module)
    {
        if (! is_string($module)) {
            throw new Yaf_Exception('Expect a string module name');
        }
        $this->_module = $module;

        return $this;
    }

    /**
     * Set an action parameter
     *
     * A $value of null will unset the $key if it exists
     *
     * @param string $key
     * @param mixed $value
     *
     * @return Yaf_Request_Abstract
     */
    public function setParam ($name, $value = null)
    {
        if (is_array($name)) {
            $this->_params = $this->_params + (array) $name;
            $_REQUEST = $_REQUEST + (array) $name;

            /*
             * foreach ($name as $key => $value) { if (null === $value) { unset($this->_params[$key]); } }
             */
        } else {
            $name = (string) $name;

            /*
             * if ((null === $value) && isset($this->_params[$name])) { unset($this->_params[$name]); } elseif (null !== $value) { $this->_params[$name] = $value; }
             */
            $this->_params[$name] = $value;
            $_REQUEST[$name] = $value;
        }

        return $this;
    }

    /**
     * Unset all user parameters
     *
     * @return Yaf_Request_Abstract
     */
    public function clearParams ()
    {
        $this->_params = array();

        return $this;
    }

    public function setRequestUri ($requestUri = null)
    {
        $this->_requestUri = $requestUri;

        return $this;
    }

    /**
     * Set flag indicating whether or not request has been dispatched
     *
     * @param boolean $flag
     *
     * @return Yaf_Request_Abstract
     */
    public function setRouted ($flag = true)
    {
        $this->_routed = $flag ? true : false;

        return $this;
    }
}