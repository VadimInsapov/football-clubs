<x-app-layout>
    <x-header>Список пользователей</x-header>
    <div class="users-list">
        @forelse($users as $user)
            <x-user>
                <a class="link" href={{route('user.index', ['user' => $user->name])}}>{{$user->name}}</a>
                @if($user->is_admin)
                    - администратор
                @endif
                <x-slot name="extra"></x-slot>
            </x-user>
        @empty
            <strong class="clubs-list__error">Не найдены футбольные клубы</strong>
        @endforelse
    </div>
</x-app-layout>
