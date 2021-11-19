<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <title>Футбольные клубы</title>
</head>
<body>
<div class="container">
    <div class="menu">
        <div class="box box--radius0">
            <div class="menu__inner">
                <a class="button menu__item button--theme-orange" href="/clubs/{{$club->id}}/edit">Редактировать</a>
                <form class="form menu__item" action="/clubs/{{$club->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="form__button button  button--theme-red" href="/clubs/{{$club->id}}/edit">Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="club-info">
        <div class="box box--radius0">
            <div class="club-info__inner">
                <div class="club-info__top">
                    @if($club->logo)
                        <div class="club-info__logo">
                            <img class="img" src="{{asset($club->logo)}}" alt="логотип">
                        </div>
                    @endif
                    <h2 class="club-info__title title title--XL">{{$club->name}}</h2>
                </div>
                <div class="club-info__content">
                    <div class="club-info__title title title--M">Информация о клубе</div>
                    <div class="club-info__param">Страна: {{$club->country}}</div>
                    <div class="club-info__param">Год основания: {{$club->year}}</div>
                    <div class="club-info__param">
                        Глава клуба:
                        @if ($club->club_head)
                            {{$club->club_head->first_name . ' ' . $club->club_head->last_name}}
                        @endif
                    </div>
                </div>
                <a href="/" class="link club-info__link">Назад</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
