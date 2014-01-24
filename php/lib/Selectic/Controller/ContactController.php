<?php
/**
 * Selectic Controller Contact
 *
 * @library    Selectic
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */
 
class Selectic_Controller_ContactController extends Selectic_Object
{

	/**
	 * Index action
	 */	
	public function indexAction()
	{
		$template = new Selectic_Template();
		
		$template->setLayout('contact');
		$template->render();
		$template->display();
	}
	
}
