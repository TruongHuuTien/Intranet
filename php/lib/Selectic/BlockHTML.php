<?php
/**
 * Selectic BlockHTML
 *
 * @library    /
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */
 
class Selectic_BlockHTML extends Selectic_Template
{
	
	/**
     * Output HTML
     *
     * @var string
     */
	protected $_outputBlock = null;
	
	/**
     * Render the Block HTML
     *
     * @return string
     */
	public function render($file)
	{
		ob_start();
		include $file;
		$this->_outputBlock = ob_get_contents();
		ob_end_clean();
	}
	
	/**
     * Display a Block HTML template
     *
     * @return string
     */
	public function display()
	{
		if($this->_outputBlock !== null) {
			echo $this->_outputBlock;
		}
	}
	
	/**
	 * Returns the response as a string.
	 *
	 * @return  string  The response
	 */
	public function __toString()
	{
		if($this->_outputBlock !== null) {
			return $this->_outputBlock;
		}
	}
	
}
