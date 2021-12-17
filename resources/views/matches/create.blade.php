<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head></x-head>
<body>
<x-popup>
    <a class="popup__close" href={{ route('user.index', ['user' =>  $user]) }}>X</a>
    <form class="form" action={{route('match.store', ['match' => $match->id, 'clubId' => $clubId])}} method="post"
          enctype="multipart/form-data">
        {{csrf_field()}}
        <x-form__title>Добавить матч</x-form__title>
        <div class="form__item">
            <label class="form__label" for="stadium">Стадион</label>
            @error('stadium') <label class="error form__label" for="stadium">{{ $message }}</label>@enderror
            <input class="form__input form__input--text form__input--focus"
                   value="{{ old('stadium') ?? $match->stadium }}" id="stadium" name="stadium" type="text"
                   autocomplete="off">
        </div>
        <div class="form__item">
            <label class="form__label" for="date">Дата проведения матча</label>
            @error('date') <label class="error form__label" for="date">{{ $message }}</label>@enderror
            <input class="form__input" value="{{ old('date') ?? $match->year . '-01-01'}}" id="date" name="date"
                   type="date" autocomplete="off">
        </div>
        <x-form__submit>Добавить</x-form__submit>
        @csrf
    </form>
</x-popup>
</body>
</html>
