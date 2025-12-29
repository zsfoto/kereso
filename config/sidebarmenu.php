<?php
return [
	'Theme' => [
		'admin' => [
			'sidebar' => [
				'title' => 'JeffAdmin5',
				
			],
			'sidebarMenu' => [
				'Admin' => [
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Categories'),
						'controller'=> 'Categories',
						'action' 	=> 'index',
					],

					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Companies'),
						'controller'=> 'Companies',
						'action' 	=> 'index',
					],
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Persons'),
						'controller'=> 'Persons',
						'action' 	=> 'index',
					],

					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Icons'),
						'controller'=> 'Icons',
						'action' 	=> 'index',
					],

					
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Cities'),
						'controller'=> 'Cities',
						'action' 	=> 'index',
					],
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Countries'),
						'controller'=> 'Countries',
						'action' 	=> 'index',
					],
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Counties'),
						'controller'=> 'Counties',
						'action' 	=> 'index',
					],



/*
					[
						'type' 		=> 'submenu',
						'title'		=> __('Tables'),
						'icon'		=> 'fa fa-fw fa-table',
						'items'		=> [
							[
								'title' 		=> __('Posts'),
								'controller' 	=> 'Posts',
								'action' 		=> 'index',								
							],
							[
								'title' 		=> __('Categories'),
								'controller' 	=> 'Categories',
								'action' 		=> 'index',								
							],
						]
					],
*/
				],				
			]		
		]	
	],

];

?>
