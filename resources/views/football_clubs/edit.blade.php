<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head></x-head>
<body>
<x-popup>
    <a class="popup__close"  href={{ route('user.index', ['user' =>  $user]) }}>X</a>
    <form class="form" action={{route('update', ['club' => $club->id])}} method="post" enctype="multipart/form-data">
        @method('PATCH')
        {{csrf_field()}}
        <x-form__title>Редактировать клуб</x-form__title>
        @include('football_clubs.form')
        <x-form__submit>Сохранить</x-form__submit>
        @csrf
    </form>
</x-popup>
</body>
</html>
