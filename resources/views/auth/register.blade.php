<x-guest-layout>
    <h1 class="text-3xl font-bold mb-4 dark:text-slate-100">Cadastrar buffet</h1>
    <div class="text-white">
        <p class="text-red-400">1º Dados do administrador</p>
        <p>2º Dados do buffet</p>
        <p>3º Escolha do plano</p>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name*')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nome do administrador"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email*')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="E-mail do administrador"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Document -->
        <div class="mt-4">
            <x-input-label for="document" :value="__('Documento*')" />
            <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="old('document')" required autofocus autocomplete="document" placeholder="Documento do administrador"/>
            <x-input-error :messages="$errors->get('document')" class="mt-2" />
            {{-- <x-input-helper>Insira o CPF</x-helper-input> --}}
            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="document-error"></span>
        </div>

        <div class="mt-4">
            <x-input-label for="phone1" :value="__('Telefone*')" />
            <x-text-input id="phone1" class="block mt-1 w-full" type="text" name="phone1" :value="old('phone1')" required autofocus autocomplete="phone1" placeholder="Telefone do administrador"/>
            <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        const doc = document.querySelector("#document")
        const doc_type = document.querySelector("#document_type")
        const doc_error = document.querySelector("#document-error")

        doc.addEventListener('input', (e)=>{
            e.target.value = replaceCPF(e.target.value);
            return;
        })

        doc.addEventListener('focusout', (e)=>{
            const cpf_valid = validarCPF(doc.value)
            if(!cpf_valid) {
                doc_error.innerHTML = "Documento inválido"
                return
            }
            doc_error.innerHTML = ""
            return;
        })

        doc_type.addEventListener('change', (e)=>{
            doc.value = ""
        })

        function replaceCPF(value) {
            return value
                .replace(/\D/g, '') // substitui qualquer caracter que nao seja numero por nada
                .replace(/(\d{3})(\d)/, '$1.$2') // captura 2 grupos de numero o primeiro de 3 e o segundo de 1, apos capturar o primeiro grupo ele adiciona um ponto antes do segundo grupo de numero
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})/, '$1-$2')
                .replace(/(-\d{2})\d+?$/, '$1') // captura 2 numeros seguidos de um traço e não deixa ser digitado mais nada
        }
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, '');

            if (cpf.length !== 11) {
                return false;
            }

            if (/^(\d)\1+$/.test(cpf)) {
                return false;
            }

            let soma = 0;
            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let digito1 = 11 - (soma % 11);
            digito1 = (digito1 >= 10) ? 0 : digito1;

            if (parseInt(cpf.charAt(9)) !== digito1) {
                return false;
            }

            soma = 0;
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            let digito2 = 11 - (soma % 11);
            digito2 = (digito2 >= 10) ? 0 : digito2;

            if (parseInt(cpf.charAt(10)) !== digito2) {
                return false;
            }

            return true;
        }
    </script>
</x-guest-layout>
