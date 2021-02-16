<nav class="navbar navbar-expand-sm fixed-top top-menu-wrapper" id="navbar">
	<div class="container">
		<a href=""><img src="<?php echo $relative; ?>svg/logo.svg" alt="" /></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
		<ul class="navbar-nav">
			<?php echo qrcdr()->langMenu('menu'); ?>  
		</ul>
		</div>  
	</div>
</nav>
