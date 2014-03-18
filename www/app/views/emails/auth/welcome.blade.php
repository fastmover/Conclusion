<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Welcome.</h2>

		<div>
			<p>Thank you for registering {{ $username }}.</p>

			<p>Please click the following link to verify your account: {{ URL::to('/verify', array($uuid)) }} </p>

		</div>
	</body>
</html>