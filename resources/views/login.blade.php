<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('auth.ecommerceLogin')</title>
    @vite([
    'resources/sass/app.scss',
])

</head>
<body class="bg-white">


<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <form action="{{ route('login') }}" class="login p-3 needs-validation rounded-1 shadow" method="post" novalidate>
        <div class="login__image d-flex justify-content-center mb-3">
            <img src="/assets/logo-black.png" loading="lazy" alt="Ecommerce Analytics" height="55"/>
        </div>

        @csrf
        <div >
            <label for="validationEmail" class="form-label">@lang("auth.mail")</label>
            <input type="email" class="form-control rounded-0" id="validationEmail" name="email" value="{{ old('email', '') }}" placeholder="@lang('auth.templateEmail')" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="mt-2">
            <label for="validationPassword" class="form-label">@lang("auth.passwordName")</label>
            <input type="password" class="form-control rounded-0" name="password" id="validationPassword" value="{{ old('password', '') }}" placeholder="@lang('auth.templatePassword')" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <div class="col-12 mt-2">
            <button class="btn btn-dark" type="submit">@lang("auth.logIn")</button>
        </div>
    </form>
</div>

</body>
</html>
