<x-app-layout>
    <x-header>Все матчи (тех, на кого подписан)</x-header>
    <div class="matches">
        @forelse($matches as $match)
            <div class="match">
                <div class="box box--radius3 box--black-theme">
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
</x-app-layout>
