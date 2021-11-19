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

<div class="popup" id="popup">
    <div class="popup__body">
        <div class="box box--radius3">
            <div class="popup__content">
                <a class="popup__close" href="/clubs">X</a>
                <form class="form" action="/clubs" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h2 class="form__title">Добавить клуб</h2>
                    @include('football_clubs.form')
                    <div class="form__submit-block">
                        <button class="button button--theme-gray button--w-70">Добавить</button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
