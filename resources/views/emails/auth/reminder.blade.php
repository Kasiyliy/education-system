<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Сброс пороля</h2>

		<div>
			Для сброса своего пороля, выполните эт уформу: {{ URL::to('password/reset', array($token)) }}.<br/>
			Эта ссылка исчезнет через {{ Config::get('auth.reminder.expire', 60) }} minutes.
		</div>
	</body>
</html>
