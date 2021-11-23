<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head></x-head>
<body>
<x-popup>
    <a class="popup__close" href={{route('index')}}>X</a>
    <form class="form" action={{route('store', ['club' => $club->id])}} method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <x-form__title>Добавить клуб</x-form__title>
        @include('football_clubs.form')
        <x-form__submit>Добавить</x-form__submit>
        @csrf
    </form>
</x-popup>
</body>
</html>
