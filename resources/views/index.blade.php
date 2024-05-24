<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/assets/logo.ico" type="image/x-icon" >
    <title>{{ config('app.name') }}</title>
</head>
<body>
<div id="app" class="dashboard d-flex"></div>

<div style="display: none" data-lang-content>
@json(__('content'))
</div>
</body>
@vite([
    'resources/sass/app.scss',
    'resources/js/app.js',
])
</html>
