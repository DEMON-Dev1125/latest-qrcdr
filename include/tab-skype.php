<?php
/**
 * Skype
 */
if (qrcdr()->getConfig('skype') == true) { ?>
<div class="tab-pane fade <?php if ($getsection === "#skype") echo "show active"; ?>" id="skype">
    <h4>Skype</h4>

    <div class="form-group">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="skypeType1" name="skypeType" class="custom-control-input" value="chat" checked>
            <label class="custom-control-label" for="skypeType1"><?php echo qrcdr()->getString('chat'); ?></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="skypeType2" name="skypeType" class="custom-control-input" value="call">
            <label class="custom-control-label" for="skypeType2"><?php echo qrcdr()->getString('call'); ?></label>
        </div>
    </div>
    <div class="form-group">
        <label for="skype"><?php echo qrcdr()->getString('username'); ?></label>
        <input type="text" name="skype" id="skype" class="form-control" required="required" />
    </div>
</div>
    <?php
}
