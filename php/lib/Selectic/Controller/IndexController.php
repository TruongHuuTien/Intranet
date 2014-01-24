<?php
/**
 * Selectic Controller Index
 *
 * @library    Selectic
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */
 
class Selectic_Controller_IndexController extends Selectic_Object
{

	/**
	 * Index action
	 */	
	public function indexAction()
	{
		$template = new Selectic_Template();
		
		$template->render();
		$template->display();
	}
	
}
