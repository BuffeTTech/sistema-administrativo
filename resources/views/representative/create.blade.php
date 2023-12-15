<x-app-layout>
    <h1>Criar Representante</h1>
    <div>
        <form method="POST" action="{{ route('representative.store') }}">
            @csrf

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="document" :value="__('Documento')" />
                <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="old('document')" required autofocus autocomplete="document" />
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="document_type" :value="__('Documento')" />
                <select name="document_type" id="document_type">
                    <option value="cpf">CPF</option>
                    <option value="cnpj">CNPJ</option>
                </select>
                <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="phone1" :value="__('Telefone')" />
                <x-text-input id="phone1" class="block mt-1 w-full" type="text" name="phone1" :value="old('phone1')" required autofocus autocomplete="phone1" />
                <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
