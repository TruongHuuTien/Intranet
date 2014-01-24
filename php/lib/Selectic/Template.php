<?php
/**
 * Selectic Template
 *
 * @library    Selectic
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */
 
class Selectic_Template extends Selectic_Object
{
	/**
     * Language
     *
     * @var string
     */
	protected $_language = 'fr';
	
	/**
     * Output HTML
     *
     * @var string
     */
	protected $_output = null;
	
	/**
     * Dafault layout
     *
     * @var string
     */
	const DEFAULT_LAYOUT = 'index';
	
	/**
     * Template location
     *
     * @var string
     */
	const TEMPLATE_PATH = 'views';
	
	/**
	 * Initialize
	 */
	public function __construct()
    {
        
    }
	
	/**
	 * Set language
	 * 
	 * @param   string $lang
	 */
	public function setLanguage()
	{
		$this->_language = $lang;
	}
	
	/**
	 * Set title of the page
	 * 
	 * @return	string
	 */
	public function getTitle()
	{
		if(!is_null($this->getData('title'))) {
			return $this->getData('title');
		}
		
		return $this->__('My page title');
	}
	
	/**
     * Render the document HTML
     *
     * @return string
     */
	public function render()
	{
		$layout = ( $this->hasLayout() ? $this->getLayout() : self::DEFAULT_LAYOUT );
		
		ob_start();
		include BP . DS . self::TEMPLATE_PATH .DS . 'layout' . DS . $layout . '.php';
		$this->_output = ob_get_contents();
		ob_end_clean();
	}
	
	/**
     * Render the template HTML
     *
     * @return string
     */
	public static function renderBlockHTML($view, $extension = 'php')
	{
		if(empty($view)) {
			Selectic::logError("The view is not defined.");
			return;
		}
		
		$file = BP . DS . self::TEMPLATE_PATH . DS . $view . '.' . $extension;
		
		if(!file_exists($file)) {
			Selectic::logError("The template '" . $file . "' don't exist.");
			return;
		}
		
		$blockHTML = new Selectic_BlockHTML();
		$blockHTML->render($file);
		$blockHTML->display();
	}
	
	/**
     * Display a HTML template
     *
     * @return string
     */
	public function display()
	{
		if($this->_output !== null) {
			echo $this->_output;
		}
	}
	
	/**
	 * Returns the response as a string.
	 *
	 * @return  string  The response
	 */
	public function __toString()
	{
		if($this->_output !== null) {
			return $this->_output;
		}
	}
	
	/**
	 * Translate text
	 *
	 * @return	string
	 */
	public function __()
	{
		$args = func_get_args();
		$text = $args[0];
		$text_translate = Selectic_Helper::translate($text, $this->_language);
		
		return $text_translate;
	}
	
}
