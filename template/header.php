<div class="header">
  <div class="header__section container-fluid">
    

    <nav class="navbar navbar-expand-md">
      <a href=""><img src="<?php echo $relative; ?>svg/logo.svg" alt="" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <?php echo qrcdr()->langMenu('menu'); ?>  
        </ul>
      </div>  
    </nav>

    <div class="row">
      <div class="col-sm -12 col-xl-5">
        <div class="header__title">QR Code Generator</div>
        <div class="header__describe">
          Manage all of your codes in one place using our free QR code
          generator and scanner app
        </div>
        <div class="header__button">
          <a href="">
            <img src="<?php echo $relative; ?>svg/buttons/app_store.svg" alt="" />
          </a>
          <a href="">
            <img src="<?php echo $relative; ?>svg/buttons/google_play.svg" alt="" />
          </a>
        </div>
        <div class="header__button__mobile container-fluid text-center">
          <div class="row">
            <div class="col-6">
              <a href="">
                <img src="<?php echo $relative; ?>svg/buttons/app_store.svg" alt="" />
              </a>
            </div>
            <div class="col-6">
              <a href="">
                <img src="<?php echo $relative; ?>svg/buttons/google_play.svg" alt="" />
              </a>
            </div>
          </div>
        </div>
        <div class="header__link">
          <a href="">
            <img src="<?php echo $relative; ?>svg/buttons/down_now.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="col-xl-1"></div>
      <div class="col-sm -12 col-xl-6 text-right header__phone">
        <img src="<?php echo $relative; ?>svg/phone.svg" width="35%" alt="" />
      </div>
    </div>
  </div>

  <div class="header__wave">
    <img src="<?php echo $relative; ?>svg/header_wave.svg" width="100%" alt="" />
  </div>
</div>
