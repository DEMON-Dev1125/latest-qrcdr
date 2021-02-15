<?php
/**
 * QRcdr - php QR Code generator
 * lib/class-qrcdr.php
 *
 * PHP version 5.4+
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @version   3.3
 * @link      http://veno.es/qrcdr/
 */

/**
 * Main QRcdr class
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
class QRcdr extends QRcode
{
    /**
     * Create SVG
     *
     * @param string $text         text
     * @param bool   $outfile      outfile
     * @param num    $level        level
     * @param num    $size         size
     * @param num    $margin       margin
     * @param bool   $saveandprint save and print
     * @param string $back_color   back_color
     * @param string $fore_color   fore_color
     * @param bool   $style        style
     *
     * @return SVG
     */
    public static function svg($text, $outfile = false, $level = QR_ECLEVEL_Q, $size = 3, $margin = 4, $saveandprint = false, $back_color = 0xFFFFFF, $fore_color = 0x000000, $style = false)
    {
        $enc = QRencdr::factory($level, $size, $margin, $back_color, $fore_color);
        return $enc->encodeSVG($text, $outfile, $saveandprint, $style);
    }
}

/**
 * QRencdr class
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
class QRencdr extends QRencode
{
    /**
     * Factory
     *
     * @param num    $level      level
     * @param num    $size       size
     * @param num    $margin     margin
     * @param string $back_color back_color
     * @param string $fore_color fore_color
     * @param bool   $cmyk       style
     *
     * @return Encoded
     */
    public static function factory($level = QR_ECLEVEL_L, $size = 3, $margin = 4, $back_color = 0xFFFFFF, $fore_color = 0x000000, $cmyk = false)
    {
        $enc = new QRencdr();
        $enc->size = $size;
        $enc->margin = $margin;
        $enc->fore_color = $fore_color;
        $enc->back_color = $back_color;
        $enc->cmyk = $cmyk;

        switch ($level.'') {
        case '0':
        case '1':
        case '2':
        case '3':
                $enc->level = $level;
            break;
        case 'l':
        case 'L':
                $enc->level = QR_ECLEVEL_L;
            break;
        case 'm':
        case 'M':
                $enc->level = QR_ECLEVEL_M;
            break;
        case 'q':
        case 'Q':
                $enc->level = QR_ECLEVEL_Q;
            break;
        case 'h':
        case 'H':
                $enc->level = QR_ECLEVEL_H;
            break;
        }
        return $enc;
    }

    /**
     * Encode SVG
     *
     * @param string $intext       text
     * @param bool   $outfile      outfile
     * @param bool   $saveandprint save and print
     * @param bool   $style        style
     *
     * @return QRvtc
     */
    public function encodeSVG($intext, $outfile = false, $saveandprint = false, $style = false)
    {
        try {
            ob_start();
            $tab = $this->encode($intext);
            $err = ob_get_contents();
            ob_end_clean();
            
            if ($err != '') {
                QRtools::log($outfile, $err);
            }
            
            $maxSize = (int)(QR_PNG_MAXIMUM_SIZE / (count($tab)+2*$this->margin));

            return QRvct::svg($tab, $outfile, min(max(1, $this->size), $maxSize), $this->margin, $saveandprint, $this->back_color, $this->fore_color, $style);
        
        } catch (Exception $e) {
        
            QRtools::log($outfile, $e->getMessage());
        
        }
    }

}

