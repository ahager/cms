<?php

return array(

	'alert' => array(

		'info' => array(
			
			'logout'		=> 'Non sei più loggato!',
			'page_lang'		=> 'Stai inserendo in :lang',
			'welcome'		=> 'Bentornato, :user!',

		),

		'error' => array(

			'element_created'	=> 'Impossibile creare l\'elemento!',
			'element_order'		=> 'Impossibile salvare l\'ordinamento',
			'login' 			=> 'Accesso vietato, riprova nuovamente!',			
			'not_granted'		=> 'Modifica non consentita',
			'page_cant_delete'	=> 'Impossibile eliminare questa pagina',
			'page_created'		=> 'Impossibile creare la pagina',
			'page_has_elements'	=> 'Questa pagina contiene ancora elementi!',
			'page_has_subpages'	=> 'Questa pagina contiene ancora sottopagine!',
			'page_lang'			=> 'Impossibile cambiare lingua',
			'page_order'		=> 'Impossibile salvare l\'ordinamento',
			'save'				=> 'Errore di salvataggio',
			'session_exp'		=> 'Sessione scaduta, esegui login!',
			'unauthorized'		=> 'Accesso non autorizzato, esegui login!',
			'input_validator'	=> 'Verifica i dati inseriti!',

		),

		'success' => array(

			'element_created'	=> 'Nuovo elemento creato!',
			'element_order'		=> 'Ordine degli elementi salvato!',
			'page_created'		=> 'Nuova pagina creata!',
			'page_deleted'		=> 'La pagina è stata eliminata!',
			'page_order'		=> 'Ordine di pagina salvato!',
			'save'				=> 'Informazioni salvate!',

		),

	),

	'form' => array(

		'button' => array(

			'cancel'	=> 'Annulla',
			'choose'	=> 'Seleziona file',
			'clone'		=> 'Clona',
			'element' 	=> 'Elemento',
			'delete'	=> 'Elimina',
			'ok'		=> 'Ok',
			'page' 		=> 'Pagina',
			'save'		=> 'Salva',
			'upload'	=> 'Carica',

		),

		'select' => array(

			'admin' 	=> 'Amministratore',
			'blogs'		=> 'Blog e notizie',
			'editor' 	=> 'Editore',
			'guest' 	=> 'Visitatore',
			'manager' 	=> 'Manager',
			'pages'		=> 'Altre pagine',
			'products'	=> 'Prodotti',
			'user' 		=> 'Utente',
			
		),

	),

	'heading' => array(

		'element' => array(

			'bar_title' => 'Elementi di pagina',

		),

		'option' => array(

			'bar_title' => 'Opzioni',

		),

		'page' => array(

			'bar_title' 		=> 'Gestione pagine',
			'layout_title' 		=> 'Layout',
			'seo_title'		 	=> 'Seo',
			'files_title' 		=> 'Files',
			'linked_title' 		=> 'Pagine collegate',
			'settings_title' 	=> 'Impostazioni',

		),

	),

	'label' => array(

		'page' => array(

			'settings' => array(

				'browse_by' 	=> 'Chi la può vedere?',
				'create_slug' 	=> 'Slug',
				'edit_by' 		=> 'Chi la può modificare?',
				'force_delete'	=> 'Rimuovi la pagina e svincola tutti gli elementi',
				'may_contain'	=> 'Cosa potrà contenere?',
				'name' 			=> 'Nome pagina',
				'set_hp' 		=> 'Home Page',
				'slug' 			=> 'Indirizzo pagina',
				'slug_preview'	=> 'Indirizzo completo',

			),

			'layout' => array(

				'template'		=> 'Template di pagina',
				'header'		=> 'Header di pagina',
				'layout'		=> 'Layout di pagina',
				'footer'		=> 'Footer di pagina',

			),

			'seo'	=> array(

				'title'	=> 'Page title',
				'keyw'	=> 'Page keywords',
				'descr'	=> 'Page decription',

			),

			'files'	=> array(

				'max_upload' => 'Dimensione massima',
				'mimes' => 'Formati consentiti',

			),	

		),

	),

	'modal' => array(

		'title' => array(

			'delete_page' => 'Eliminare questa pagina?',

		),

	),

	'template' => array(

		'element' => array(

			'new'			=> 'Nuovo elemento',

		),

		'page' => array(

			'new'			=> 'Nuova pagina',

		),

	),

	'validation' => array(

		'errors' => array(

			'file_mimes'	=> 'Il formato del file non è consentito.',
			'unique_file' 	=> 'Questo file è già presente nel sistema.',
			'file_size'		=> 'Questo file è superiore al limite consentito.',
			'required' 		=> 'Il campo :attribute è obbligatorio.',

		),

	),

);