<?php
$config = array(
	'RevisionControl' => array(
		'limit' 	=> 0,	// 世代制限 0:無し | 数値
		'models'	=> array(
			'Page' => array('Page', 'PageCategory'),
			'BlogPost' => array('BlogPost', 'BlogTag'),
		),
		'actsAs'	=> array(
			'BcUpload' => array(
				'BlogPost' => array(
					'eye_catch'
				)
			)
		),
		'views' => array(
			'BlogPost' => array('controller'=> 'blog_posts', 'action' => 'admin_edit'),
			'Page' => array('controller'=> 'pages', 'action' => 'admin_edit')
		),
		'filesDir' => '_rvc',
		
		// 除外フォーム
		'excludeFormId' => [
			'FavoriteAjaxForm',
			'PermissionAjaxAddForm',
		]
	),
);