<x-app-layout>
    <x-header>Список футбольных клубов</x-header>
    @can('add-club', $currentUser)
        <x-menu>
            <a class="button menu__item button--theme-green" href={{route('create')}}>Добавить клуб</a>
        </x-menu>
    @endcan
    <div class="clubs-list">
        @forelse($clubs as $club)
            <x-club>
                @if ($club->logo)
                    <x-club__logo>
                        <img class="img" src="{{asset($club->logo)}}" alt="логотип">
                    </x-club__logo>
                @endif
                <x-club__info>
                    <x-slot name="title"><a class="link" href={{route('show', ['clubId' => $club->id])}}>{{$club->name}}</a></x-slot>
                    <div class="club__param">Страна: {{$club->name}}</div>
                    <div class="club__param">Год основания: {{$club->year}}</div>
                    <div class="club__param">
                        Глава клуба:
                        @if ($club->club_head) {{$club->club_head->first_name . ' ' . $club->club_head->last_name}}
                        @endif
                    </div>
                    <x-slot  name="user">{{$club->userName}}</x-slot>
                @if ($club->deleted_at)
                        <div class="club__param club__param-important">Объект мягко удален</div>
                    @endif
                </x-club__info>
            </x-club>
        @empty
            <strong class="clubs-list__error">Не найдены футбольные клубы</strong>
        @endforelse
    </div>
</x-app-layout>
