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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo $relative; ?>images/favicon.ico">
        <link href="<?php echo $relative; ?>bootstrap/<?php echo $rtl['css']; ?>/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $relative; ?>css/font-awesome.min.css" rel="stylesheet">
        <script src="<?php echo $relative; ?>js/jquery-3.5.1.min.js"></script>
        <script src="<?php echo $relative; ?>bootstrap/js/bootstrap.min.js"></script>
        <link href="<?php echo $relative; ?>css/header.css" rel="stylesheet">
        <link href="<?php echo $relative; ?>css/style.css" rel="stylesheet">
        <link href="<?php echo $relative; ?>css/footer.css" rel="stylesheet">
</head>

<style>
    * {
        font-family: "HK Grotesk"
    }
</style>

<body>
    <?php
        if (file_exists(dirname(__FILE__).'/'.$relative.'template/navbar.php')) {
            include dirname(__FILE__).'/'.$relative.'template/navbar.php';
        }
    ?>

    <div class="container" style="margin-top: 100px;">
        <p>
            We are always happy to hear from our clients and visitors, you may contact us anytime
        </p>
        <p class="email">
            <a href=""><i class="fa fa-envelope-o"></i> : support@octopus.com</a>
        </p>
    </div>

    <div class="container mb-5 fixed-bottom">
        <div class="footer__down row">
            <div class="col-6 col-md-4 footer__link text-center">
                <a href="<?php echo $relative; ?>privacy.php">Privacy Policy</a>
            </div>
            <div class="col-6 col-md-4 footer__link text-center">
                <a href="<?php echo $relative; ?>support.php">support</a>
            </div>
            <div class="col-12 col-md-4 footer__link text-center">
                <a href="https://www.youtube.com/channel/UCnM8uaoohMR0SaTBm88jS0Q">
                    <i class="fa fa-social fa-youtube"></i>
                </a>
                <a href="https://www.facebook.com/free-qr.codes">
                    <i class="fa fa-social fa-facebook"></i>
                </a>
                <a href="https://twitter.com/freeqrcodes1">
                    <i class="fa fa-social fa-twitter"></i>
                </a>
                <a href="https://www.instagram.com/freeqrcodes22/">
                    <i class="fa fa-social fa-instagram"></i>
                </a>
            </div>
        </div>
        <div class="copyright">Copyright © 2021. <a href="Octopus22.com">Octopus22.com</a></div>
    </div>
    
</body>
</html>