<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<div id="container">

    <img width="500px" src="https://res.cloudinary.com/tesseract/image/upload/v1553214101/vestylle-webapi/logo.svg" alt="">
    {!! QrCode::size(500)->generate($valorQRCode); !!}

</div>

<style>
#container {
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
}

</style>
</body>
</html>
