<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Cadastrar buffet</h1>
                    <form method="POST" action="{{ route('commercial.store') }}">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h2 class="text-xl font-semibold mb-3">Dados do administrador</h2>
                        <!-- Name -->
                        <div class="mt-2">
                            <x-input-label for="name" :value="__('Nome*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o nome do administrador" id="name" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-2">
                            <x-input-label for="email" :value="__('Email*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o e-mail do administrador" id="email" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="document_type" :value="__('Tipo de Documento*')" class="dark:text-slate-800"/>
                            <select name="document_type" id="document_type">
                                <option value="CPF">CPF</option>
                                <option value="CNPJ">CNPJ</option>
                            </select>
                            <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
                        </div>
                        
                        <div class="mt-2">
                            <x-input-label for="document" :value="__('Documento*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o documento do administrador" id="document" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="document" :value="old('document')" required autofocus autocomplete="document" />
                            <x-input-error :messages="$errors->get('document')" class="mt-2"/>
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="document-error"></span>
                        </div>

                        <div class="mt-2">
                            <x-input-label for="phone1" :value="__('Telefone 1*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o primeiro telefone do administrador" id="phone1" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone1" :value="old('phone1')" required autofocus autocomplete="phone1" />
                            <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="phone2" :value="__('Telefone')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o segundo telefone do administrador" id="phone2" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone2" :value="old('phone2')" autofocus autocomplete="phone2" />
                            <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
                        </div>
                        <h2 class="text-xl font-semibold mb-3 mt-3">Dados do buffet</h2>

                        <div class="mt-2">
                            <x-input-label for="zipcode" :value="__('CEP*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o CEP do buffet" id="zipcode" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="zipcode" :value="old('zipcode')" required autofocus autocomplete="zipcode" />
                            <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="zipcode-error"></span>
                        </div>
                        <div class="mt-2">
                            <x-input-label for="street" :value="__('Logradouro*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira a rua do buffet" id="street" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="street" :value="old('street')" required autofocus autocomplete="street" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('street')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="neighborhood" :value="__('Bairro*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o bairro do buffet" id="neighborhood" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="neighborhood" :value="old('neighborhood')" required autofocus autocomplete="neighborhood" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="state" :value="__('Estado*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o estado do buffet" id="state" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="state" :value="old('state')" required autofocus autocomplete="state" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="city" :value="__('Cidade*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira a cidade do buffet" id="city" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="number" :value="__('Número*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o número do buffet" id="number" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="number" name="number" :value="old('number')" required autofocus autocomplete="number" />
                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="complement" :value="__('Complemento*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o complemento do endereço do buffet" id="complement" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="complement" :value="old('complement')" required autofocus autocomplete="complement" />
                            <x-input-error :messages="$errors->get('complement')" class="mt-2" />
                        </div>
                        <input type="hidden" name="country" value="Brazil">
                        <div class="mt-2">
                            <x-input-label for="phone1-buffet" :value="__('Telefone 1*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Primeiro telefone de contato do buffet" id="phone1-buffet" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone1-buffet" :value="old('phone1-buffet')" required autofocus autocomplete="phone1-buffet" />
                            <x-input-error :messages="$errors->get('phone1-buffet')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="phone2-buffet" :value="__('Telefone')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Segundo telefone de contato do buffet" id="phone2-buffet" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone2-buffet" :value="old('phone2-buffet')" autofocus autocomplete="phone2-buffet" />
                            <x-input-error :messages="$errors->get('phone2-buffet')" class="mt-2" />
                        </div>
                        {{-- <div>
                            <x-input-label for="country" :value="__('country')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="" id="country" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="country" :value="old('country')" required autofocus autocomplete="country" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div> --}}


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Cadastrar Buffet') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const zipcode = document.querySelector('#zipcode');
        const street = document.querySelector('#street');
        const neighborhood = document.querySelector('#neighborhood');
        const state = document.querySelector('#state');
        const city = document.querySelector('#city');
        const zipcode_error = document.querySelector("#zipcode-error")

        // const number = document.querySelector('#number');
        // const complement = document.querySelector('#complement');
        // const country = document.querySelector('#country');

        function formatarCEP(cep) {
            cep = cep.replace(/\D/g, '');
            cep = cep.slice(0, 8);
            return cep.replace(/(\d{5})(\d{3}).*$/, '$1-$2');
        }

        zipcode.addEventListener('input', async (e) => {
            e.target.value = formatarCEP(e.target.value)
        })

        zipcode.addEventListener('focusout', async (e) => {
            try {
                const onlyNumbers = /^[0-9]+$/;
                const cepValid = /^[0-9]{8}$/;

                if(!onlyNumbers.test(zipcode.value) || !cepValid.test(zipcode.value)) {
                    throw {cep_error: 'CEP inválido'}
                }

                const response = await fetch(`http://viacep.com.br/ws/${zipcode.value}/json/`)

                const responseCep = await response.json()

                if(responseCep?.erro) {
                    throw {cep_error: 'CEP inválido'}
                }
                zipcode_error.innerHTML = ""
                street.value = responseCep.logradouro
                neighborhood.value = responseCep.bairro
                state.value = responseCep.uf
                city.value = responseCep.localidade

                // number.innerHTML = response
                // complement.innerHTML = response
                // country.innerHTML = response

            } catch(error) {
                if(error?.cep_error) {
                    zipcode_error.innerHTML = error.cep_error
                }
                console.log(error)
            }
        });
    </script>
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
