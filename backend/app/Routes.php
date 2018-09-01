<?php namespace Bidding;

Class Routes
{
	private $methods;
	private $controller;
	private $params = array();
	
	public function __construct()
	{
		$this->method = "index";
		$this->controller = "HomeController";
	}
	
	public function pages($request)
	{
		if(count($request)==0)
		{
			echo "got nere";
			$useMethods[0] = $this->controller;
			$useMethods[1] = $this->method;			
		}
		else
		{
			echo "got nere2";

			$useMethods = explode("/", rtrim($request['uri']));
			//$useMethods = $useMethod;

			if($useMethods[0] == '')
			{
				$useMethods[0] = $this->controller;
			}
			
			if(!isset($useMethods[1]))
			{
				$useMethods[1] = $this->method;			
			}
		}

		$params[] = $request;

		//declare the class name
		$className = 'Bidding\\Controllers\\'.ucfirst($useMethods[0]);
		$class = new $className;
		
		try
		{
			$ret_value = call_user_func_array(array($class, $useMethods[1]), $params); // As of PHP 5.3.0						
		}
		catch(Exception $e)
		{
			echo $e->getMessages();
		}
	}
}