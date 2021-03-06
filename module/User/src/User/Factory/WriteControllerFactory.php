<?php
	namespace User\Factory;
	
	use User\Controller\WriteController;
	use Zend\ServiceManager\FactoryInterface;
	use Zend\ServiceManager\ServiceLocatorInterface;
	
	class WriteControllerFactory implements FactoryInterface{
		public function createService(ServiceLocatorInterface $serviceLocator){
			$realServiceLocator = $serviceLocator->getServiceLocator();
			$userService		= $realServiceLocator->get('User\Service\UserServiceInterface');
			$userInsertForm		= $realServiceLocator->get('FormElementManager')->get('User\Form\UserForm');
			
			return new WriteController($userService, $userInsertForm);
		}
	}
?>