<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">

		<!-- jQuery -->
		<script src="libs/jquery/jquery-3.2.1.min.js"></script>

		<!-- Semantic-ui -->
		<link rel="stylesheet" href="libs/semantic-ui/semantic.min.css">
		<script src="libs/semantic-ui/semantic.min.js"></script>

		<!-- jQuery form -->
		<script src="libs/jqueryform/jquery.form.js"></script>
		
		<!-- jQuery toast -->
		<link rel="stylesheet" href="libs/toast/toast.css">
		<script src="libs/toast/toast.js"></script>
		
		<!-- Font awesome -->
		<link rel="stylesheet" href="libs/fontawesome/css/font-awesome.min.css">
		
		<script>
		function showLoading() {
			$("#loader").addClass("active");
		}
		function hideLoading() {
			$("#loader").removeClass("active");
		}
		</script>
	</head>
	<body>
		<?=$this->section('content')?>
		<div id="loader" class="ui dimmer">
			<div class="ui text loader">Øjeblik</div>
		</div>
		<div id="toast"></div>
	</body>
</html>
