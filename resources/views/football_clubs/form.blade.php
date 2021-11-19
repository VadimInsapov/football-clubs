<div class="form__item">
    <label class="form__label" for="name" >Название</label>
    @error('name') <label class="error form__label" for="name" >{{ $message }}</label>@enderror
    <input class="form__input form__input--text form__input--focus" value = "{{ old('name') ?? $club->name }}" id="name" name="name" type="text" autocomplete="off">
</div>
<div class="form__item">
    <label class="form__label" for="country" >Страна</label>
    @error('country') <label class="error form__label" for="name" >{{ $message }}</label>@enderror
    <input class="form__input form__input--text form__input--focus" value = "{{ old('name') ?? $club->country}}" id="country" name="country" type="text" autocomplete="off">
</div>
<div class="form__item">
    <label class="form__label" for="header">Руководитель</label>
    @error('header') <label class="error form__label" for="header" >{{ $message }}</label>@enderror
    <input class="form__input form__input--text form__input--focus" value = "{{$club->club_head ? $club->club_head->first_name . ' ' . $club->club_head->last_name : old('header')}}" id="header" name="header" type="text" autocomplete="off">
</div>
<div class="form__item">
    <label class="form__label" for="date">Дата основания</label>
    @error('date') <label class="error form__label" for="date" >{{ $message }}</label>@enderror
    <input class="form__input" value = "{{ old('date') ?? $club->year . '-01-01'}}" id="date" name="date" type="date" autocomplete="off">
</div>
<div class="form__item">
    <label class="form__label" for="logo">Логотип</label>
    @error('logo') <label class="error form__label" for="logo" >{{ $message }}</label>@enderror
    <input class="form__input button" id="logo" name="logo" type="file">
</div>
