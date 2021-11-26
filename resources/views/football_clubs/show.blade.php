<x-app-layout>
    <div class="menu">
        <div class="box box--radius0">
            <div class="menu__inner">
                <a class="button menu__item button--theme-orange" href={{ route('edit', ['club' =>  $club->id]) }}>Редактировать</a>
                <form class="form menu__item" action={{ route('destroy', ['club' =>  $club->id]) }} method="post">
                    @method('DELETE')
                    @csrf
                    <button class="form__button button  button--theme-red" href="/clubs/{{$club->id}}/edit">Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>
    <x-club-info>
        <div class="club-info__top">
            @if($club->logo)
                <div class="club-info__logo">
                    <img class="img" src="{{asset($club->logo)}}" alt="логотип">
                </div>
            @endif
            <h2 class="club-info__title title title--XL">{{$club->name}}</h2>
        </div>
        <x-club-info__content>
            <div class="club-info__title title title--M">Информация о клубе</div>
            <div class="club-info__param">Страна: {{$club->country}}</div>
            <div class="club-info__param">Год основания: {{$club->year}}</div>
            <div class="club-info__param">
                Глава клуба:
                @if ($club->club_head)
                    {{$club->club_head->first_name . ' ' . $club->club_head->last_name}}
                @endif
            </div>
        </x-club-info__content>
        <a class="link club-info__link"  href={{ route('user.index', ['user' =>  $user]) }}>Назад</a>
    </x-club-info>
</x-app-layout>
