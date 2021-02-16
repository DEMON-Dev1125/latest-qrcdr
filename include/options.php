<?php
    $accordion_parent = qrcdr()->getConfig('accordion') == true ? ' data-parent="#collapseSettings"' : '';
    $collapsed = qrcdr()->getConfig('accordion') == true ? '' : ' show';
?>
<div class="accordion" id="collapseSettings">
    <button class="acc-header btn btn-primary btn-lg btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseColors">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor">
            <path d="M18.717 8.831c-.734.824-.665 2.087.158 2.825l-1.333 1.491-7.455-6.667 1.334-1.49c.822.736 2.087.666 2.822-.159l3.503-3.831c.593-.663 1.414-1 2.238-1 1.666 0 3.016 1.358 3.016 2.996 0 .723-.271 1.435-.779 2.005l-3.504 3.83zm-8.217 6.169h-2.691l3.928-4.362-1.491-1.333-7.9 8.794c-1.277 1.423-.171 2.261-1.149 4.052-.135.244-.197.48-.197.698 0 .661.54 1.151 1.141 1.151.241 0 .492-.079.724-.256 1.733-1.332 2.644-.184 3.954-1.647l7.901-8.792-1.491-1.333-2.729 3.028z"/>
        </svg> <span class="vertical-middle">
        <?php echo qrcdr()->getString('colors'); ?></span>
        <i class="fa fa-plus float-right"></i>
    </button>
    <div class="collapse<?php echo $collapsed; ?> bg-light py-2" id="collapseColors"<?php echo $accordion_parent; ?>>
        <div class="col-sm-12 mb-2 custom-background">
            <div class="row">
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('background'); ?></label>
                    <div class="collapse show" id="collapse-background">
                        <div class="input-group qrcolorpicker colorpickerback">
                            <div class="input-group-prepend">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                            </div>
                            <input type="text" class="form-control" data-format="hex" value="<?php echo $stringbackcolor; ?>" name="backcolor">
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-control custom-switch mt-2">
              <input type="checkbox" class="custom-control-input collapse-control-reversed" id="trans-bg" name="transparent" data-target="#collapse-background">
              <label class="custom-control-label" for="trans-bg"><?php echo qrcdr()->getString('transparent_background'); ?></label>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('foreground'); ?></label>
                    <div class="input-group qrcolorpicker mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </div>
                        <input type="text" class="form-control" data-format="hex" 
                        value="<?php echo $stringfrontcolor; ?>" name="frontcolor">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input collapse-control" id="gradient-bg" data-target="#collapse-gradient" name="gradient">
                          <label class="custom-control-label" for="gradient-bg"><?php echo qrcdr()->getString('gradient'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="collapse" id="collapse-gradient">
                        <label><?php echo qrcdr()->getString('second_color'); ?></label>
                        <div class="input-group qrcolorpicker mb-2" id="collapse-gradient">
                            <div class="input-group-prepend">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                            </div>
                            <input type="text" class="form-control qrcolorpicker_bg" data-format="hex" value="#8900D5" name="gradient_color">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="radial-gradient" name="radial">
                              <label class="custom-control-label" for="radial-gradient"><?php echo qrcdr()->getString('radial'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="acc-header mt-2 btn btn-primary btn-lg btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseStyle">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 24 24"><path d="M21 21v3h3v-3h-1v-1h-1v1h-1zm2 1v1h-1v-1h1zm-23 2h8v-8h-8v8zm1-7h6v6h-6v-6zm20 3v-1h1v1h-1zm-19-2h4v4h-4v-4zm8-3v2h-1v-2h1zm2-8h1v1h-1v-1zm1-1h1v1h-1v-1zm1 2v-1h1v1h-1zm0-2h1v-6h-3v1h-3v1h3v1h2v3zm-1-4v-1h1v1h-1zm-7 4h-4v-4h4v4zm6 0h-1v-2h-2v-1h3v1h1v1h-1v1zm-4-6h-8v8h8v-8zm-1 7h-6v-6h6v6zm3 0h-1v-1h2v2h-1v-1zm-3 3v1h-1v-1h1zm15 6h2v3h-1v-1h-2v1h-1v-1h-1v-1h1v-1h1v1h1v-1zm-4 2h-1v1h-1v-1h-1v-1h1v-1h-2v-1h-1v1h-1v1h-2v1h-1v6h5v-1h-1v-2h-1v2h-2v-1h1v-1h-1v-1h3v-1h2v2h-1v1h1v2h1v-2h1v1h1v-1h1v-2h1v-1h-2v-1zm-1 3h-1v-1h1v1zm6-6v-2h1v2h-1zm-9 5v1h-1v-1h1zm5 3v-1h1v2h-2v-1h1zm-3-23v8h8v-8h-8zm7 7h-6v-6h6v6zm-1-1h-4v-4h4v4zm1 4h1v2h-1v1h-2v-4h1v2h1v-1zm-4 6v-3h1v3h-1zm-13-7v1h-2v1h1v1h-3v-1h1v-1h-2v1h-1v-2h6zm-1 4v-1h1v3h-1v-1h-1v1h-1v-1h-1v1h-2v-1h1v-1h4zm-4-1v1h-1v-1h1zm19-2h-1v-1h1v1zm-13 4h1v1h-1v-1zm15 2h-1v-1h1v1zm-5 1v-1h1v1h-1zm-1-1h1v-3h2v-1h1v-1h-1v-1h-2v-1h-1v1h-1v-1h-1v1h-1v-1h-1v1h-1v1h-1v-1h1v-1h-4v1h2v1h-2v1h1v2h1v-1h2v2h1v-4h1v2h3v1h-2v1h2v1zm1-5h1v1h-1v-1zm-2 1h-1v-1h1v1z"/></svg> 
        <span class="vertical-middle"><?php echo qrcdr()->getString('design'); ?></span>
        <i class="fa fa-plus float-right"></i> 
    </button>
    <div class="collapse<?php echo $collapsed; ?> bg-light py-2" id="collapseStyle"<?php echo $accordion_parent; ?>>
        <?php
        require dirname(dirname(__FILE__)).'/lib/markers.php';

        $patterns = $markersIn;

        $styleselecta = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';
        foreach ($patterns as $marker => $values) {
            if (isset($values['preview'])) {
                $activeattr = ($marker == 'default') ? 'checked' : '';
                $styleselecta .= '<label class="btn btn-light p-1">
                    <input type="radio" name="pattern" value="'.$marker.'" '.$activeattr.'>
                    <svg width="38" height="38" viewBox="0 0 6 6" xmlns="http://www.w3.org/2000/svg">'.$values['preview'].'</svg>
                </label>';
            }
        }
        $styleselecta .= '</div>';

        $markerselecta = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';
        foreach ($markers as $marker => $values) {
            $activeattr = ($marker == 'default') ? 'checked' : '';
            $markerselecta .= '<label class="btn btn-light p-1">
                <input type="radio" name="marker" value="'.$marker.'" '.$activeattr.'>
                <svg width="32" height="32" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'.$values['path'].'</svg>
            </label>';
        }
        $markerselecta .= '</div>';

        $markerselectaIn = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';
        foreach ($markersIn as $marker => $values) {
            if (isset($values['marker'])) {
                $activeattr = ($marker == 'default') ? 'checked' : '';
                $markerselectaIn .= '<label class="btn btn-light p-1">
                    <input type="radio" name="marker_in" value="'.$marker.'" '.$activeattr.'>
                    <svg width="14" height="14" viewBox="0 0 6 6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'.$values['path'].'</svg>
                </label>';
            }
        }
        $markerselectaIn .= '</div>';

        require dirname(dirname(__FILE__)).'/lib/frames.php';

        $frameselecta = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';
        foreach ($frames as $frame => $values) {
            $activeattr = $frame == 'none' ? 'checked' : '';
            $viewH = isset($values['label_size']) && isset($values['label_offset']) ? (24 + $values['label_size'] + 2 + $values['label_offset']) : 24;
            $frameselecta .= '<label class="btn btn-light p-1">
                <input type="radio" name="outer_frame" value="'.$frame.'" '.$activeattr.'>
                <svg width="48" height="56" viewBox="0 0 24 '.$viewH.'" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'.$values['path'].'</svg>
            </label>';
        }

        $frameselecta .= '</div>';
        ?>
        <div class="col-12">
            <label><?php echo qrcdr()->getString('pattern'); ?></label>
        </div>
        <div class="col-12 mb-2">
            <?php echo $styleselecta; ?>
        </div>
        <div class="col-12">
            <label><?php echo qrcdr()->getString('marker_outline'); ?></label>
        </div>
        <div class="col-12 mb-2">
            <?php echo $markerselecta; ?>
        </div>
        <div class="col-12">
            <label><?php echo qrcdr()->getString('marker_center'); ?></label>
        </div>
        <div class="col-12">
            <?php echo $markerselectaIn; ?>
        </div>

        <div class="col-12 mb-2">
            <div class="row collapse collapse-markers-bg">
                <div class="col-sm-6 mt-2">
                    <label><?php echo qrcdr()->getString('marker_outline'); ?></label>
                    <div class="input-group qrcolorpicker">
                        <div class="input-group-prepend">
                            <span class="input-group-text colorpicker-input-addon"><i><div class="colorpicker-minisquare"></div></i></span>
                        </div>
                        <input type="text" class="form-control" data-format="hex" value="<?php echo $stringfrontcolor; ?>" name="marker_out_color">
                    </div>
                </div>

                <div class="col-sm-6 mt-2">
                    <label><?php echo qrcdr()->getString('marker_center'); ?></label>
                    <div class="input-group qrcolorpicker">
                        <div class="input-group-prepend">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </div>
                        <input type="text" class="form-control" data-format="hex" value="<?php echo $stringfrontcolor; ?>" name="marker_in_color">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-2">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input collapse-control" id="markers-bg" data-target=".collapse-markers-bg" name="markers_color">
                      <label class="custom-control-label" for="markers-bg"><?php echo qrcdr()->getString('custom_markers_colors'); ?></label>
                    </div>
                </div>
            </div>

            <div class="collapse collapse-markers-bg">
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input collapse-control" id="different-markers-bg" data-target="#collapse-different-markers-bg" name="different_markers_color">
                          <label class="custom-control-label" for="different-markers-bg"><?php echo qrcdr()->getString('different_markers_colors'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="row collapse" id="collapse-different-markers-bg">
                    <div class="col-sm-6 mt-2">
                        <label><?php echo qrcdr()->getString('top_right'); ?></label>
                        <div class="input-group qrcolorpicker">
                            <div class="input-group-prepend">
                                <span class="input-group-text colorpicker-input-addon"><i><div class="colorpicker-minisquare"></div></i></span>
                            </div>
                            <input type="text" class="form-control" data-format="hex" value="<?php echo $stringfrontcolor; ?>" name="marker_top_right_outline">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-2">
                        <label><?php echo qrcdr()->getString('top_right'); ?></label>
                        <div class="input-group qrcolorpicker">
                            <div class="input-group-prepend">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                            </div>
                            <input type="text" class="form-control" data-format="hex" value="<?php echo $stringfrontcolor; ?>" name="marker_top_right_center">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-2 mb-2">
                        <label><?php echo qrcdr()->getString('bottom_left'); ?></label>
                        <div class="input-group qrcolorpicker">
                            <div class="input-group-prepend">
                                <span class="input-group-text colorpicker-input-addon"><i><div class="colorpicker-minisquare"></div></i></span>
                            </div>
                            <input type="text" class="form-control" data-format="hex" value="<?php echo $stringfrontcolor; ?>" name="marker_bottom_left_outline">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-2 mb-2">
                        <label><?php echo qrcdr()->getString('bottom_left'); ?></label>
                        <div class="input-group qrcolorpicker">
                            <div class="input-group-prepend">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                            </div>
                            <input type="text" class="form-control" data-format="hex" value="<?php echo $stringfrontcolor; ?>" name="marker_bottom_left_center">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <button class="acc-header mt-2 btn btn-primary btn-lg btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseWatermark">
        <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.273 2.513l-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/><path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/></svg> 
        <span class="vertical-middle"><?php echo qrcdr()->getString('logo'); ?></span>
        <i class="fa fa-plus float-right"></i>
    </button>
    <div class="collapse<?php echo $collapsed; ?> bg-light py-2" id="collapseWatermark"<?php echo $accordion_parent; ?>>
        <?php
        if (qrcdr()->getConfig('uploader') == true) {
            ?>
        <div class="col-12">
            <small><?php echo qrcdr()->getString('upload_or_select_watermark'); ?></small>
            <div class="custom-file">
            <input type="file" name="file" class="custom-file-input" aria-describedby="validate-upload" id="upmarker">
                <div id="validate-upload" class="invalid-feedback">
                    <?php echo qrcdr()->getString('invalid_image'); ?>
                </div>
            <label class="custom-file-label" for="file"></label>
            </div>
        </div>
            <?php
        }
        /**
        * Watermarks
        */
        $waterdir = $relative."images/watermarks/";
        $watermarks = glob($waterdir.'*.{gif,jpg,png,svg}', GLOB_BRACE);
        $count = count($watermarks);
        if (qrcdr()->getConfig('uploader') == true || $count > 0) {
            $listwatermarks = '';
            foreach ($watermarks as $key => $water) {
                $listwatermarks .= '<label class="btn btn-light';
                if ($optionlogo == $water) $listwatermarks .= ' active ';

                $watervalue = $water;
                if (substr($water, 0, strlen($relative)) == $relative) {
                    $watervalue = substr($water, strlen($relative));
                }

                $listwatermarks .= '"><input type="radio" name="optionlogo" value="'.$watervalue.'"';
                if ($optionlogo == $watervalue) $listwatermarks .= ' checked';
                $listwatermarks .= ' id="optionlogo'.$key.'"><img src="'.$water.'"></label>';
            }
            ?>
            <div class="col-12 pt-2">
                <div class="logoselecta form-group">
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-light active">
                            <input type="radio" name="optionlogo" value="none" checked="">
                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </label><?php echo $listwatermarks; ?>
                        <label class="btn btn-light custom-watermark"><input type="radio" name="optionlogo" value=""><div class="hold-custom-watermark"></div></label>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="no-logo-bg" name="no_logo_bg">
                <label class="custom-control-label" for="no-logo-bg"><?php echo qrcdr()->getString('no_logo_background'); ?></label>
                </div>
            </div>
            <?php
        }
        ?>
    </div> <!-- collapse logo -->

    <button class="acc-header mt-2 btn btn-primary btn-lg btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFrame">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 24 24"><path d="M16 0v2h-8v-2h8zm0 24v-2h-8v2h8zm2-22h4v4h2v-6h-6v2zm-18 14h2v-8h-2v8zm2-10v-4h4v-2h-6v6h2zm22 2h-2v8h2v-8zm-2 10v4h-4v2h6v-6h-2zm-16 4h-4v-4h-2v6h6v-2z"/></svg> 
        <span class="vertical-middle"><?php echo qrcdr()->getString('frame'); ?></span>
        <i class="fa fa-plus float-right"></i>
    </button>
    <div class="collapse<?php echo $collapsed; ?> bg-light py-2" id="collapseFrame"<?php echo $accordion_parent; ?>>
        <div class="col-12 mb-2 py-2">
            <?php echo $frameselecta; ?>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('frame_label'); ?></label>
                    <input class="form-control" type="text" name="framelabel" value="SCAN ME">
                </div>
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('label_font'); ?></label>
                    <select name="label_font" class="custom-select">
                        <option value="Arial, Helvetica, sans-serif" style="font-family: Arial, Helvetica, sans-serif">
                            Sans-Serif
                        </option>
                        <option value="\'Times New Roman\', Times, serif" style="font-family: \'Times New Roman\', Times, serif">
                            Serif
                        </option>
                        <option value="\'Courier New\', Courier, monospace" style="font-family: \'Courier New\', Courier, monospace">
                            Monospace
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 mb-2">
            <div class="row collapse" id="collapse-frame-color">
                <div class="col-sm-6 mt-2">
                    <label><?php echo qrcdr()->getString('frame_color'); ?></label>
                    <div class="input-group qrcolorpicker">
                        <div class="input-group-prepend">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </div>
                        <input type="text" class="form-control" data-format="hex" value="<?php echo $stringfrontcolor; ?>" name="framecolor">
                    </div>
                </div>
            </div>

            <div class="form-group mt-2">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input collapse-control" id="frame-color" data-target="#collapse-frame-color" name="custom_frame_color">
                  <label class="custom-control-label" for="frame-color"><?php echo qrcdr()->getString('custom_frame_color'); ?></label>
                </div>
            </div>
        </div>
    </div> <!-- collapse frame -->

    <button class="acc-header mt-2 btn btn-primary btn-lg btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOptions">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-toggles" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.5 9a3.5 3.5 0 1 0 0 7h7a3.5 3.5 0 1 0 0-7h-7zm7 6a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-7-14a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm2.45 0A3.49 3.49 0 0 1 8 3.5 3.49 3.49 0 0 1 6.95 6h4.55a2.5 2.5 0 0 0 0-5H6.95zM4.5 0h7a3.5 3.5 0 1 1 0 7h-7a3.5 3.5 0 1 1 0-7z"/></svg> 
        <span class="vertical-middle"><?php echo qrcdr()->getString('options'); ?></span>
        <i class="fa fa-plus float-right"></i> 
    </button>
    <div class="collapse<?php echo $collapsed; ?> bg-light py-2" id="collapseOptions"<?php echo $accordion_parent; ?>>
        <?php
        /**
         * SIZE AND PRECISION
         */
        ?>  
        <div class="col-sm-12 mb-2">
            <div class="row">
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('size'); ?></label>
                    <select name="size" class="custom-select qrcode-size-selector">
                <?php
                for ($i=8; $i<=32; $i+=4) {
                    $value = $i*25;
                    echo '<option value="'.$i.'" '.( $matrixPointSize == $i ? 'selected' : '' ) . '>'.$value.'</option>';
                }; ?>
                    </select>
                </div>

                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('error_correction_level'); ?></label>
                    <select name="level" class="custom-select">
                        <option value="L" <?php if ($errorCorrectionLevel=="L") echo "selected"; ?>>
                            <?php echo qrcdr()->getString('precision_l'); ?>
                        </option>
                        <option value="M" <?php if ($errorCorrectionLevel=="M") echo "selected"; ?>>
                            <?php echo qrcdr()->getString('precision_m'); ?>
                        </option>
                        <option value="Q" <?php if ($errorCorrectionLevel=="Q") echo "selected"; ?>>
                            <?php echo qrcdr()->getString('precision_q'); ?>
                        </option>
                        <option value="H" <?php if ($errorCorrectionLevel=="H") echo "selected"; ?>>
                            <?php echo qrcdr()->getString('precision_h'); ?>
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div><!-- collapseSettings -->


<script> 
    $(document).ready(function() { 
        
        // Add minus icon for collapse element which 
        // is open by default 
        $(".collapse.show").each(function() { 
            $(this).prev(".acc-header").find(".fa") 
                .addClass("fa-minus").removeClass("fa-plus"); 
        }); 

        // Toggle plus minus icon on show hide 
        // of collapse element 
        $(".collapse").on('show.bs.collapse', function() { 
            $(this).prev(".acc-header").find(".fa") 
                .removeClass("fa-plus").addClass("fa-minus"); 
        }).on('hide.bs.collapse', function() { 
            $(this).prev(".acc-header").find(".fa") 
                .removeClass("fa-minus").addClass("fa-plus"); 
        }); 
    }); 
</script> 