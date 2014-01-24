<?php

/**
 * Autoload
 *
 * @library    /
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */

class Autoload
{
	
	static protected $_instance;
	
	/**
     * Class constructor
     */
    public function __construct()
    {
        set_include_path(BP . DS . 'lib' . DS);
    }
	
	/**
     * Singleton pattern implementation
     *
     * @return Autoload
     */
    static public function instance()	
    {
        if (!self::$_instance) {
            self::$_instance = new Autoload();
        }
        return self::$_instance;
    }
	
	/**
     * Register SPL autoload function
     */
    static public function register()
    {
        spl_autoload_register(array(self::instance(), 'autoload'));
    }
	
	/**
     * Load class source code
     *
     * @param string $class
     */
    public function autoload($class)
    {
        
        $classFile = str_replace(' ', DS, ucwords(str_replace('_', ' ', $class)));
        
        $classFile .= '.php';
		
        return require_once $classFile;
    }
	
}