<?php
	// Filename: /module/Blog/config/module.config.php
	return array(
		/*'db' => array(
			'driver'         => 'Pdo',
			'username'       => 'root',  //edit this
			'password'       => '',  //edit this
			'dsn'            => 'mysql:dbname=db_zendapp;host=localhost',
			'driver_options' => array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
			)
		),*/
		'service_manager' => array(
			/*'invokables' => array(
				'Blog\Service\PostServiceInterface' => 'Blog\Service\PostService'
			)*/
			'factories' => array(
				'Blog\Mapper\PostMapperInterface'   => 'Blog\Factory\ZendDbSqlMapperFactory',
				'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
				'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory'
			)
		),
		'view_manager' => array(
			'template_path_stack' => array(
				__DIR__ . '/../view',
			),
		),
		'controllers' => array(
			/*'invokables' => array(
				'Blog\Controller\List' => 'Blog\Controller\ListController'
			)*/
			'factories' => array(
				'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory',
				'Blog\Controller\Write' => 'Blog\Factory\WriteControllerFactory',
				'Blog\Controller\Delete' => 'Blog\Factory\DeleteControllerFactory'
			)
		),
		// This lines opens the configuration for the RouteManager
		'router' => array(
			// Open configuration for all possible routes
			'routes' => array(
				// Define a new route called "blog"
				'blog' => array(
					// Define the routes type to be "Zend\Mvc\Router\Http\Literal", which is basically just 11 'type' => 'literal',
					'type' => 'literal',		//'type' => 'Zend\Mvc\Router\Http\Literal',
					// Configure the route itself
					'options' => array(
						// Listen to "/blog" as uri
						'route'    => '/blog',
						// Define default controller and action to be called when this route is matched
						'defaults' => array(
							'controller' => 'Blog\Controller\List',
							'action'     => 'index',
						)
					),
					'may_terminate' => true,
					'child_routes'  => array(
						'detail' => array(
							'type' => 'segment',
							'options' => array(
								'route'    => '/:id',
								'defaults' => array(
									'action' => 'detail'
								),
								'constraints' => array(
									'id' => '[1-9]\d*'
								)
							)
						),
						'add' => array(
							'type' => 'literal',
							'options' => array(
								'route'    => '/add',
								'defaults' => array(
									'controller' => 'Blog\Controller\Write',
									'action'     => 'add'
								)
							)
						),
						'edit' => array(
							'type' => 'segment',
							'options' => array(
								'route'    => '/edit/:id',
								'defaults' => array(
									'controller' => 'Blog\Controller\Write',
									'action'     => 'edit'
								),
								'constraints' => array(
									'id' => '\d+'
								)
							)
						),
						'delete' => array(
							'type' => 'segment',
							'options' => array(
								'route'    => '/delete/:id',
								'defaults' => array(
									'controller' => 'Blog\Controller\Delete',
									'action'     => 'delete'
								),
								'constraints' => array(
									'id' => '\d+'
								)
							)
						),
					)
				)
			)
		)
	);
?>