<?php

return array(

	/**
	 * Build a PongoCMS interface form
	 *
	 * key_index => input field | db column name
	 * 		
	 * 		form => Form class method
	 *   	type => SchemaBuilder method
	 *    	len => DB field length
	 *     	validate => validation rules (optional)
	 * 
	 */
	'user_details' => array(

		'name' => array(

			'form' 		=> 'text',
			'type' 		=> 'string',
			'len'  		=> 255,
			'validate' 	=> 'required|min:2'

		),

		'surname' => array(

			'form' 		=> 'text',
			'type' 		=> 'string',
			'len'  		=> 255,
			'validate' 	=> 'required|min:2'

		),

		'city' => array(

			'form' 		=> 'text',
			'type' 		=> 'string',
			'len'  		=> 255

		),

		'bio' => array(

			'form' 		=> 'textarea',
			'type' 		=> 'text',
			'len'  		=> null

		),

		'birth_date' => array(

			'form' 		=> 'date',
			'type' 		=> 'date',
			'len'  		=> null

		),

	),

);