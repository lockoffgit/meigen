<?php
/**
 * Opauth basic configuration file to quickly get you started
 * ==========================================================
 * To use: rename to opauth.conf.php and tweak as you like
 * If you require advanced configuration options, refer to opauth.conf.php.advanced
 */

$config = array(
/**
 * Path where Opauth is accessed.
 *  - Begins and ends with /
 *  - eg. if Opauth is reached via http://example.org/auth/, path is '/auth/'
 *  - if Opauth is reached via http://auth.example.org/, path is '/'
 */
	'path' => '/',

/**
 * Callback URL: redirected to after authentication, successful or otherwise
 */
	'callback_url' => '{path}callback.php',
	
/**
 * A random string used for signing of $auth response.
 */
	'security_salt' => 'LDFm1iilYf8Fyw5W10rx4W1KsVrieQCnpBzzpTBWA5vJidQKDx8pMJbmw28R1C4m',
		
/**
 * Strategy
 * Refer to individual strategy's documentation on configuration requirements.
 * 
 * eg.
 */

 'Strategy' => array(
   'Facebook' => array(
     'app_id' => '662335227160663',
     'app_secret' => '90c4a9bbe377e85806043b95f58f6edc',
     'scope' => 'user_groups'
   )
  
  )
/*
 'Strategy' => array(
   'Facebook' => array(
     'app_id' => '719076531447978',
     'app_secret' => '8450821546f0d1cc4965c32f0132b133'
   )
  
  )
*/
 
/*
	'Strategy' => array(
		// Define strategies and their respective configs here
		
	),
*/
);
