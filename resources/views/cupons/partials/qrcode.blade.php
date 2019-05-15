<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<div class="visible-print text-center">

    {!! QrCode::size(500)->generate($hash); !!}

</div>

</body>
</html>
