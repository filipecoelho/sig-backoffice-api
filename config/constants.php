<?php
define('URL_BASE', baseUrl().'/sig-backoffice-web');
define('CHARSET', 'utf8');

// Constantes de configuração do banco de dados
if(serverName() == 'localhost') {
	// DESENVOLVIMENTO - LOCALHOST
	define('HOST', 		'srvwldb1.cjnvfjneksls.sa-east-1.rds.amazonaws.com');
	define('DBNAME', 	'bd_sig_backoffice');
	define('USER', 		'root');
	define('PASSWORD', 	'root1234567');
}
else
{
	// PRODUÇÃO - AMAZON
	define('HOST', 		'srvwldb1.cjnvfjneksls.sa-east-1.rds.amazonaws.com');
	define('DBNAME', 	'bd_sig_backoffice');
	define('USER', 		'root');
	define('PASSWORD', 	'root1234567');
}
?>