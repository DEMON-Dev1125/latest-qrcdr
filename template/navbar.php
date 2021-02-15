<div class="container">
	<nav class="navbar navbar-expand-md fixed-top" id="navbar">
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
</div>