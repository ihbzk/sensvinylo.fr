<?php

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
