<x-guest-layout>
    <h1 class="text-3xl font-bold mb-4 dark:text-slate-100">Cadastrar buffet</h1>
    <div class="text-white">
        <p>1º Dados do administrador</p>
        <p>2º Dados do buffet</p>
        <p class="text-red-400">3º Escolha do plano</p>
    </div>
    <form method="POST" action="{{ route('auth.store-buffet') }}" id="form">
        @csrf

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>