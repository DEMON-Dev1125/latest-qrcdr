<?php
/**
 * QRcdr - php QR Code generator
 * ajax/process.php
 *
 * PHP version 5.4+
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2020 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
    || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')
) {
    exit;
}
date_default_timezone_set('UTC');

require dirname(dirname(__FILE__))."/lib/functions.php";

$output_data = false;

$outdir = qrcdr()->getConfig('qrcodes_dir');
$PNG_TEMP_DIR = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$outdir.DIRECTORY_SEPARATOR;
$PNG_WEB_DIR = $outdir.'/';

require dirname(dirname(__FILE__))."/lib/phpqrcode.php";
require dirname(dirname(__FILE__))."/lib/class-qrcdr.php";
require dirname(dirname(__FILE__))."/lib/frames.php";

qrcdr()->init();
$lang = qrcdr()->getLang();
if (file_exists(dirname(dirname(__FILE__))."/translations/".$lang.".php")) {
    include dirname(dirname(__FILE__))."/translations/".$lang.".php";
} else {
    include dirname(dirname(__FILE__))."/translations/en.php";
}

$output_data = false;
$getsection = filter_input(INPUT_POST, "section", FILTER_SANITIZE_STRING);
$setbackcolor = filter_input(INPUT_POST, "backcolor", FILTER_SANITIZE_STRING);
$setbackcolor = $setbackcolor ? $setbackcolor : qrcdr()->getConfig('qr_bgcolor');

$setfrontcolor = filter_input(INPUT_POST, "frontcolor", FILTER_SANITIZE_STRING);
$setfrontcolor = $setfrontcolor ? $setfrontcolor : qrcdr()->getConfig('qr_color');

$optionlogo = filter_input(INPUT_POST, "optionlogo", FILTER_SANITIZE_STRING);
$no_logo_bg = isset($_POST['no_logo_bg']);
$pattern = filter_input(INPUT_POST, "pattern", FILTER_SANITIZE_STRING);
$radial = isset($_POST['radial']);

$markerOut = filter_input(INPUT_POST, "marker", FILTER_SANITIZE_STRING);
$markerIn = filter_input(INPUT_POST, "marker_in", FILTER_SANITIZE_STRING);
$markerOutColor = filter_input(INPUT_POST, "marker_out_color", FILTER_SANITIZE_STRING);
$markerInColor = filter_input(INPUT_POST, "marker_in_color", FILTER_SANITIZE_STRING);
$gradient = isset($_POST['gradient']);
$gradient_color = filter_input(INPUT_POST, "gradient_color", FILTER_SANITIZE_STRING);
$markers_color = isset($_POST['markers_color']);

$different_markers_color = isset($_POST['different_markers_color']);

if ($different_markers_color) {
    $marker_top_right_outline = filter_input(INPUT_POST, "marker_top_right_outline", FILTER_SANITIZE_STRING);
    $marker_top_right_center = filter_input(INPUT_POST, "marker_top_right_center", FILTER_SANITIZE_STRING);
    $marker_bottom_left_outline = filter_input(INPUT_POST, "marker_bottom_left_outline", FILTER_SANITIZE_STRING);
    $marker_bottom_left_center = filter_input(INPUT_POST, "marker_bottom_left_center", FILTER_SANITIZE_STRING);
} else {
    $marker_top_right_outline = $marker_bottom_left_outline = $markerOutColor;
    $marker_top_right_center = $marker_bottom_left_center = $markerInColor;
}

$outerframe = filter_input(INPUT_POST, "outer_frame", FILTER_SANITIZE_STRING);

$custom_frame_color = isset($_POST['custom_frame_color']);
$framecolor = filter_input(INPUT_POST, "framecolor", FILTER_SANITIZE_STRING);
$framelabel = filter_input(INPUT_POST, "framelabel", FILTER_SANITIZE_STRING);
$label_font = filter_input(INPUT_POST, "label_font", FILTER_SANITIZE_STRING);
$logo_size = filter_input(INPUT_POST, "logo-size", FILTER_SANITIZE_STRING);
$label_text_size = filter_input(INPUT_POST, "label-text-size", FILTER_SANITIZE_STRING);

$optionlogo = $optionlogo ? $optionlogo : 'none';
$outerframe = $outerframe ? $outerframe : 'none';

$labeltext_color = '#FFFFFF';
$basecolor = $custom_frame_color ? $framecolor : $setfrontcolor;
$rgb = qrcdr()->HTMLToRGB($basecolor);
$hsl = qrcdr()->RGBToHSL($rgb);
if ($hsl->lightness > 185) {
    $labeltext_color = '#000000';
}

$optionstyle = array(
    'optionlogo' => $optionlogo,
    'pattern' => $pattern,
    'marker_out' => $markerOut,
    'marker_in' => $markerIn,
    'marker_out_color' => $markerOutColor,
    'marker_in_color' => $markerInColor,
    'marker_top_right_outline' => $marker_top_right_outline,
    'marker_top_right_center' => $marker_top_right_center,
    'marker_bottom_left_outline' => $marker_bottom_left_outline,
    'marker_bottom_left_center' => $marker_bottom_left_center,
    'gradient' => $gradient,
    'gradient_color' => $gradient_color,
    'markers_color' => $markers_color,
    'radial' => $radial,
    'no_logo_bg' => $no_logo_bg,
    'frame' => $outerframe,
    'custom_frame_color' => $custom_frame_color,
    'framecolor' => $framecolor,
    'framelabel' => $framelabel,
    'label_font' => $label_font,
    'labeltext_color' => $labeltext_color,
    'logo_size' => $logo_size,
    'label_text_size' => $label_text_size,
);

$stringbackcolor = $setbackcolor ? $setbackcolor : '#FFFFFF';
$stringfrontcolor = $setfrontcolor ? $setfrontcolor : '#000000';
$backcolor = qrcdr()->hexdecColor($stringbackcolor, '#FFFFFF');
$frontcolor = qrcdr()->hexdecColor($stringfrontcolor, '#000000');

$level = filter_input(INPUT_POST, "level", FILTER_SANITIZE_STRING);
$level = $level ? $level : qrcdr()->getConfig('precision');

if (in_array($level, array('L','M','Q','H'))) {
    $errorCorrectionLevel = $level;
    if ($optionlogo !== 'none' && $errorCorrectionLevel == 'L') {
        $errorCorrectionLevel = 'M';
    }
}
$size = filter_input(INPUT_POST, "size", FILTER_SANITIZE_STRING);
$size = $size ? $size : 16;
$matrixPointSize = min(max((int)$size, 4), 32);

switch ($getsection) {

case '#text':
    $output_data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    break;
case '#email':
    $datamailto = filter_input(INPUT_POST, "mailto", FILTER_VALIDATE_EMAIL);
    $datamailsubj = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);
    $datamailbody = filter_input(INPUT_POST, "body", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    if ($datamailto) {
        $output_data = 'MATMSG:TO:'.$datamailto.';SUB:'.$datamailsubj.';BODY:'.$datamailbody.';;';
    }
    break;
case '#link':
    $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
    $output_data = qrcdr()->validateUrl($link);
    break;

case '#tel':
    $countrycode = filter_input(INPUT_POST, "countrycodetel", FILTER_SANITIZE_STRING);
    $number = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_STRING);
    if ($number) {
        $countrycode = ($countrycode ? '+'.$countrycode : '');
        $output_data = 'tel:'.$countrycode.$number;
    }
    break;

case '#sms':
    $countrycode = filter_input(INPUT_POST, "countrycodesms", FILTER_SANITIZE_STRING);

    $number = filter_input(INPUT_POST, "sms", FILTER_SANITIZE_STRING);
    $bodysms = filter_input(INPUT_POST, "bodysms", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    if ($number) {
        $countrycode = ($countrycode ? '+'.$countrycode : '');
        $output_data = 'SMSTO:'.$countrycode.$number.':';
        if ($bodysms) {
            $output_data .= $bodysms;
        }
    }
    break;
case '#whatsapp':
    $countrycode = filter_input(INPUT_POST, "wapp_countrycode", FILTER_SANITIZE_STRING);

    $number = filter_input(INPUT_POST, "wapp_number", FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, "wapp_message", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    if ($number) {
        $output_data = 'https://wa.me/'.$countrycode.$number;
    }

    if ($message) {
        $output_data .= '/?text='.urlencode($message);
    }
    break;

case '#skype':
    $skype = filter_input(INPUT_POST, "skype", FILTER_SANITIZE_STRING);
    $skypetype = filter_input(INPUT_POST, "skypeType", FILTER_SANITIZE_STRING);
    $skypetype = $skypetype ? $skypetype : 'chat';
    
    if ($skype) {
        $output_data = 'skype:'.urlencode($skype).'?'.$skypetype;
    }
    break;

case '#zoom':
    $zoom_id = filter_input(INPUT_POST, "zoom_id", FILTER_SANITIZE_STRING);
    $zoom_pwd = filter_input(INPUT_POST, "zoom_pwd", FILTER_SANITIZE_STRING);
    
    if ($zoom_id && $zoom_pwd) {
        $zoom_id = str_replace(' ', '', $zoom_id);
        $output_data = 'https://zoom.us/j/'.$zoom_id.'?pwd='.$zoom_pwd;
    }
    break;

case '#wifi':
    $ssid = filter_input(INPUT_POST, "ssid", FILTER_SANITIZE_STRING);
    $wifipass = filter_input(INPUT_POST, "wifipass", FILTER_SANITIZE_STRING);
    $networktype = filter_input(INPUT_POST, "networktype", FILTER_SANITIZE_STRING);
    $wifihidden = filter_input(INPUT_POST, "wifihidden", FILTER_SANITIZE_STRING);

    if ($ssid) {
        $output_data = 'WIFI:S:'.$ssid.';';

        if ($networktype) {
            $output_data .= 'T:'.$networktype.';';
        }
        if ($wifipass) {
            $output_data .= 'P:'.$wifipass.';';
        }
        if ($wifihidden) {
            $output_data .= 'H:true;';
        }
        $output_data .= ';';
    }
    break;
case '#location':
    $lat = filter_input(INPUT_POST, "lat", FILTER_SANITIZE_STRING);
    $lng = filter_input(INPUT_POST, "lng", FILTER_SANITIZE_STRING);
    if ($lat && $lng) {
        $output_data = 'geo:'.$lat.','.$lng.'?q='.$lat.','.$lng;
    }
    break;
case '#vcard':
    $vversion     = filter_input(INPUT_POST, "vversion", FILTER_SANITIZE_STRING);
    $vnametitle = filter_input(INPUT_POST, "vnametitle", FILTER_SANITIZE_STRING);
    $vname = filter_input(INPUT_POST, "vname", FILTER_SANITIZE_STRING);
    $vlast = filter_input(INPUT_POST, "vlast", FILTER_SANITIZE_STRING);
    $sortName     = $vlast.';'.$vname;
    $sortName     = $vnametitle ? $sortName.';;'.$vnametitle : $sortName;
    if ($vversion !== '2.1') {
        $sortName .= ';';
    }
    $fn           = $vname.' '.$vlast;
    $fn           = $vnametitle ? $sortName.' '.$fn : $fn;
    $countryphone = filter_input(INPUT_POST, "countrycodevphone", FILTER_SANITIZE_STRING);
    $countryphone = ($countryphone ? '+'.$countryphone : '');
    $phone        = filter_input(INPUT_POST, "vphone", FILTER_SANITIZE_STRING);

    $countrymobile = filter_input(INPUT_POST, "countrycodevmobile", FILTER_SANITIZE_STRING);
    $countrymobile = ($countrymobile ? '+'.$countrymobile : '');
    $phoneCell    = filter_input(INPUT_POST, "vmobile", FILTER_SANITIZE_STRING);

    $email        = filter_input(INPUT_POST, "vemail", FILTER_VALIDATE_EMAIL);
    $orgName      = filter_input(INPUT_POST, "vcompany", FILTER_SANITIZE_STRING);
    $orgTitle     = filter_input(INPUT_POST, "vtitle", FILTER_SANITIZE_STRING);
    $vurl         = qrcdr()->validateUrl(filter_input(INPUT_POST, "vurl", FILTER_SANITIZE_STRING));

    $countryoffice = filter_input(INPUT_POST, "countrycodevoffice", FILTER_SANITIZE_STRING);
    $countryoffice = ($countryoffice ? '+'.$countryoffice : '');
    $officephone   = filter_input(INPUT_POST, "vofficephone", FILTER_SANITIZE_STRING);

    $countryfax = filter_input(INPUT_POST, "countrycodevfax", FILTER_SANITIZE_STRING);
    $countryfax = ($countryfax ? '+'.$countryfax : '');
    $fax        = filter_input(INPUT_POST, "vfax", FILTER_SANITIZE_STRING);

    $address          = filter_input(INPUT_POST, "vaddress", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $addressTown      = filter_input(INPUT_POST, "vcity", FILTER_SANITIZE_STRING);
    $addressPostCode  = filter_input(INPUT_POST, "vcap", FILTER_SANITIZE_STRING);
    $addressCountry   = filter_input(INPUT_POST, "vcountry", FILTER_SANITIZE_STRING);
    $addressState     = filter_input(INPUT_POST, "vstate", FILTER_SANITIZE_STRING);

    // $vnote = filter_input(INPUT_POST, "vnote", FILTER_SANITIZE_STRING);

    if ($vname) {
        $output_data  = 'BEGIN:VCARD'."\n";
        $output_data .= 'VERSION:'.$vversion."\n";
        $output_data .= 'N;CHARSET=UTF-8:'.$sortName."\n";
        $output_data .= 'FN;CHARSET=UTF-8:'.$fn."\n";
        if ($phoneCell) {        
            if ($vversion == '2.1') {
                $output_data .= 'TEL;CELL:'.$countrymobile.$phoneCell."\n";
            } else {
                $output_data .= 'TEL;TYPE=CELL:'.$countrymobile.$phoneCell."\n";
            }
        }
        if ($phone) {
            if ($vversion == '2.1') {
                $output_data .= 'TEL;HOME;VOICE:'.$countryphone.$phone."\n";
            } else {
                $output_data .= 'TEL;TYPE=HOME,VOICE:'.$countryphone.$phone."\n";
            }
        }
        if ($orgName) {
            $output_data .= 'ORG;CHARSET=UTF-8:'.$orgName."\n";
        }
        if ($orgTitle) {
            $output_data .= 'TITLE;CHARSET=UTF-8:'.$orgTitle."\n";
        }
        if ($officephone) {
            if ($vversion == '2.1') {
                $output_data .= 'TEL;WORK;VOICE:'.$countryoffice.$officephone."\n";
            } else {
                $output_data .= 'TEL;TYPE=WORK,VOICE:'.$countryoffice.$officephone."\n";
            }
        }
        if ($fax) {
            if ($vversion == '2.1') {
                $output_data .= 'TEL;WORK;FAX:'.$countryfax.$fax."\n";
            } else {
                $output_data .= 'TEL;TYPE=FAX,WORK:'.$countryfax.$fax."\n";
            }
        }

        if ($address || $addressTown || $addressState || $addressCountry) {

            if ($vversion == '2.1') {
                $output_data .= 'ADR;CHARSET=UTF-8;WORK;PREF:;';
            } else {
                $output_data .= 'ADR;CHARSET=UTF-8;TYPE=WORK,PREF:;';
            }
            if ($address) {
                $address = str_replace(';', '\;', str_replace(',', '\,', $address));
                $output_data .= ';'.$address;
            }
            if ($addressTown) {
                $output_data .= ';'.$addressTown;
            }
            if ($addressState) {
                $output_data .= ';'.$addressState;
            }
            if ($addressPostCode) {
                $output_data .= ';'.$addressPostCode;
            }
            if ($addressCountry) {
                $output_data .= ';'.$addressCountry;
            }
            $output_data .= "\n";
        }
        if ($email) {
            $output_data .= 'EMAIL:'.$email."\n";
        }
        if ($vurl) {
            $output_data .= 'URL:'.$vurl."\n";
        }
        // if ($vnote) {
        //     $output_data .= 'NOTE:'.$vnote."\n";
        // }
        $output_data .= 'END:VCARD'; 
    }
    break;
case '#paypal':
    $type = filter_input(INPUT_POST, "pp_type", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "pp_email", FILTER_VALIDATE_EMAIL);
    $name = filter_input(INPUT_POST, "pp_name", FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_POST, "pp_id", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, "pp_price", FILTER_SANITIZE_STRING);
    $currency = filter_input(INPUT_POST, "pp_currency", FILTER_SANITIZE_STRING);
    $shipping = filter_input(INPUT_POST, "pp_shipping", FILTER_SANITIZE_STRING);
    $tax = filter_input(INPUT_POST, "pp_tax", FILTER_SANITIZE_STRING);

    if ($email && $name) {
        $output_data  = 'https://www.paypal.com/cgi-bin/webscr';
        $output_data  .= '?cmd='.$type;
        $output_data  .= '&business='.urlencode($email);
        $output_data  .= '&item_name='.urlencode($name);
        $output_data  .= '&amount='.urlencode($price);
        $output_data  .= '&currency_code='.$currency;

        if ($shipping) {
            $output_data  .= '&shipping='.urlencode($shipping);
        }
        if ($tax) {
            $output_data  .= '&tax_rate='.urlencode($tax);
        }

        if ($type === '_xclick') {
            $output_data  .= '&button_subtype=services';
            $output_data  .= '&bn='.urlencode('PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest');
        } elseif ($type === '_cart') {
            $output_data  .= '&button_subtype=products&add=1';
            $output_data  .= '&bn='.urlencode('PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest');
        } else {
            $output_data  .= '&bn='.urlencode('PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest');
        }
        $output_data  .= '&lc=US&no_note=0';
    }
    break;
case '#bitcoin':
    $btc_account = filter_input(INPUT_POST, "btc_account", FILTER_SANITIZE_STRING);
    $btc_amount = filter_input(INPUT_POST, "btc_amount", FILTER_SANITIZE_STRING);
    $btc_label = filter_input(INPUT_POST, "btc_label", FILTER_SANITIZE_STRING);
    $btc_message = filter_input(INPUT_POST, "btc_message", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    if ($btc_account) {
        $output_data = 'bitcoin:'.$btc_account;
        if ($btc_amount) {
            $output_data .= '?amount='.$btc_amount;
        }
        if ($btc_label) {
            $output_data .= '&label='.urlencode($btc_label);
        }
        if ($btc_message) {
            $output_data .= '&message='.urlencode($btc_message);
        }
    }
    break;

case '#event':
    $title = filter_input(INPUT_POST, "eventtitle", FILTER_SANITIZE_STRING);
    $location = filter_input(INPUT_POST, "eventlocation", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $starttime = filter_input(INPUT_POST, "eventstarttime", FILTER_SANITIZE_STRING);
    $endtime = filter_input(INPUT_POST, "eventendtime", FILTER_SANITIZE_STRING);

    $reminder = filter_input(INPUT_POST, "eventreminder", FILTER_SANITIZE_STRING);
    $eventurl = qrcdr()->validateUrl(filter_input(INPUT_POST, "eventlink", FILTER_SANITIZE_STRING));
   
    $eventnote = filter_input(INPUT_POST, "eventnote", FILTER_SANITIZE_STRING);

    if ($title && $starttime) {
        $output_data = 'BEGIN:VCALENDAR'."\n";
        $output_data .= 'VERSION:2.0'."\n";
        $output_data .= 'PRODID:-//QRcdr//QRcdr 4.0//EN'."\n";
        $output_data .= 'BEGIN:VEVENT'."\n";
        if ($location) {
            $location = str_replace(';', '\;', str_replace(',', '\,', $location));
            $output_data .= 'LOCATION:'.$location."\n";
        }
        $formatstart = date('Ymd\THis\Z', $starttime);
        $output_data .= 'DTSTART:'.$formatstart."\n";

        if ($endtime) {
            $formatend = date('Ymd\THis\Z', $endtime);
            $output_data .= 'DTEND:'.$formatend."\n";
        }
        $output_data .= 'SUMMARY:'.$title."\n";

        if ($eventnote) {
            $eventnote = str_replace("\r\n", "\\n", $eventnote);
            $output_data .= 'DESCRIPTION:'.$eventnote."\n";
        }
        if ($eventurl) {
            $output_data .= 'URL:'.$eventurl."\n";
            $output_data .= 'CLASS:PUBLIC'."\n"; // PUBLIC or PRIVATE
        }
        if ($reminder) {
            $output_data .= 'BEGIN:VALARM'."\n";
            $output_data .= 'TRIGGER:'.$reminder."\n";
            // $output_data .= 'REPEAT:3'."\n";
            // $output_data .= 'DURATION:PT5M'."\n";
            $output_data .= 'ACTION:DISPLAY'."\n";
            $output_data .= 'DESCRIPTION:Reminder'."\n";
            $output_data .= 'END:VALARM'."\n";
        }
        $output_data .= 'END:VEVENT'."\n";
        $output_data .= 'END:VCALENDAR';
    }
    break;
}

if ($output_data) {

    $backcolor = isset($_POST['transparent']) ? 'transparent' : $backcolor;

    $optionlogo = $optionlogo && $optionlogo !== 'none' ? $optionlogo : false;
    $filename = $PNG_TEMP_DIR.md5($output_data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize.time());
    $filenamesvg = $filename.'.svg';
    $basename = basename($filenamesvg, '.svg');

    $codemargin = $outerframe !== 'none' ? $frames[$outerframe]['frame_border'] * 2 + 1 : 2;
    $content = QRcdr::svg($output_data, $filenamesvg, $errorCorrectionLevel, $matrixPointSize, $codemargin, false, $backcolor, $frontcolor, $optionstyle);

    $result = array(
        'basename' => $basename,
        'content' => $content,
        'gradient' => $gradient
    );
    $result = json_encode($result);
} else {
    $result = json_encode(
        array(
            'errore'=> qrcdr()->getString('provide_more_data'), 
            'placeholder' => qrcdr()->relativePath().qrcdr()->getConfig('placeholder'),
        )
    );
}
echo $result;
