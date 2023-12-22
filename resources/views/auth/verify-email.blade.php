<x-guest-layout>
    <h1 class="text-3xl font-bold mb-4 dark:text-slate-100">Cadastrar buffet</h1>
    <div class="text-white">
        <p class="text-red-400">1º Dados do administrador</p>
        <p>2º Dados do buffet</p>
        <p>3º Escolha do plano</p>
    </div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        <p>Obrigado por se cadastrar!</p>
        <p>Para começar, acesse seu e-mail e clique no link para ativar sua conta.</p>
        <p>Caso não tenha recebido clique no link abaixo para que possamos reenvia-lo.</p>
        <p>Caso entre em outro navegador, acesse nosso site principal através <a href="{{route('login')}}" target="_blank" class="text-white">desse link</a> com a senha enviada no e-mail para poder confirmar a conta.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Um novo e-mail de confirmação foi enviado para seu e-mail de registro') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Reenviar confirmação de e-mail') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Sair') }}
            </button>
        </form>
    </div>
</x-guest-layout>
