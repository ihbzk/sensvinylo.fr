<?php

include "company.php";

// E-mail
$email_temp=str_rot13($conf_email);
$conf_email_crypte="
	<script type=\"text/javascript\">
		document.write(\"<n uers='znvygb:$email_temp' ery='absbyybj'>$email_temp</n>\".replace(/[a-zA-Z]/g, function(c){return String.fromCharCode((c<='Z'?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));
	</script>
";

//enable/disable client database
$conf_client_database = true;

//modules
//aside est pas vraiment un module mais un 'bloc' de apache_get_modules(oid)
$modules = array(
				'aside'				=> true,
				'breadcrumbs'		=> false,
				'call-to-action'	=> false,
				'carousel'			=> true,
				'click-to-call'		=> false,
				'footer'			=> true,
				'navbar'			=> true,
				'panier'			=> false,
				'pre-devis'			=> false,
				'references'		=> false,
				'social-network'	=> false,
);

$pages = array(
				'404'				=> true,
				'company'			=> false,
				'contact-success'	=> true,
				'contact-top'		=> true,
				'contact'			=> true,
				'devis-success'		=> true,
				'devis'				=> true,
				'home'				=> true,
				'legales-mentions'	=> false,
				'project-single'	=> false,
				'studio-single'		=> false,
);