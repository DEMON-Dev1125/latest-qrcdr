<head><style type="text/css">
.loader,
.loader:before,
.loader:after {
  border-radius: 50%;
}
.loader {
  color: #202434;
  font-size: 11px;
  text-indent: -99999em;
  margin: 55px auto;
  position: relative;
  width: 10em;
  height: 10em;
  box-shadow: inset 0 0 0 1em;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.loader:before,
.loader:after {
  position: absolute;
  content: '';
}
.loader:before {
  width: 5.2em;
  height: 10.2em;
  background: #ffffff;
  border-radius: 10.2em 0 0 10.2em;
  top: -0.1em;
  left: -0.1em;
  -webkit-transform-origin: 5.1em 5.1em;
  transform-origin: 5.1em 5.1em;
  -webkit-animation: load2 2s infinite ease 1.5s;
  animation: load2 2s infinite ease 1.5s;
}
.loader:after {
  width: 5.2em;
  height: 10.2em;
  background: #ffffff;
  border-radius: 0 10.2em 10.2em 0;
  top: -0.1em;
  left: 4.9em;
  -webkit-transform-origin: 0.1em 5.1em;
  transform-origin: 0.1em 5.1em;
  -webkit-animation: load2 2s infinite ease;
  animation: load2 2s infinite ease;
}
@-webkit-keyframes load2 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes load2 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
</head><body><div class="loader">Loading...</div>
</body>
<?php
$getfile = filter_input(INPUT_GET, "file", FILTER_SANITIZE_STRING);
$filepath = dirname(dirname(__FILE__)).'/'.$getfile.'.svg';
if (file_exists($filepath)) {
	include_once __DIR__ . '/mpdf/autoload.php';

	$mpdf = new \Mpdf\Mpdf(['mode' => 'c']); // Only core fonts
	$mpdf->imageVars['myvariable'] = file_get_contents(dirname(dirname(__FILE__)).'/'.$getfile.'.svg');
	$image = '<div style="width:100%; text-align: center;"><img style="height: auto; max-width:100%; margin:0 auto;" src="var:myvariable" /></div>';

	$mpdf->WriteHTML($image);
	$mpdf->Output('qrcode.pdf', 'I');
}
exit;
