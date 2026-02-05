<!doctype html>
<html lang="hr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Moja aplikacija')</title>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <header class="site-header">
    <div class="container header-inner">
      <a class="logo" href="{{ url('/') }}">Moja Aplikacija</a>

      <nav class="nav">
        <a href="{{ url('/') }}" class="nav-link {{ request()->routeIs('home') ? 'active':''}}">Početna</a>
        <a href="{{ route('studenti.index') }}" class="nav-link {{ request()->routeIs('studenti.index') ? 'active':''}}">Studenti</a>
        <a href="{{ route('fakulteti.index') }}" class="nav-link {{ request()->routeIs('fakulteti.index') ? 'active':''}}">Fakulteti</a>
        <a href="{{ route('about.index') }}" class="nav-link {{ request()->routeIs('about.index') ? 'active':''}}">About</a>
      </nav>
    </div>
  </header>

  <main class="site-main">
    <div class="container">
      <h1 class="page-title">@yield('page_title', 'Naslov stranice')</h1>

      <div class="card">
        @yield('content')
      </div>
    </div>
  </main>

  <footer class="site-footer">
    <div class="container footer-inner">
      <span>© {{ date('Y') }} Vježba i ponavljanje</span>
      <span class="footer-muted">
        Okolina: {{ app()->environment() }} |
        DB: {{ config('database.connections.mysql.database') }}
      </span>
    </div>
  </footer>

</body>
</html>