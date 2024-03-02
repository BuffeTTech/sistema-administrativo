<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Cadastrar buffet</h1>
                    <form method="POST" action="{{ route('buffet.store') }}" id="form">
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
                            <x-text-input placeholder="Insira o nome do administrador" id="name" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="name" :value="old('name')" required autofocus/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-2">
                            <x-input-label for="email" :value="__('Email*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o e-mail do administrador" id="email" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="email" name="email" :value="old('email')" required/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="document_type" :value="__('Tipo de documento')" class="dark:text-slate-800"/>
                            <x-select name="document_type" id="document_type" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500">
                                <option value="CPF">CPF</option>
                                <option value="CNPJ">CNPJ</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="document" :value="__('Documento*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o documento do administrador" id="document" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="document" :value="old('document')" required autofocus/>
                            <x-input-error :messages="$errors->get('document')" class="mt-2"/>
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="document-error"></span>
                        </div>
                        
                        <div class="mt-2">
                            <x-input-label for="phone1" :value="__('Telefone 1*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o primeiro telefone do administrador" id="phone1" class="phones block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone1" :value="old('phone1')" required autofocus/>
                            <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="phone2" :value="__('Telefone')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o segundo telefone do administrador" id="phone2" class="phones block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone2" :value="old('phone2')" autofocus/>
                            <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
                        </div>
                        <h2 class="text-xl font-semibold mb-3 mt-3">Dados do buffet</h2>

                        <div class="mt-2">
                            <x-input-label for="trading_name" :value="__('Nome comercial*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o nome comercial do buffet" id="trading_name" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="trading_name" :value="old('trading_name')" required autofocus/>
                            <x-input-error :messages="$errors->get('trading_name')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="email_buffet" :value="__('E-mail comercial*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o e-mail comercial do buffet" id="email_buffet" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="email" name="email_buffet" :value="old('email_buffet')" required autofocus/>
                            <x-input-error :messages="$errors->get('email_buffet')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="document_buffet" :value="__('Documento do buffet*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o documento do buffet" id="document_buffet" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="document_buffet" :value="old('document_buffet')" required autofocus/>
                            <x-input-error :messages="$errors->get('document_buffet')" class="mt-2" />
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="document_buffet-error"></span>
                            <x-input-helper>Insira o CNPJ</x-helper-input>
                        </div>
                        <div class="mt-2">
                            <x-input-label for="slug" :value="__('Slug*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o slug do buffet" id="slug" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="slug" :value="old('slug')" required autofocus />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            <x-input-helper>Será o link de acesso do buffet, como por exemplo nossosistema.com/seu-buffet</x-helper-input>
                        </div>
                        <div class="mt-2">
                            <x-input-label for="zipcode" :value="__('CEP*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o CEP do buffet" id="zipcode" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="zipcode" :value="old('zipcode')" required autofocus />
                            <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="zipcode-error"></span>
                        </div>
                        <div class="mt-2">
                            <x-input-label for="street" :value="__('Logradouro*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira a rua do buffet" id="street" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="street" :value="old('street')" required autofocus readonly aria-readonly />
                            <x-input-error :messages="$errors->get('street')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="neighborhood" :value="__('Bairro*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o bairro do buffet" id="neighborhood" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="neighborhood" :value="old('neighborhood')" required autofocus readonly aria-readonly />
                            <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="state" :value="__('Estado*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o estado do buffet" id="state" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="state" :value="old('state')" required autofocus readonly aria-readonly />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="city" :value="__('Cidade*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira a cidade do buffet" id="city" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="city" :value="old('city')" required autofocus readonly aria-readonly />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="number" :value="__('Número*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o número do buffet" id="number" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="number" name="number" :value="old('number')" required autofocus />
                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="complement" :value="__('Complemento')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o complemento do endereço do buffet" id="complement" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="complement" :value="old('complement')" autofocus/>
                            <x-input-error :messages="$errors->get('complement')" class="mt-2" />
                        </div>
                        <input type="hidden" name="country" value="Brazil">
                        <div class="mt-2">
                            <x-input-label for="phone1_buffet" :value="__('Telefone 1*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Primeiro telefone de contato do buffet" id="phone1_buffet" class="phones block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone1_buffet" :value="old('phone1_buffet')" required autofocus/>
                            <x-input-error :messages="$errors->get('phone1_buffet')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="phone2_buffet" :value="__('Telefone')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Segundo telefone de contato do buffet" id="phone2_buffet" class="phones block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone2_buffet" :value="old('phone2_buffet')" autofocus/>
                            <x-input-error :messages="$errors->get('phone2_buffet')" class="mt-2" />
                        </div>

                        <h2 class="text-xl font-semibold mb-3 mt-3">Dados do pacote</h2>
                        <div class="mt-2">
                            <x-input-label for="subscription" :value="__('Inscrição')" class="dark:text-slate-800"/>
                            <x-select name="subscription" id="subscription" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500">
                                @foreach($subscriptions as $subscription)
                                    @php
                                        $price = $subscription->price * ($subscription->price * ($subscription->discount/100));
                                    @endphp
                                    <option value="{{ $subscription->slug }}">{{ $subscription->name }}: R$ {{ $price == 0 ? $subscription->price : $price }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('subscription')" class="mt-2" />
                        </div>
                        {{-- <div class="mt-2">
                            <x-input-label for="subscription_format" :value="__('Formato de inscrição')" class="dark:text-slate-800"/>
                            <select name="subscription_format" id="subscription_format" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500">
                                <option value="month">Mensal</option>
                                <option value="quarterly">Trimestral</option>
                                <option value="year">Anual</option>
                            </select>
                            <x-input-error :messages="$errors->get('subscription_format')" class="mt-2" />
                        </div> --}}

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4" id="button">
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
        const phones = document.querySelectorAll('.phones')

        phones.forEach(phone => {
            phone.addEventListener('input', (e)=>{
                e.target.value = replacePhone(e.target.value);
                return;
            })
        });

        zipcode.addEventListener('input', async (e) => {
            e.target.value = replaceCEP(e.target.value)
        })

        zipcode.addEventListener('focusout', async (e) => {
            try {
                const cep = e.target.value.replace(/\D/g, '');

                const response = await fetch(`http://viacep.com.br/ws/${cep}/json/`)

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
                    street.value = ""
                    neighborhood.value = ""
                    state.value = ""
                    city.value = ""
                }
                console.log(error)
            }
        });
    </script>
    <script>
        const doc = document.querySelector("#document")
        const doc_type = document.querySelector("#document_type")
        const doc_error = document.querySelector("#document-error")
        const doc_buffet_error = document.querySelector("#document_buffet-error")
        const document_buffet = document.querySelector("#document_buffet")
        const form = document.querySelector("#form")
        form.addEventListener('submit', async function (e) {
            e.preventDefault()

            if(doc_type.value === 'CPF') {
                const owner_document_valid = validarCPF(doc.value)
                if(!owner_document_valid){
                    error("O documento do administrador é invalido")
                    return;
                }
            }
            if(doc_type.value === "CNPJ") {
                const owner_document_valid = validarCNPJ(doc.value)
                if(!owner_document_valid){
                    error("O documento do administrador é invalido")
                    return;
                }
            }

            const buffet_document_valid = validarCNPJ(document_buffet.value)
            if(!buffet_document_valid){
                error("O documento do buffet é invalido")
                return;
            }

            const userConfirmed = await confirm(`Deseja cadastrar este representante?`)

            if(userConfirmed) {
                this.submit();
            }
        })

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

        document_buffet.addEventListener('input', (e)=>{
            e.target.value = replaceCNPJ(e.target.value);
            return;
        })
        document_buffet.addEventListener('focusout', (e)=>{
            const cnpj_valid = validarCNPJ(e.target.value)
            if(!cnpj_valid) {
                doc_buffet_error.innerHTML = "Documento inválido"
                button.disabled = true;
                return
            }
            button.disabled = false;
            doc_buffet_error.innerHTML = ""
            return;
        })
        
        doc.addEventListener('focusout', (e)=>{
            if(doc_type.value === 'CPF') {
                const cpf_valid = validarCPF(doc.value)
                if(!cpf_valid) {
                    button.disabled = true;
                    doc_error.innerHTML = "Documento inválido"
                    return
                }
                doc_error.innerHTML = ""
                button.disabled = false;
                return;
            }
            if(doc_type.value === "CNPJ") {
                const cnpj_valid = validarCNPJ(doc.value)
                if(!cnpj_valid) {
                    button.disabled = true;
                    doc_error.innerHTML = "Documento inválido"
                    return
                }
                doc_error.innerHTML = ""
                button.disabled = false;
                return;
            }
        })

        doc_type.addEventListener('change', (e)=>{
            doc.value = ""
        })
    </script>
</x-app-layout>
