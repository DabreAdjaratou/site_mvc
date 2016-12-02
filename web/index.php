<pre>
<?php 
define('web', dirname(__FILE__)); //Recuperer le chemin du dossier parent web et le stocker dans la variable root ici C:\Apache24\htdocs\web\site\web  
define('root', dirname(web));//Recuperer le chemin  de la racine ici C:\Apache24\htdocs\web\site
define ('core', root.DIRECTORY_SEPARATOR.'core'); //Recuperer le chemin du dossier core ici C:\Apache24\htdocs\web\site\core
define ('base_url', dirname(dirname($_SERVER['SCRIPT_NAME']))); //Recuperer le chemin de la base de toute nos url ici /web/site 

require core.DIRECTORY_SEPARATOR.'Include.php'; //inclure le fichier Include.php
new Dispatcher();// charger le dispatcher

//print_r($_SERVER);

 ?>
</pre>