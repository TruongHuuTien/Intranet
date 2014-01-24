<?php
/**
 * Selectic Controller Render
 *
 * @library    Selectic
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */
 
class Selectic_Controller_RenderController extends Selectic_Object
{

	/**
	 * Index action
	 */	
	public function indexAction()
	{
		$template = $_REQUEST['template'];
		
		$block = Selectic_Template::renderBlockHTML($template);
		
	}
	
}
