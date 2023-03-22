<!DOCTYPE html>
<html>
<head>
    <title>Code.engine.studio.com</title>
</head>
<body>
<h1>{{ $mailData['title'] }}</h1>
<p>{{ $mailData['body'] }}</p>
<a href="{{url(env("url_fe").'/invite?token='.$mailData['token'])}}">Click here</a>
<p>Please Join Document</p>
<p>Thank you</p>
</body>
</html>
