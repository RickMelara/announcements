<?php

//Verify if is network admin
	/*******************************
	* Checking if Redux is REAL!! *
	*******************************/
	if ( ! class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/framework/ReduxCore/framework.php' ) ) :
		require_once( dirname( __FILE__ ) . '/framework/ReduxCore/framework.php' );
	endif;
	
	/**************
	* Option Name *
	**************/
	$opt_name = "reduxTest";

	//Arguments
	$args = array(
		'opt_name' 				=> $opt_name,
		'display_name' 			=> 'UAM Site Announcements',
		'display_version' 		=> '0.2',
		'database'				=> 'network',
		'network_admin'			=> true,
		'network_sites'			=> false,
		'allow_sub_menu'		=> false,
		'menu_title'        	=> 'UAM Site Announcements',
		'page_title'     		=> 'UAM Site Announcements',
		'google_api_key'       	=> '',
		'google_update_weekly' 	=> false,
		'async_typography'     	=> true,
		'admin_bar'            	=> true,
		'admin_bar_icon'       	=> 'dashicons-lightbulb',
		'admin_bar_priority'   	=> 50,
		'global_variable'      	=> '',
		'dev_mode'             	=> true,
		'update_notice'        	=> true,
		'customizer'           	=> true,
		'page_priority'        	=> null,
		'page_parent'          => 'themes.php',
		'page_permissions'     => 'manage_options',
		'menu_icon'            => 'dashicons-lightbulb',
		'last_tab'             => '',
		'page_icon'            => 'icon-themes',
		'page_slug'            => '',
		'save_defaults'        => true,
		'default_show'         => false,
		'default_mark'         => '',
		'show_import_export'   => true
	);

	//Setting Args
	Redux::setArgs( $opt_name, $args );

	//Setting General Section
	Redux::setSection( $opt_name, array(
			'title'		=> 'General',
			'id'		=> 'uam_announcements_general_options',
			'fields'	=> array(
				array(
					'id'		=>	'uam_announcements_state',
					'type'		=>	'switch',
					'on'		=>	'On',
					'off'		=>	'Off',
					'title'		=>	'General State of Plugin'
				),
				array(
					'id'		=>	'uam_announcements_default_text',
					'type'		=>	'select',
					'title'		=>	'Default Text',
					'options'	=>	array(
						'site_name'	=>	'Site Name',
						'site_id' 	=>	'Site ID'
					)
				),
				array(
					'id'    		=>  'uam_border_options',
					'type'  		=>  'border',
					'all'   		=>  false,
					'left'  		=>  false,
					'right' 		=>  false,
					'bottom'		=>  false,
					'top'   		=>  true,
					'title' 		=>  'Default Border Options',
					'output'    => array('.uamAnnouncementsBar'),
					'default'		=>	array(
						'border-color'	=>	'#D1D1D1',
						'border-style'  => 	'solid',
						'border-top'	=>	'3px'
					)
				)
			)
		)
	);

	//Setting Sites Sections
	foreach (wp_get_sites() as $sites) :
		$name = get_blog_details($sites['blog_id'])->blogname;
		$id = get_blog_details($sites['blog_id'])->blog_id;

		Redux::setSection( $opt_name, array(
			'title' 	=> $name,
			'id'		=> 'site_' . $id,
			'fields'    => array(
				array(
					'id'       		=> 'uam_announcements_bar_site_state_' . $id,
					'type'     		=> 'switch',
					'on'        	=> 'On',
					'off'       	=> 'Off',
					'title'    		=> 'Bar State for ' . $name,
					'desc'     		=> 'Turn On or Off the Announcement Bar',
					'default'  		=> '1'
				),
				array(
					'id'    		=> 'uam_text_color_' . $id,
					'type'  		=> 'color',
					'title' 		=> 'Text Color',
					'desc'			=> 'Select Text Color',
					'output'		=>	array( '#uamAnnouncementsBar_' . $id ),
					'default'		=>	'#FFFFFF'
				),
				array(
					'id'    		=>  'uam_border_options_' . $id,
					'type'  		=>  'border',
					'all'   		=>  false,
					'left'  		=>  false,
					'right' 		=>  false,
					'bottom'		=>  false,
					'top'   		=>  true,
					'output'    	=>	array( '#uamAnnouncementsBar_' . $id ),
					'title' 		=>  'Border Options'
				),
				array(
					'id'			=>	'uam_announcements_bg_color_' . $id,
					'type'			=>	'background',
					'title'			=>	'Bar Background',
					'output'		=>	array( '#uamAnnouncementsBar_' . $id ),
					'default'   	=> 	array(
						'background-color'     => 	'#E8B733'
					),
				),
				array(
					'id'            =>  'uam_announcement_text_' . $id,
					'type'          =>  'editor',
					'title'         =>  'Text to Display',
					'full_width'    =>  true,
					'desc'			=>	'Write the Text You Want to Display',
					'default'		=>	'Default',
					'args'			=> 	array(
						'media_buttons'	=>  false,
						'tenny'			=>  true
					)
				)
			)
		) );
	endforeach;
?>