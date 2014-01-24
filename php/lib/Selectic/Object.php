<?php
/**
 * Selectic Object
 *
 * @library    Selectic
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */
 
class Selectic_Object
{
	/**
     * Object attributes
     *
     * @var array
     */
    protected $_data = array();
	
	/**
     * Set/Get attribute wrapper
     *
     * @param   string $method
     * @param   array $args
     * @return  mixed
     */
    public function __call($method, $args)
    {	
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method,3));
                $data = $this->getData($key, isset($args[0]) ? $args[0] : null);
                return $data;

            case 'set' :
                $key = $this->_underscore(substr($method, 3));
                $result = $this->setData($key, isset($args[0]) ? $args[0] : null);
                return $result;

            case 'uns' :
                $key = $this->_underscore(substr($method,3));
                $result = $this->unsetData($key);
                return $result;

            case 'has' :
                $key = $this->_underscore(substr($method,3));
                return isset($this->_data[$key]);
        }
		throw new Exception("Invalid method " . get_class($this) . "::" . $method . "(" . print_r($args, 1) . ")");
    }
	
	/**
     * Write data in the object.
     *
     * @param string $key
     * @param mixed $value
     * @return Selectic_Object
     */
    public function setData($key, $value = null)
    {
        $this->_data[$key] = $value;
		
        return $this;
    }
	
	/**
     * Retrieves data from the object
     *
     * @param string $key
     * @return mixed
     */
    public function getData($key = '')
    {
        if ('' === $key) {
            return $this->_data;
        }

        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }
    }
	
	/**
     * Unset data from the object.
     *
     * @param string $key
     * @return Selectic_Object
     */
    public function unsetData($key = null)
    {
        if (is_null($key)) {
            $this->_data = array();
        } else {
            unset($this->_data[$key]);
        }
        return $this;
    }
	
	/**
     * Checks if the specified attribute is set.
     *
     * @param string $key
     * @return boolean
     */
    public function hasData($key = '')
    {
        if (empty($key) || !is_string($key)) {
            return !empty($this->_data);
        }
        return array_key_exists($key, $this->_data);
    }
	
	/**
     * Converts field names for setters and geters
     *
     * $this->setMyField($value) === $this->setData('my_field', $value)
     *
     * @param string $name
     * @return string
     */
    protected function _underscore($name)
    {
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
        return $result;
    }
	
}
