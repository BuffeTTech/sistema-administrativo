<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Cadastrar buffet</h1>
                    <form method="POST" action="{{ route('buffet.update', ['buffet'=>$buffet->slug]) }}" id="form">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @csrf
                        @method('put')

                        <h2 class="text-xl font-semibold mb-3 mt-3">Dados do buffet</h2>

                        <div class="mt-2">
                            <x-input-label for="trading_name" :value="__('Nome comercial*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o nome comercial do buffet" id="trading_name" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="trading_name" :value="$buffet->trading_name" required autofocus autocomplete="trading_name" />
                            <x-input-error :messages="$errors->get('trading_name')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="email_buffet" :value="__('E-mail comercial*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o e-mail comercial do buffet" id="email_buffet" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="email_buffet" :value="$buffet->email" required autofocus autocomplete="email_buffet" />
                            <x-input-error :messages="$errors->get('email_buffet')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="document_buffet" :value="__('Documento do buffet*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o documento do buffet" id="document_buffet" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="document_buffet" :value="$buffet->document" required autofocus autocomplete="document_buffet" />
                            <x-input-error :messages="$errors->get('document_buffet')" class="mt-2" />
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="document_buffet-error"></span>
                            <x-input-helper>Insira o CNPJ</x-helper-input>
                        </div>
                        <div class="mt-2">
                            <x-input-label for="slug" :value="__('Slug*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o slug do buffet" id="slug" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="slug" :value="$buffet->slug" required autofocus autocomplete="slug" />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            <x-input-helper>Será o link de acesso do buffet, como por exemplo nossosistema.com/seu-buffet</x-helper-input>
                        </div>
                        <div class="mt-2">
                            <x-input-label for="zipcode" :value="__('CEP*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o CEP do buffet" id="zipcode" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="zipcode" :value="$buffet->buffet_address->zipcode" required autofocus autocomplete="zipcode" />
                            <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="zipcode-error"></span>
                        </div>
                        <div class="mt-2">
                            <x-input-label for="street" :value="__('Logradouro*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira a rua do buffet" id="street" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="street" :value="$buffet->buffet_address->street" required autofocus autocomplete="street" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('street')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="neighborhood" :value="__('Bairro*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o bairro do buffet" id="neighborhood" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="neighborhood" :value="$buffet->buffet_address->neighborhood" required autofocus autocomplete="neighborhood" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="state" :value="__('Estado*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o estado do buffet" id="state" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="state" :value="$buffet->buffet_address->state" required autofocus autocomplete="state" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="city" :value="__('Cidade*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira a cidade do buffet" id="city" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="city" :value="$buffet->buffet_address->city" required autofocus autocomplete="city" readonly aria-readonly />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="number" :value="__('Número*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o número do buffet" id="number" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="number" name="number" :value="$buffet->buffet_address->number" required autofocus autocomplete="number" />
                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="complement" :value="__('Complemento')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Insira o complemento do endereço do buffet" id="complement" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="complement" :value="$buffet->buffet_address->complement" autofocus autocomplete="complement" />
                            <x-input-error :messages="$errors->get('complement')" class="mt-2" />
                        </div>
                        <input type="hidden" name="country" value="Brazil">
                        <div class="mt-2">
                            <x-input-label for="phone1_buffet" :value="__('Telefone 1*')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Primeiro telefone de contato do buffet" id="phone1_buffet" class="phones block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone1_buffet" :value="$buffet->buffet_phone1->number ?? ''" required autofocus autocomplete="phone1_buffet" />
                            <x-input-error :messages="$errors->get('phone1_buffet')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="phone2_buffet" :value="__('Telefone')" class="dark:text-slate-800"/>
                            <x-text-input placeholder="Segundo telefone de contato do buffet" id="phone2_buffet" class="phones block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone2_buffet" :value="$buffet->buffet_phone2->number ?? null" autofocus autocomplete="phone2_buffet" />
                            <x-input-error :messages="$errors->get('phone2_buffet')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4" id="button">
                                {{ __('Atualizar Buffet') }}
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
        const doc_buffet_error = document.querySelector("#document_buffet-error")
        const document_buffet = document.querySelector("#document_buffet")
        const form = document.querySelector("#form")
        form.addEventListener('submit', async function (e) {
            e.preventDefault()

            const buffet_document_valid = validarCNPJ(document_buffet.value)
            if(!buffet_document_valid){
                error("O documento do buffet é invalido")
                return;
            }

            const userConfirmed = await confirm(`Deseja atualizar este representante?`)

            if(userConfirmed) {
                this.submit();
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
        
    </script>
</x-app-layout>
