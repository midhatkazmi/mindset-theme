<?php
// This file is generated. Do not modify it manually.
return array(
	'company-address' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mindset-blocks/company-address',
		'version' => '1.0.0',
		'title' => 'Company Address',
		'category' => 'text',
		'icon' => 'location',
		'description' => 'Display the company address.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'svgIcon' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'textdomain' => 'company-address',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'company-email' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mindset-blocks/company-email',
		'version' => '1.0.0',
		'title' => 'Company Email',
		'category' => 'text',
		'icon' => 'email',
		'description' => 'Display the company email.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'svgIcon' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'textdomain' => 'company-email',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'copyright-date' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mindset-blocks/copyright-date',
		'version' => '0.1.0',
		'title' => 'Copyright Date',
		'category' => 'text',
		'icon' => 'calendar',
		'description' => 'Display a copyright date.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'typography' => array(
				'textAlign' => true,
				'fontSize' => true
			),
			'spacing' => array(
				'padding' => true,
				'margin' => true
			)
		),
		'attributes' => array(
			'startingYear' => array(
				'type' => 'number',
				'default' => 2020
			)
		),
		'textdomain' => 'copyright-date',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'service-posts' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mindset-blocks/service-posts',
		'version' => '1.0.0',
		'title' => 'Service Posts',
		'category' => 'widgets',
		'icon' => 'forms',
		'description' => 'A block to display the Service posts with in-page navigation at the top',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'service-posts',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css'
	),
	'testimonial-slider' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mindset-blocks/testimonial-slider',
		'version' => '1.0.0',
		'title' => 'Testimonial Slider',
		'category' => 'widgets',
		'icon' => 'editor-quote',
		'description' => 'A slider of testimonials.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'multiple' => false
		),
		'attributes' => array(
			'navigation' => array(
				'type' => 'boolean',
				'default' => true
			),
			'pagination' => array(
				'type' => 'boolean',
				'default' => true
			),
			'arrowColor' => array(
				'type' => 'string',
				'default' => 'var(--wp--preset--color--accent);'
			)
		),
		'textdomain' => 'testimonial-slider',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js'
	)
);
