<x-guest-layout>
    <h1 class="text-3xl font-bold mb-4 dark:text-slate-100">Cadastrar buffet</h1>
    <div class="text-white">
        <p>1º Dados do administrador</p>
        <p>2º Dados do buffet</p>
        <p class="text-red-400">3º Escolha do plano</p>
    </div>
    <form method="POST" action="{{ route('auth.buffet.select_subscription') }}" id="form">
        @csrf
        <input type="hidden" name="buffet" value="{{ $buffet->slug }}">
        <div>
            <x-input-label for="subscription" :value="__('Inscrição')" />
            <select name="subscription" id="subscription">
                @foreach($subscriptions as $subscription)
                    @php
                        $price = $subscription->price * ($subscription->price * ($subscription->discount/100));
                    @endphp
                    <option value="{{ $subscription->slug }}">{{ $subscription->name }}: R$ {{ $price == 0 ? $subscription->price : $price }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('subscription')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Cadastrar Buffet') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>