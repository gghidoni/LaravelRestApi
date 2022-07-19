<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/style.css">
    <title>Tuscany Leather API</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><a href="/{{$language}}/categories">TuscanyLeatherApi</a></div>

            <div class="lang">
                <a href="/it/{{$uri}}">IT</a>
                <a href="/en/{{$uri}}">EN</a>
            </div>
            
            
        </nav>
    </header>
    <section class="main">
        @yield('main-content')
    </section>
</body>
</html>