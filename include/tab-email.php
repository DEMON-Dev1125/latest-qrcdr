<?php
/**
 * E-MAIL
 */
if (qrcdr()->getConfig('email') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#email") echo "show active"; ?>" id="email">
        <h4><?php echo qrcdr()->getString('email'); ?></h4>
        <div class="row">
            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('send_to'); ?></label>
                <input type="email" name="mailto" placeholder="E-Mail" class="form-control" required="required">
            </div>
            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('subject'); ?></label>
                <input type="text" name="subject" class="form-control" required="required">
            </div>
            <div class="col-12 form-group">
                 <label><?php echo qrcdr()->getString('text'); ?></label>
                <textarea name="body" class="form-control" required="required" maxlength="1000"></textarea>
            </div>
        </div>
    </div>
    <?php
}
