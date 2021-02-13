<?php
/**
 * QRcdr - php QR Code generator
 * index.php
 *
 * PHP version 5.4+
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2021 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @version   5.1.7
 * @link      http://veno.es/qrcdr/
 */
$version = '5.1.7';

if (version_compare(phpversion(), '5.4', '<')) {
    exit("QRcdr requires at least PHP version 5.4.");
}
if (!ini_get('allow_url_fopen')) {
    exit("Please enable allow_url_fopen");
}

// Update this path if you have a custom relative path inside config.php
require dirname(__FILE__)."/lib/functions.php";

if (qrcdr()->getConfig('debug_mode')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL ^ E_NOTICE);
}
$relative = qrcdr()->relativePath();
require dirname(__FILE__).'/'.$relative.'include/head.php';
?>
<!doctype html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $rtl['dir']; ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?php echo qrcdr()->getString('title'); ?></title>
        <meta name="description" content="<?php echo qrcdr()->getString('description'); ?>">
        <meta name="keywords" content="<?php echo qrcdr()->getString('tags'); ?>">
        <link rel="shortcut icon" href="<?php echo $relative; ?>images/favicon.ico">
        <link href="<?php echo $relative; ?>bootstrap/<?php echo $rtl['css']; ?>/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $relative; ?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $relative; ?>css/header.css" rel="stylesheet">
        <link href="<?php echo $relative; ?>css/style.css" rel="stylesheet">
        <link href="<?php echo $relative; ?>css/footer.css" rel="stylesheet">
        <script src="<?php echo $relative; ?>js/jquery-3.5.1.min.js"></script>
        <?php
        qrcdr()->loadQRcdrCSS($version);
        qrcdr()->loadPluginsCss();
        qrcdr()->setMainColor(qrcdr()->getConfig('color_primary'));
        ?>
    </head>
    <body class="qrcdr">
        <?php
        // if (file_exists(dirname(__FILE__).'/'.$relative.'template/navbar.php')) {
        //     include dirname(__FILE__).'/'.$relative.'template/navbar.php';
        // }
        if (file_exists(dirname(__FILE__).'/'.$relative.'template/header.php')) {
            include dirname(__FILE__).'/'.$relative.'template/header.php';
        }
        // Generator required
        require dirname(__FILE__).'/'.$relative.'include/generator.php';
        require dirname(__FILE__).'/'.$relative.'include/content.php';

        if (file_exists(dirname(__FILE__).'/'.$relative.'template/footer.php')) {
            include dirname(__FILE__).'/'.$relative.'template/footer.php';
        }
        qrcdr()->loadQRcdrJS($version);
        qrcdr()->loadPlugins(); ?>
    </body>
</html>
