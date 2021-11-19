<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}">
    {{--        <link rel="stylesheet" href="css/reset.css">--}}
    {{--        <link rel="stylesheet" href="css/style.css">--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <title>Футбольные клубы</title>
</head>
<body>
<div class="container">
    <header class="header">
        <h1 class="header__title title title--L">Список футбольных клубов</h1>
    </header>
    <div class="menu">
        <div class="box box--radius3">
            <div class="menu__inner">
                <a class="button menu__item button--theme-green" href="/clubs/create">Добавить клуб</a>
            </div>
        </div>
    </div>
    <div class="clubs-list">
        @forelse($clubs as $club)
            <div class="club">
                <div class="box">
                    <div class="club__inner">
                        @if ($club->logo)
                        <div class="club__logo">
                            <img class="img" src="{{asset($club->logo)}}" alt="логотип">
                        </div>
                        @endif
                        <div class="club__info">
                            <div class="club__title title title--M">
                                <a class="link" href="/clubs/{{$club->id}}">{{$club->name}}</a>
                            </div>
                            <div class="club__param">Страна: {{$club->name}}</div>
                            <div class="club__param">Год основания: {{$club->year}}</div>
                            <div class="club__param"> Глава клуба:
                                @if ($club->club_head) {{$club->club_head->first_name . ' ' . $club->club_head->last_name}} @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <strong class="football-club-card__error">Не найдены футбольные клубы</strong>
        @endforelse
    </div>
</div>
</body>
</html>
