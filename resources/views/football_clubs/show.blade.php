<x-app-layout>
    <div class="menu">
        <div class="box box--radius0">
            <div class="menu__inner">
                @if(Auth::user()->id==$club->user_id)
                    <a class="button menu__item button--theme-orange" href={{ route('edit', ['club' =>  $club->id]) }}>Редактировать</a>
                    @if(!$club->deleted_at)
                        <form class="form menu__item"
                              action={{ route('destroy', ['club' =>  $club->id]) }} method="post">
                            @method('DELETE')
                            @csrf
                            <button class="form__button button  button--theme-red">Удалить</button>
                        </form>
                    @endif
                @endif
                @if(Auth::user()->is_admin)
                    <form class="form menu__item"
                          action={{ route('admin.destroy', ['club' =>  $club->id]) }} method="post">
                        @method('DELETE')
                        @csrf
                        <button class="form__button button  button--theme-red">Удалить на всегда</button>
                    </form>
                @endif
                @if($club->deleted_at)
                    <a class="button menu__item button--theme-green"
                       href={{ route('restore', ['clubId' =>  $club->id]) }}>Восстановить</a>
                @endif
                <a class="button menu__item button--theme-green"
                   href={{route('match.create', ['clubId' =>  $club->id])}}>Добавить матч</a>
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
        <a class="link club-info__link" href={{ route('user.index', ['user' =>  $user]) }}>На основную</a>
    </x-club-info>
    <div class="matches">
        <h1 class="matches__title title title--M">Матчи - вспомогательные объекты</h1>
        @forelse($matches as $match)
            <div class="match">
                @if(Auth::user()->isFriend($match->user()))
                    <div class="box box--radius3 box--black-theme">
                        @else
                            <div class="box box--radius3">
                                @endif
                                <div class="match__inner">
                                    <div class="match__info">
                                        Стадион: {{$match->stadium}}
                                    </div>
                                    <div class="match__info">
                                        Дата игры: {{ $match->getDateGame()}}
                                    </div>
                                    <div class="match__info">
                                        Кто добавил: {{$match->user()->name}}
                                    </div>
                                </div>
                            </div>
                    </div>
                    @empty
                        <strong class="clubs-list__error">Не найдены матчи</strong>
                    @endforelse
            </div>
    </div>
</x-app-layout>
