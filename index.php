<?php

require_once 'vendor/autoload.php';

use App\CalcSalary;

if (! empty($_REQUEST['amount']) && $_REQUEST['amount'] > 0) {
	$result = new CalcSalary($_REQUEST['amount']);
	$show_results = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<!-- mobile specific meta tags and links -->
	<meta name = "viewport" content = "width = device-width, user-scalable = no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">

	<link rel="apple-touch-icon" href="touch-icon-iphone.jpg">
	<link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.jpg">
	<link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.jpg">
	<link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.jpg">

	<link rel="stylesheet" href="style.css"/>

	<title>Salary Calculator</title>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

	<script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>

	<!-- progressive app ( chrome ) -->
	<link rel="manifest" href="manifest.json">
	<script>
		window.addEventListener('load', function() {
			var outputElement = document.getElementById('output');
			navigator.serviceWorker.register('service-worker.js', { scope: './' })
				.then(function(r) {
					console.log('registered service worker');
				})
				.catch(function(whut) {
					console.error('uh oh... ');
					console.error(whut);
				});

			window.addEventListener('beforeinstallprompt', function(e) {
				outputElement.textContent = 'beforeinstallprompt Event fired';
			});
		});
	</script>

</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<form>
				<div class="form-group">
					<label for="amount">SALARY CALCULATOR</label>
					<input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Hourly or Yearly">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>
		</div>
		<?php if ($show_results) { ?>
			<div class="col-lg-12">
				<p><span class="blue">$<?php echo number_format($_REQUEST['amount'], 2);?></span><?php echo $_REQUEST['amount'] < 1000 ? ' an hour' : ' a year'; echo ' equals'?></p>

				<div class="table-responsive">
					<table class="table">
						<?php
						foreach($result->output as $k => $v){
							echo '<tr><td>' . ucfirst($k) . '</td><td class="value">'. $v .'</td></tr>';
						}
						?>
					</table>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>




</body>

<script>

	//$('#amount').focus();

	// validation
	$('form').submit(function (e) {
		e.preventDefault();

		var amount = $('#amount').val();
		var submit = true;

		if ( amount == 0){
			$('#amount').val('');
			$('#amount').attr('placeholder',  "Don't be silly. Try with a number greater than 0.");
			submit = false;
		}

		if ( amount < 0){
			$('#amount').val('');
			$('#amount').attr('placeholder',  "Really? Negative pay?. Don't even take that job.");
			submit = false;
		}

		if ( amount == ''){
			$('#amount').val('');
			$('#amount').attr('placeholder',  "Hello!... It's empty.");
			submit = false;
		}

		if ( amount > 1000000){
			$('#amount').val('');
			$('#amount').attr('placeholder',  "Yeah right! keep dreaming.");
			submit = false;
		}

		if ( isNaN(amount)){
			$('#amount').val('');
			$('#amount').attr('placeholder',  "No letters, Are you pushing my limits?");
			submit = false;
		}

		if (submit) {
			this.submit();
		}

		$('#amount').focus();

	});
</script>

</html>
