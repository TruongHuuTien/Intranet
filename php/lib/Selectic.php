<?php
/**
 * Selectic
 *
 * @library    /
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */
 
class Selectic
{
	
	const LOG_LEVEL_0 = 'ERROR';
	const LOG_LEVEL_1 = 'DEBUG';
	const LOG_LEVEL_2 = 'WARNING';
	const LOG_LEVEL_3 = 'NOTICE';
	
	const FILENAME = 'log';	
	
	/**
     * Log
     *
     * @param string $message
     * @param integer $level
     * @param string $filename
     */
	public static function log($message, $level = 1, $filename = '')
	{
		date_default_timezone_set('America/Montreal');
		
		$filename = ( empty($filename) ? self::FILENAME : $filename);
		
		$path = BP . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR;
		$file = $path . DIRECTORY_SEPARATOR . $filename . ".log";

		$handle = fopen($file, 'a') or die("Can't open log file: " . $file);
		
		// Get timestamp		
		$time = date("d/m/Y|H:i:s", time());
			
		// Build message
		$log = $time . ' ' . constant('self::LOG_LEVEL_' . $level) . ' => ';
		$log.= $message ."\n";
		
		// write log
		fwrite($handle, $log);
		
		fclose($handle);
	}
	
	public static function logError($message) {
		Selectic::log($message, 0);
	}
	
	public static function getController()
	{
		// Get the route URL
		$requestUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$requestString = substr($requestUrl, strlen(ROOT_URL));
		
		$urlParams = explode('/', $requestString);
		
		$controllerName = 'Selectic_Controller_';
		
		// Default index controller
		if( $urlParams[0] == '' || $urlParams[0] == 'index' ) {
			$controllerName .= 'IndexController';
			$actionName = 'indexAction';
			$controller = new $controllerName();
			return $controller->$actionName();
		}
		
		// First argument : Controller name
		$controllerName .= ucfirst(array_shift($urlParams)) . 'Controller';
		
		// Second argument : Action name
		$actionName = strtolower(array_shift($urlParams)) . 'Action';
		
		// Default Action name if not specified
		if(empty($urlParams[1]) || $urlParams[1] == '') {
			$actionName = 'indexAction';
		}
		
		$pathController = str_replace(' ', DS, ucwords(str_replace('_', ' ', $controllerName)));
		$pathController = BP . DS . 'lib' . DS . $pathController . '.php';
		
		if(!file_exists($pathController)) {
			Selectic::logError("The controller " . $controllerName . " doesn't exist.");
			throw new Exception("The controller " . $controllerName . " doesn't exist.");
		}
		
		if(class_exists($controllerName)) {
			$controller = new $controllerName();
			return $controller->$actionName();
		}
	}
	
}
