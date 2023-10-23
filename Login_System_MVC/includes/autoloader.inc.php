

<?php
spl_autoload_register('autoLoad');
function autoLoad($className)
{
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $path =  '';
    if (strpos($url, 'includes') !== false)
        $path = '../';


    // path is case insensitive
    // this function is only executed one per class (very good)
    $path .= "Classes/$className.class.php";
    if (!file_exists($path))
        return false;
    require_once $path;
}
