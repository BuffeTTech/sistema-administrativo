<x-app-layout>
    <h1>Criar Nosso Comercial</h1>
    <div>
        <form method="POST" action="{{ route('commercial.store') }}">
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
                <x-input-label for="document_type" :value="__('Documento')" />
                <select name="document_type" id="document_type">
                    <option value="CPF">CPF</option>
                    <option value="CNPJ">CNPJ</option>
                </select>
                <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
            </div>
            
            <div>
                <x-input-label for="document" :value="__('Documento')" />
                <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="old('document')" required autofocus autocomplete="document" />
                <x-input-error :messages="$errors->get('document')" class="mt-2"/>
                <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="document-error"></span>
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
    <script>
        const doc = document.querySelector("#document")
        const doc_type = document.querySelector("#document_type")
        const doc_error = document.querySelector("#document-error")

        doc.addEventListener('input', (e)=>{
            if(doc_type.value === 'CPF') {
                e.target.value = replaceCPF(e.target.value);
                return;
            }
            if(doc_type.value === "CNPJ") {
                e.target.value = replaceCNPJ(e.target.value);
                return;
            }
        })

        doc.addEventListener('focusout', (e)=>{
            if(doc_type.value === 'CPF') {
                const cpf_valid = validarCPF(doc.value)
                if(!cpf_valid) {
                    doc_error.innerHTML = "Documento inválido"
                    return
                }
                doc_error.innerHTML = ""
                return;
            }
            if(doc_type.value === "CNPJ") {
                const cnpj_valid = validarCNPJ(doc.value)
                if(!cnpj_valid) {
                    doc_error.innerHTML = "Documento inválido"
                    return
                }
                doc_error.innerHTML = ""
                return;
            }
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
        function replaceCNPJ(value) {
            return value
                .replace(/\D+/g, '') // não deixa ser digitado nenhuma letra
                .replace(/(\d{2})(\d)/, '$1.$2') // captura 2 grupos de número o primeiro com 2 digitos e o segundo de com 3 digitos, apos capturar o primeiro grupo ele adiciona um ponto antes do segundo grupo de número
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1/$2') // captura 2 grupos de número o primeiro e o segundo com 3 digitos, separados por /
                .replace(/(\d{4})(\d)/, '$1-$2')
                .replace(/(-\d{2})\d+?$/, '$1') // captura os dois últimos 2 números, com um - antes dos dois números
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

        function validarCNPJ(cnpj) {
            cnpj = cnpj.replace(/[^\d]/g, '');

            if (cnpj.length !== 14) {
                return false;
            }

            if (/^(\d)\1+$/.test(cnpj)) {
                return false;
            }

            let tamanho = cnpj.length - 2;
            let numeros = cnpj.substring(0, tamanho);
            const digitos = cnpj.substring(tamanho);
            let soma = 0;
            let pos = tamanho - 7;

            for (let i = tamanho; i >= 1; i--) {
                soma += parseInt(numeros.charAt(tamanho - i)) * pos--;
                if (pos < 2) {
                    pos = 9;
                }
            }

            let resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);

            if (resultado !== parseInt(digitos.charAt(0))) {
                return false;
            }

            tamanho += 1;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;

            for (let i = tamanho; i >= 1; i--) {
                soma += parseInt(numeros.charAt(tamanho - i)) * pos--;
                if (pos < 2) {
                    pos = 9;
                }
            }

            resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);

            if (resultado !== parseInt(digitos.charAt(1))) {
                return false;
            }

            return true;
        }
    </script>
</x-app-layout>
