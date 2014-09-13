<?PHP
//------------------------------------------------ ajout tracking par olivier du visiteur ---->
	function identifiant_unique()
	{
		//initialisation du générateur de nombre
		srand((float) (microtime()*1000000));
		//génération de l'identifiant
		return md5(uniqid(rand()));
	}
	//recuperation du referer	
	/*
		if ((isset($HTTP_COOKIE_VARS["referent"]))) 
		{	
			if (isset($_GET["src"])) { $src=$_GET["src"]; } else { if (isset($_POST["src"])) { $src=$_POST["src"]; } else { $src="inconnu"; } }
			$referent="".$_SERVER["HTTP_REFERER"]."-".$src;
			setcookie("referent",$referent,time()+(30*24*3600)); }
		else
		{ setcookie("referent",$referent,time()+(30*24*3600)); }
	
		if (isset($_GET["src"])) { $src=$_GET["src"]; } else { if (isset($_POST["src"])) { $src=$_POST["src"]; } else { $src="inconnu"; } }
		$referent="".$HTTP_REFERER."-".$src;
		if (! $_COOKIE["referent"])
		{	setcookie("referent",$referent,time()+(30*24*3600),"/","sesamecover.com"); }
		
		
		
		// autres codes possible
		if ((isset($HTTP_COOKIE_VARS["historique"]))) 
		{	$histo=$HTTP_COOKIE_VARS["historique"];
			setcookie("historique",$histo.">".get_permalink().":".time(),time()+(30*24*3600)); }
		else
		{ setcookie("historique","entree>".get_permalink().":".time(),time()+(30*24*3600)); }	
	
		if ((isset($_COOKIE["historique"]))) 
		{	$histo=$_COOKIE["historique"];
			setcookie("historique",$histo.">".get_permalink().":".time(),time()+(30*24*3600)); }
		else
		{ setcookie("historique","entree>".get_permalink().":".time(),time()+(30*24*3600)); }
	*/

	// -------------------------------------------------   gestion par session PHP
	
	session_start();

	$url=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$long=strlen($url);
	$url=substr($url,16,$long);

	//mise à jour du referer
		if (empty($_SESSION["referent"])) 
		{
			if (isset($_GET["src"])) { $src=$_GET["src"]; } else { if (isset($_POST["src"])) { $src=$_POST["src"]; } else { $src=""; } }
			$_SESSION["referent"] = "".$_SERVER["HTTP_REFERER"]."-".$src;
		} 
	//mise à jour de l'historique de navigation
		if (empty($_SESSION["historique"])) 
		{
			$_SESSION["historique"] = "entree--".$url."_".time();
		} 
		else
		{
			$_SESSION["historique"] .= "--".$url."_".time();
		}


	// -------------------------------------------------   gestion par cookie

	//mise à jour du referer
		if (! $_COOKIE["referent"])
		{	
			if (isset($_GET["src"])) { $src=$_GET["src"]; } else { if (isset($_POST["src"])) { $src=$_POST["src"]; } else { $src=""; } }
			setcookie("referent","".$_SERVER["HTTP_REFERER"]."-".$src,time()+(30*24*3600),"/","abrisdepiscines.com"); 
		}
	
	//mise à jour de l'historique de navigation
		if (! $_COOKIE["historique"])
		{	setcookie("historique","entree--".$url."_".time(),time()+(30*24*3600),"/","abrisdepiscines.com"); }
		else
		{	setcookie("historique","".$_COOKIE["historique"]."--".$url."_".time(),time()+(30*24*3600),"/","abrisdepiscines.com"); }
			
//--------------------------------------------------------------------------------------------------
?>