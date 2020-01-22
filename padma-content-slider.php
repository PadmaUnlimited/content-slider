<?php

/*
Plugin Name:	Padma Content Slider
Plugin URI:		https://www.padmaunlimited/plugins/content-slider
Description:  	Padma Content Slider is a WordPress plugin that turns your posts into a post slider in different styles. Post slider is touch friendly and responsive for all devices.
Version:		1.0.6
Author: 		Padma Unlimited Team
Author URI: 	https://www.padmaunlimited.com/
License:      	GPL2
License URI:  	https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  	padma-content-slider
Domain Path:  	/languages


Padma Filter Gallery plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Padma Filter Gallery plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Padma Filter Gallery plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


defined('ABSPATH') or die( 'Access Forbidden!' );


add_action('after_setup_theme', 'register_content_slider_block');
function register_content_slider_block() {

    if ( !class_exists('Padma') )
		return;

	require_once 'block.php';
	require_once 'block-options.php';
	
	if (!class_exists('PadmaBlockAPI') )
		return false;


	$class = 'PadmaContentSliderBlock';
	$block_type_url = substr(WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), '', plugin_basename(__FILE__)), 0, -1);		
	$class_file = __DIR__ . '/block.php';
	$icons = array(
			'path' => __DIR__,
			'url' => $block_type_url
		);

	padma_register_block(
		$class,
		$block_type_url,
		$class_file,
		$icons
	);
	

	/**
	 *
	 * Check if there is the Padma Loader
	 *
	 */		
	if ( version_compare(PADMA_VERSION, '1.1.70', '<=') ){			
		include_once $class_file;
	}

}