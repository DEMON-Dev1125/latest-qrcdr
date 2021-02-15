<div class="footer__section">
    <div class="container">
        <div class="row footer__up">
            <div class="col-sm-2"></div>
            <div class="col-12 col-sm-8">
                <div class="footer__title">Get a our QR Lock app now</div>
                <div class="footer__describe">
                    No contact, no set-up costs, just awesome way to organise your
                    money.
                </div>
                <div class="row link__area">
                    <div class="col-lg-2"></div>
                    <div class="col-12 col-md-6 col-lg-4 link__free">
                        <a href=""><img src="<?php echo $relative; ?>svg/buttons/try_btn_white.svg" alt="" /></a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 link__store">
                        <a href=""><img src="<?php echo $relative; ?>svg/buttons/visit_app_store.svg" alt="" /></a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 link__free__out">
                        <a href=""><img src="<?php echo $relative; ?>svg/buttons/try_free_white.svg" alt="" /></a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 link__white__store">
                        <a href=""><img src="<?php echo $relative; ?>svg/buttons/visit_app_white.svg" alt="" /></a>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
                <div class="row footer_scan">
                    <div class="col-lg-2"></div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="qr__title">Or scan the QR code below</div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center">
                        <img src="<?php echo $relative; ?>svg/footer_qr.svg" width="140px" alt="" />
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="footer__logo">
            <a href=""><img src="<?php echo $relative; ?>svg/footer_logo.svg" alt="" /></a>
        </div>
        <div class="footer__down row">
            <div class="col-6 col-md-4 footer__link">
                <a href="">Term & Conditions</a>
            </div>
            <div class="col-6 col-md-4 footer__link">
                <a href="">Privacy Policy</a>
            </div>
            <div class="col-6 col-md-4 footer__link">
                <a href="">more</a>
            </div>
        </div>
        <div class="social__icons text-center">
            <a href="#"><img src="<?php echo $relative; ?>svg/icons/google.svg" alt="" /></a>
            <a href="#"><img src="<?php echo $relative; ?>svg/icons/twitter.svg" alt="" /></a>
            <a href="#"><img src="<?php echo $relative; ?>svg/icons/linkedin.svg" alt="" /></a>
            <a href="#"><img src="<?php echo $relative; ?>svg/icons/instagram.svg" alt="" /></a>
        </div>
        <div class="copyright">Copyright © 2020. Crafted with love.</div>
    </div>
</div>

<script>
    window.onscroll = () => {
        const nav = document.querySelector('#navbar');
        if (this.scrollY <= 10) nav.classList.remove("scroll"); else nav.classList.add("scroll");
    };
</script>