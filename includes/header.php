<?php
// this function can be used in other PHP files before including header.php
// to enqueue additional CSS files
if (!function_exists('enqueue_css')) {
    function enqueue_css($files)
    {
        global $extra_css;
        if (empty($files)) {
            return;
        }
        if (is_string($files)) {
            $files = [$files];
        }
        if (!isset($extra_css) || !is_array($extra_css)) {
            $extra_css = [];
        }
        foreach ($files as $f) {
            if (!in_array($f, $extra_css, true)) {
                $extra_css[] = $f;
            }
        }
    }
}

if (!isset($extra_css) || !is_array($extra_css)) {
    $extra_css = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title, ENT_QUOTES) : 'BrewHavenPH'; ?></title>
    <?php
    foreach ($extra_css as $css_file) {
        echo '<link rel="stylesheet" href="' . htmlspecialchars($css_file, ENT_QUOTES) . '">' . PHP_EOL;
    }
    ?>
</head>
<body>