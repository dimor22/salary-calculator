<?php


require './src/CalcSalary.php';

if (! empty($_REQUEST['amount']) && $_REQUEST['amount'] > 0) {
	$result = new CalcSalary($_REQUEST['amount'], $_REQUEST['status']);
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

	<title>Salary Calculator</title>


	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<form>
				<div class="form-group">
					<label for="amount">SALARY CALCULATOR</label>
					<input pattern="[0-9]*" type="text" class="form-control" id="amount" name="amount" placeholder="Enter Hourly or Yearly">
				</div>
                <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="optionsRadios1" value="0">
                            Single
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="optionsRadios2" value="1" checked>
                            Married
                        </label>
                    </div>
                </div>
				<div class="form-group">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>
		</div>
		<?php if ($show_results) { ?>
			<div class="col-lg-12">
                <div class="input">
                    <p>Value: <span class="number">$<?php echo number_format($_REQUEST['amount'], 2);?></span><?php echo $_REQUEST['amount'] < 1000 ? ' an hour' : ' a year';?></p>
                    <p>Taxes: <span class="number"><?php echo $result->output['tableHeader']['tax'] . '%' ?></span>  - <small>(Federal Tax, Social Security and Medicare)</small></p>
                    <p>Estatus: <?php echo $_REQUEST['status'] > 0 ? 'Married' : 'Single';?></p>
                </div>


                <div class="table-responsive">
					<table class="table">
                        <thead>
                        <tr>
                            <td></td>
                            <td>Before Taxes</td>
                            <td>After Taxes</td>
                        </tr>
                        </thead>
						<?php
						foreach($result->output['tableData'] as $v){
							echo '<tr><td>' . ucfirst($v['name']) . '</td><td class="value">$' . number_format($v['amount'], 2) . '</td><td class="value-taxes number">$' . number_format($v['withTax'], 2) . '</td></tr>';
						}
						?>
					</table>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<footer>
    <p>This estimator is based on 2078 hours per year as suggested by OPM.GOV. Taxes are calculated for the state of Nevada.</p>
    <p>Created by <a href="https://www.linkedin.com/in/dlopezwd" target="_blank">David Lopez</a></p>
</footer>

<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="js/app.js"></script>


</body>
</html>
