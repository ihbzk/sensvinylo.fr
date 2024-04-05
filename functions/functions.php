<?php

if ($_SERVER['SERVER_NAME'] == "localhost") {
    include("scss.php");
}

define('_2_CHARS_REGEX_', '/^.{2,}$/');
define('_EMAIL_REGEX_', '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$/');
define('_PHONE_REGEX_', '/^(0|33)[1-9]([-. ]?[0-9]{2}){4}$/');
define('_ZIPCODE_REGEX_', '/^[0-9]{4,7}$/');
define('_AMOUNT_REGEX_', '/^[0-9]+[.,]?[0-9]{0,2}$/');
define('_DATE_REGEX_', '/^([0-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/');
define('_MESSAGE_REGEX_', '/^[a-zA-Z0-9?$@#()\'!,+\-=_:.&€£*%\s]+$/');
define('_MAX_FILE_SIZE_', '2000000');

function validate($regex, $field)
{
    if (is_null($regex)) {
        return true;
    } else {
        return (preg_match($regex, $field)) ? true : false;
    }
}

/**
 * Form Helpers
 * ============
 * form_open()
 * form_close()
 *
 */

function attributes($options = array()){

	$html='';
	foreach($options as $attribute => $value)
	{
		$html .= $attribute . '="'.$value.'" ';	
	}
	return $html;
}

function form_open($route,$options = array()){

	
	return '<form role="form" method="post" action="'. $route.'" '.attributes($options).'>';
}

function form_close(){
	return '</form>';

}

function form_label($field,$for = NULL){
	
	return (!$for==NULL)?'<label for="form_'. $for.'">'.$field.'</label>':'<label>'.$field.'</label>';
}

//for after
function autofocus($form_is_submitted)
{
	return (!$form_is_submitted)?'autofocus':'';
}

function form_text($name,$value,$options = array()){

	return '<input type="text" name="'.$name.'" id="form_'.$name.'" value="'.$value.'" '. attributes($options) .'>';
}

function form_number($name,$value,$options = array()){

	return '<input type="number" name="'.$name.'" id="form_'.$name.'" value="'.$value.'" '. attributes($options) .'>';
}



function form_feedback($form_is_submitted,$field_status)
{
	return ($form_is_submitted)?'<span class="fa '.(($field_status == 'has-success')?'fa-check':'fa-times' ).' form-control-feedback"></span>':'';
}


function form_textarea($name,$value,$options = array()){

	return '<textarea name="'.$name.'"  id="form_'.$name.'" '.attributes($options).'>'.$value.'</textarea>';
}

function form_select($name,$value,$list,$options = array()){

	$select_options = '';
	foreach((array) $list as $option)
	{
		$select_options .= '<option '. (($value==$option)?'selected="selected"':'') .'>'.$option.'</option>';
	}

	return '<select name="'.$name.'" id="form_'.$name.'" '.attributes($options).'>'.$select_options.'</select>';
}

function form_checkbox($name,$value,$label,$options = array()){

	return '<label><input type="checkbox" name="'.$name.'" '. attributes($options).' '.(($value)?'checked':'').'>'.$label. '</label>';
}

function form_radio($name,$radio,$value,$label,$form_is_submitted = TRUE,$options = array()){
	/*if(!$form_is_submitted){
		//return '<label><input type="radio" name="'.$name.'" value="'.$value.'" '.attributes($options).' checked'.'>'.$label.'</label>';		
	}else{
		//return '<label><input type="radio" name="'.$name.'" value="'.$value.'" '.attributes($options).' '.($radio == $value)?'checked':''.'>'.$label.'</label>';
	}*/

	return '<label><input type="radio" name="'.$name.'" value="'.$value.'" '.attributes($options).' '.((!$form_is_submitted OR $radio == $value)?'checked':'').'>'.$label.'</label>';

}

function form_file($name){
	return '<input type="file" name="'.$name.'" id="form_'.$name. '">';
}

/*
	fixing $title issue with news(actualites)
*/
function start_block($page_title,$page_keywords,$page_description){
	global $conf_title;
	global $conf_keywords;
	global $conf_description;
	if(!empty($page_title))
	{
		$conf_title = $page_title;
	}
	if(!empty($page_keywords))
	{
		$conf_keywords = $page_keywords;
	}
	if(!empty($page_description))
	{
		$conf_description = $page_description;
	}

	ob_start();
}

function end_block(){
	global $content;
	$content = ob_get_contents();
	ob_end_clean();
}

function redirectNotification($message, $redirect = null, $class = "success")
{
    global $routes;
    global $base;
    if (!$redirect) $redirect = $base . $routes['home'];
    $message = base64_encode($message);
    header("Location: $redirect?message=$message&class=$class");
    echo "<script>location.href='$redirect?message=$message&class=$class'</script>";
}

function printNotification()
{
    if (isset($_GET['message'])) {
        $message = base64_decode($_GET['message']);
        if (isset($_GET['class'])) $class = $_GET['class'];
?>
        <div class="notification <?= $class ?>">
            <p><?= $message ?></p>
            <div class="notification_toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                </svg>
            </div>
        </div>

        <script>
            history.replaceState(null, "", location.href.split("?")[0]);
            setTimeout(() => {
                let notifications = document.getElementsByClassName("notification");

                notifications[0].classList.add("hide");
                setTimeout(() => {
                    notifications[0].remove();
                }, 1000)
            }, 14000);
        </script>
<?php }
}

/**
 * Allows for multiple "/" in url 
 * 
 * @param String $asset The asset to load
 * @return String the relative path of the asset
 */

function asset($asset)
{
    global $base;

    return $base . "assets/" . $asset;
}

/**
 * Give absolute route
 * 
 * @param String $route The route to find
 * @return String the absolute route of the page
 */

function getRoute($route)
{
    global $base;
    global $routes;
    return $base . $routes[$route];
}

function dd($data)
{
    var_dump($data);
    echo "<style>#navbar{display: none !important}</style>";
    die;
}

function form_error($field, $message = false)
{
    if (!empty($_POST)) {
        if ((isset($field["status"]) && $field["status"] == "has-error")) {
            if (!$message) $message = "Veuillez remplir ce champs";
            return <<<EOF
            <div class="text-danger">$message
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                    <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
            </div>
            <script>
                document.getElementById("contact-module").scrollIntoView() 
            </script>
EOF;
        }
    }
}

function remove_accents($str)
{
    $str = mb_strtolower($str, 'UTF-8');
    $str = str_replace(
        array('à', 'â', 'ä', 'á', 'ã', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ'),
        array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'th', 'y'),
        $str
    );
    return $str;
}
