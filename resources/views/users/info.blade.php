<x-app-layout>
    <x-header>Токен пользователя</x-header>
    <x-club>
        <x-club__info>
            <x-slot name="title">{{$token}}</x-slot>
            <x-slot name="user"></x-slot>
        </x-club__info>
    </x-club>
</x-app-layout>
