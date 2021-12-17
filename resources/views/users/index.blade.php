<x-app-layout>
    <x-header>Список пользователей</x-header>
    <div class="users-list">
        @forelse($users as $user)
            <x-user>
                <a class="link" href={{route('user.index', ['user' => $user->name])}}>{{$user->name}}</a>
                @if($user->is_admin)
                    <span class="title title--M">: admin</span>
                @endif
                <x-slot name="extra">
                    <div class="extra">
                        @if($user != Auth::user())
                            @if(!Auth::user()->isFriend($user))
                                <form class="form"
                                      action={{route('user.subscribe', ['userId' => $user->id])}} method="get">
                                    <button class="form__button button button--theme-green">ПОДПИСАТЬСЯ</button>
                                    <input type="hidden" value={{Auth::user()->isFriend($user)}}>
                                </form>
                            @else
                                <form class="form"
                                      action={{route('user.unsubscribe', ['userId' => $user->id])}} method="get">
                                    <button class="form__button button button--theme-red">Отписаться</button>
                                    <input type="hidden" value={{Auth::user()->isFriend($user)}}>
                                </form>
                            @endif
                        @else
                            <div class="title title--M">It's me</div>
                        @endif
                    </div>
                </x-slot>
            </x-user>
        @empty
            <strong class="clubs-list__error">Не найдены футбольные клубы</strong>
        @endforelse
    </div>
</x-app-layout>