/**
 * QRvct class
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
class QRvct extends QRvect
{
    /**
     * Output Svg
     *
     * @param string $frame         frame
     * @param string $filename      filename
     * @param num    $pixelPerPoint pixelPerPoint
     * @param num    $outerFrame    outerFrame
     * @param bool   $saveandprint  save and print
     * @param string $back_color    back_color
     * @param string $fore_color    fore_color
     * @param array  $style         style
     *
     * @return Save
     */
    public static function svg($frame, $filename = false, $pixelPerPoint = 4, $outerFrame = 4, $saveandprint = false, $back_color = 0xFFFFFF, $fore_color = 0x000000, $style = false)
    {
        $vect = self::_vectSVG($frame, $pixelPerPoint, $outerFrame, $back_color, $fore_color, $style, $saveandprint);
        if ($saveandprint) {
            return QRtools::save($vect, $filename);
        } else {
            return $vect;
        }
    }

    /**
     * Create Svg
     *
     * @param string $frame         frame
     * @param num    $pixelPerPoint pixelPerPoint
     * @param num    $outerFrame    outerFrame
     * @param string $back_color    back_color
     * @param string $fore_color    fore_color
     * @param array  $style         style
     * @param bool   $saveandprint  save or output
     *
     * @return Save
     */
    private static function _vectSVG($frame, $pixelPerPoint = 4, $outerFrame = 4, $back_color = 0xFFFFFF, $fore_color = 0x000000, $style = false, $saveandprint = false)
    {
        include dirname(__FILE__).'/markers.php';

        $watermark = isset($style['optionlogo']) && $style['optionlogo'] !== 'none' ? $style['optionlogo'] : false;
        $no_logo_bg = isset($style['no_logo_bg']) ? $style['no_logo_bg'] : false;

        $markers_color = isset($style['markers_color']) ? $style['markers_color'] : false;
        $markerOut = isset($style['marker_out']) ? $style['marker_out'] : false;
        $markerIn = isset($style['marker_in']) ? $style['marker_in'] : false;
        $markerOutColor = isset($style['marker_out_color']) ? $style['marker_out_color'] : false;
        $markerInColor = isset($style['marker_in_color']) ? $style['marker_in_color'] : false;
        $marker_top_right_outline = isset($style['marker_top_right_outline']) ? $style['marker_top_right_outline'] : $markerOutColor;
        $marker_top_right_center = isset($style['marker_top_right_center']) ? $style['marker_top_right_center'] : $markerInColor;
        $marker_bottom_left_outline = isset($style['marker_bottom_left_outline']) ? $style['marker_bottom_left_outline'] : $markerOutColor;
        $marker_bottom_left_center = isset($style['marker_bottom_left_center']) ? $style['marker_bottom_left_center'] : $markerInColor;

        $pattern = isset($style['pattern']) ? $style['pattern'] : false;

        $gradient = isset($style['gradient']) ? $style['gradient'] : false;
        $gradient_color = isset($style['gradient_color']) ? $style['gradient_color'] : false;
        $radial = isset($style['radial']) ? $style['radial'] : false;
        $setframe = isset($style['frame']) && $style['frame'] !== 'none' ? $style['frame'] : false;
        $backgroundcolor = '#'.str_pad(dechex($back_color), 6, "0", STR_PAD_LEFT);
        $frontcolor = '#'.str_pad(dechex($fore_color), 6, "0", STR_PAD_LEFT);

        $h = count($frame);
        $w = strlen($frame[0]);

        $qrcodeW = $w * $pixelPerPoint;
        $framemargin = $pixelPerPoint*$outerFrame;

        if ($setframe) {
            $frameunit = $qrcodeW/24;
            $framemargin = $frameunit*$outerFrame;
        }

        $realimgW = $qrcodeW + $framemargin*2;
        $frameunit = $realimgW/24;

        $framediff = 0;
        $frametranslate = '';
        $backgroundsize = $realimgW;
        $backgroundmargin = 0;

        if ($setframe) {

            include dirname(__FILE__).'/frames.php';

            $custom_frame_color = isset($style['custom_frame_color']) ? $style['custom_frame_color'] : false;
            $framecolor = isset($style['framecolor']) && $custom_frame_color ? $style['framecolor'] : false;
            $framelabel = isset($style['framelabel']) ? $style['framelabel'] : '';
            $label_font = isset($style['label_font']) ? $style['label_font'] : 'Arial, Helvetica, sans-serif';

            $frametype = $setframe;

            $frameborder = isset($frames[$frametype]['frame_border']) ? intval($frames[$frametype]['frame_border']) : 1;
            $framespacer = isset($frames[$frametype]['label_size']) ? $frames[$frametype]['label_size'] : 0;
            $frameoffset = isset($frames[$frametype]['label_offset']) ? $frames[$frametype]['label_offset'] : 0;
            $framelabelpos = $frames[$frametype]['label_pos'];
            $offset = $frameunit*$frameoffset;
            $spacerH = $framespacer*$frameunit;
            $scarto_top = $frameborder-1;
            $framediff = ($frameunit*($framespacer+$frameoffset+1)-$scarto_top);
            $backgroundsize = ($realimgW - $frameborder * 2 * $frameunit)*1.01;

            $labellen = strlen($framelabel);
            $xsize = $labellen > 0 ? $backgroundsize / $labellen : $realimgW;
            $fontsize = min($xsize, $spacerH);
            $texty = ($framespacer+1)*$frameunit - $framespacer/2*$frameunit + $fontsize/2.6;
            $frametranslate = $framelabelpos == 'top' ? ' transform="translate(0,'.$framediff.')"' : '';
            $texttranslate = $framelabelpos == 'bottom' ? ' transform="translate(0,'.($realimgW-$frameunit+$offset).')"' : '';
            $backgroundmargin = $frameunit*$frameborder;
            $labeltext_color = isset($style['labeltext_color']) ? $style['labeltext_color'] : '#ffffff';
            $textadjust = $xsize < $spacerH ? ' textLength="'.($backgroundsize-$frameunit*2).'" lengthAdjust="spacing" x="'.($backgroundmargin+$frameunit).'"': ' text-anchor="middle" x="'.($realimgW/2).'"';
        }

        $realimgH = $realimgW+$framediff;
        $marker_size = $pixelPerPoint*7;
        $marker_margin = $framemargin;
        $opposite_pos = ($realimgW - $marker_size - $marker_margin);
        $marker_size_in = $pixelPerPoint*3;
        $marker_margin_in = $framemargin+$pixelPerPoint*2;
        $opposite_pos_in = ($realimgW - $marker_size_in - $marker_margin_in);

        $markerOutPath = $markerOut && isset($markers[$markerOut]) ? $markers[$markerOut] : $markers['default'];
        $markerInPath = $markerIn && isset($markersIn[$markerIn]) ? $markersIn[$markerIn] : $markersIn['default'];
        $patternPath = $pattern && isset($markersIn[$pattern]) ? $markersIn[$pattern] : $markersIn['default'];

        $rotate_tr_out = $markerOutPath['rotate'] ? ' rotate(90 7 7)' : '';
        $rotate_bl_out = $markerOutPath['rotate'] ? ' rotate(-90 7 7)' : '';
        $rotate_tr_in = $markerInPath['rotate'] ? ' rotate(90 3 3)' : '';
        $rotate_bl_in = $markerInPath['rotate'] ? ' rotate(-90 3 3)' : '';

        $output = '';
        if ($saveandprint) {
            $output .= '<?xml version="1.0" encoding="utf-8"?>'."\n".
            '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">'."\n";
        }
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" width="'.$realimgW.'" height="'.$realimgH.'" viewBox="0 0 '.$realimgW.' '.$realimgH.'">'."\n";

        if ($watermark) {

            $minwhaterhole = ($h - 16);
            $maxwhaterhole = ($h / 3.5);

            if ($minwhaterhole < $maxwhaterhole) {
                $whaterhole = $minwhaterhole;
                $startpoint = ($h - $whaterhole) / 2;
                $endpoint = ($startpoint + $whaterhole);
                $watermark_size = $whaterhole * $pixelPerPoint;
            } else {
                $whaterhole = $maxwhaterhole;
                $waterholerounded = round($whaterhole, 0, PHP_ROUND_HALF_UP);

                if ($h % 2 == 0) {
                    if ($waterholerounded % 2 == 0) {
                        $waterholefinal = $waterholerounded;
                    } else {
                        $waterholefinal = $waterholerounded+1;
                    }
                } else {
                    if ($waterholerounded % 2 == 0) {
                        $waterholefinal = $waterholerounded+1;
                    } else {
                        $waterholefinal = $waterholerounded;
                    }
                }
                $startpoint = ($h - $waterholefinal) / 2;
                $endpoint = ($startpoint + $waterholefinal);
                $watermark_size = $pixelPerPoint*$waterholefinal;
            }
        }
        // $output .= '<desc>debug</desc>'."\n";
        $output .= '<defs>';

        $fill = 'fill="'.$frontcolor.'"';

        if ($gradient) {
            if ($radial) {
                $output .= '<radialGradient id="pattern-gradient" cx="50%" cy="50%" r="50%" fx="50%" fy="50%" gradientUnits="userSpaceOnUse">';
                $output .= '<stop offset="0%" stop-color="'.$frontcolor.'" />';
                $output .= '<stop offset="100%" stop-color="'.$gradient_color.'" /></radialGradient>'."\n";
            } else {
                $output .= '<linearGradient id="pattern-gradient" x1="0%" y1="0%" x2="12%" y2="100%" gradientUnits="userSpaceOnUse">';
                $output .= '<stop offset="0%" stop-color="'.$frontcolor.'" />';
                $output .= '<stop offset="100%" stop-color="'.$gradient_color.'" /></linearGradient>'."\n";
            }
            $fill = 'fill="url(#pattern-gradient)"';
        }

        $output .= '<mask id="qrmask"><g fill="#ffffff">';

        // Draw frame same color of dots.
        if ($setframe && !$framecolor) {
            $output .= '<g transform="scale('.$frameunit.')">' . $frames[$frametype]['path'].'</g>'."\n";
        }

        $output .= '<g'.$frametranslate.'>'."\n";

        // Remove points for watermark
        if ($watermark && $no_logo_bg) {
            for ($r=0; $r<$h; $r++) { // each row
                for ($c=0; $c<$w; $c++) { // each col 
                    if ($r >= $startpoint && $r < $endpoint && $c >= $startpoint && $c < $endpoint) {
                        $frame[$r][$c] = '0';
                    }
                }
            }
        }

        for ($r=0; $r<$h; $r++) { // each row
            for ($c=0; $c<$w; $c++) { // each col 
                if ($frame[$r][$c] == '1' ) {
                    $y = ($r * $pixelPerPoint) + $framemargin;
                    $x = ($c * $pixelPerPoint) + $framemargin;
                    $rowbefore = ($r-1);
                    $rowafter = ($r+1);
                    $colbefore = ($c-1);
                    $colafter = ($c+1);
                    $trbl = '';
                    if ($rowbefore >= 0 && isset($frame[$rowbefore][$c]) && $frame[$rowbefore][$c] == '1') {
                        $trbl .= 't';
                    }
                    if (isset($frame[$r][$colafter]) && $frame[$r][$colafter] == '1') {
                        $trbl .= 'r';
                    }
                    if (isset($frame[$rowafter][$c]) && $frame[$rowafter][$c] == '1') {
                        $trbl .= 'b';
                    }
                    if ($colbefore >= 0 && isset($frame[$r][$colbefore]) && $frame[$r][$colbefore] == '1') {
                        $trbl .= 'l';
                    }
                    $trbl = strlen($trbl) > 2 && !isset($patternPath[$trbl]) ? 'trbl' : $trbl;
                    $path = isset($patternPath[$trbl]) ? $trbl : 'path';
                    $hake = '';
                    if ($pattern == 'shake') {
                        $hake = ' rotate('.rand(-10, 10).')';
                    }
                    $output .= '<g transform="translate('.$x.','.$y.') scale('.($pixelPerPoint/6*1.03).')'.$hake.'">' . $patternPath[$path].'</g>'."\n";
                }
            }
        }
        if (!$markers_color) {
            $output .= '<g transform="translate('.$marker_margin.','.$marker_margin.')"><g transform="scale('.($pixelPerPoint/2).')">'.$markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$opposite_pos.','.$marker_margin.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_out.'">'.$markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin.','.$opposite_pos.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_out.'">'.$markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin_in.','.$marker_margin_in.')"><g transform="scale('.($pixelPerPoint/2).')">'.$markerInPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$opposite_pos_in.','.$marker_margin_in.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_in.'">'.$markerInPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin_in.','.$opposite_pos_in.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_in.'">'.$markerInPath['path'].'</g></g>'."\n";
        }
        $output .= '</g></g></mask></defs>'."\n";

        // Draw background.
        if (!empty($back_color) && $back_color !== 'transparent') {
            $output .= '<rect width="'.$backgroundsize.'" height="'.$backgroundsize.'" fill="'.$backgroundcolor.'" x="'.$backgroundmargin.'" y="'.$backgroundmargin.'"'.$frametranslate.' />'."\n";
        }

        // Draw frame with custom color.
        if ($setframe && $framecolor) {
            $output .= '<g fill="'.$framecolor.'" transform="scale('.$frameunit.')">' . $frames[$frametype]['path'].'</g>'."\n";
        }
        $output .= '<rect x="0" y="0" width="'.$realimgW.'" height="'.$realimgH.'" mask="url(#qrmask)" '.$fill.' />'."\n";

        if ($markers_color) {
            $marker_in_fill = $markerInColor ? ' fill="'.$markerInColor.'"' : ' fill="'.$frontcolor.'"';
            $marker_out_fill = $markerOutColor ? ' fill="'.$markerOutColor.'"' : ' fill="'.$frontcolor.'"';
            $marker_in_tr_fill = $marker_top_right_center ? ' fill="'.$marker_top_right_center.'"' : ' fill="'.$frontcolor.'"';
            $marker_out_tr_fill = $marker_top_right_outline ? ' fill="'.$marker_top_right_outline.'"' : ' fill="'.$frontcolor.'"';
            $marker_in_bl_fill = $marker_bottom_left_center ? ' fill="'.$marker_bottom_left_center.'"' : ' fill="'.$frontcolor.'"';
            $marker_out_bl_fill = $marker_bottom_left_outline ? ' fill="'.$marker_bottom_left_outline.'"' : ' fill="'.$frontcolor.'"';

            $output .= '<g'.$frametranslate.'>';
            $output .= '<g transform="translate('.$marker_margin.','.$marker_margin.')" '.$marker_out_fill.'><g transform="scale('.($pixelPerPoint/2).')">' . $markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin_in.','.$marker_margin_in.')" '.$marker_in_fill.'><g transform="scale('.($pixelPerPoint/2).')">' . $markerInPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$opposite_pos.','.$marker_margin.')" '.$marker_out_tr_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_out.'">' . $markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$opposite_pos_in.','.$marker_margin_in.')" '.$marker_in_tr_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_in.'">' . $markerInPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin.','.$opposite_pos.')" '.$marker_out_bl_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_out.'">' . $markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin_in.','.$opposite_pos_in.')" '.$marker_in_bl_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_in.'">' . $markerInPath['path'].'</g></g>';
            $output .= '</g>'."\n";
        }
        if ($setframe && $framelabel) {
            $output .= '<text fill="'.$labeltext_color.'" font-family="'.$label_font.'" font-size="'.$fontsize.'px"'.$textadjust.' y="'.$texty.'"'.$texttranslate.'>'.$framelabel.'</text>';
        }
        if ($watermark) {

            $base64 = false;
            $basemark = 'data:image/';

            if (substr($watermark, 0, strlen($basemark)) === $basemark) {
                $base64 = $watermark;
            } else {
                $path = dirname(dirname(__FILE__)).'/'.$watermark;
                if (file_exists($path)) {
                    // $mimetype = mime_content_type($path);
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $mimetype = 'image/' . $ext;
                    $type = $mimetype == 'image/svg' ? $mimetype.'+xml' : $mimetype;
                    $data = file_get_contents($path);
                    $base64 = 'data:' . $type . ';base64,' . base64_encode($data);
                }
            }

            if ($base64) {
                $watermark_pos = $realimgW/2 - $watermark_size/2;
                $output .= '<image xlink:href="'.$base64.'" width="'.$watermark_size.'" height="'.$watermark_size.'" x="'.$watermark_pos.'" y="'.$watermark_pos.'"'.$frametranslate.' />'."\n";
            }
        }
        $output .= '</svg>';

        return $output;
    }
}
