<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    @yield('styles')
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
    <nav class="my-navbar">
        <a class="my-navbar-brand" href="/"></a>
    </nav>
</header>
<main>
    @yield('content')
</main>
@yield('scripts')
</body>
</html>
