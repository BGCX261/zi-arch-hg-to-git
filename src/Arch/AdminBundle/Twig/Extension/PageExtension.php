<?php
/**
 * Created by b17
 * 4/14/12 12:11 PM
 */

namespace Arch\AdminBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Request;

class PageExtension extends \Twig_Extension
{
    protected $_request;

    public function __construct(Request $request)
    {
        $this->_request = $request;
    }

    public function getFunctions()
    {
        return array(
            'controllerName'    =>  new \Twig_Function_Method($this, 'getControllerName'),
            'actionName'        =>  new \Twig_Function_Method($this, 'getActionName'),
        );
    }

    public function getControllerName()
    {
        $controllerTemplate = $this->_request->get('_controller');
        $pattern = "#Controller\\\([a-zA-Z]*)Controller#";
        preg_match($pattern, $controllerTemplate, $matches);
        return $matches[1];
    }

    public function getActionName()
    {
        $pattern = "#::([a-zA-Z]*)Action#";
        preg_match($pattern, $this->_request->get('_controller'), $matches);
        return $matches[1];
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'admin_page';
    }
}
