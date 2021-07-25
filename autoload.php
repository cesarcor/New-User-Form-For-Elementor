<?php
spl_autoload_register(function ($class) {
    $prefix = 'New_User_Form_Elementor\\';

    $base_dir = NUF_PATH  . '/includes/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0):
        return;
    endif;

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)):
        require $file;
    endif;
});