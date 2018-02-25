<?php

if (isset($_POST['On']))  {

    setcookie("Test", "On", time()+3600, "/","", 0);
    // refresh current page
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;

} else if (isset($_POST['Off'])) {

    setcookie("Test", "Off", time()+3600, "/","", 0);
    // refresh current page
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

// always try and fetch cookie value
$Result = isset($_COOKIE['Test']) ? $_COOKIE['Test'] : 'no cookies here...';

?>

<form id="Test" action='' method='post'>
    <button type='submit' name='On'>ON</button>
    <button type='submit' name='Off'>OFF</button>
</form>
<p>Cookie value: <?= $Result;?></p>