<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Representantes Comerciais') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Cadastrar Representante Comercial</h1>
                    <form method="POST" action="{{ route('representative.store') }}" id="form">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nome')" class="dark:text-slate-800"/>
                            <x-text-input id="name" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="name" :value="old('name')" required autofocus placeholder="Nome"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-2">
                            <x-input-label for="email" :value="__('Email')" class="dark:text-slate-800"/>
                            <x-text-input id="email" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="email" name="email" :value="old('email')" required placeholder="E-mail"/>
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
                            <x-input-label for="document" :value="__('Documento')" class="dark:text-slate-800"/>
                            <x-text-input id="document" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="document" :value="old('document')" required autofocus placeholder="Documento"/>
                            <x-input-error :messages="$errors->get('document')" class="mt-2"/>
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="document-error"></span>
                        </div>

                        <div class="mt-2">
                            <x-input-label for="phone1" :value="__('Telefone')" class="dark:text-slate-800"/>
                            <x-text-input id="phone1" class="phones block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="phone1" :value="old('phone1')" required autofocus onkeypress="mascaraMutuario(this,cpfCnpj)" placeholder="Telefone"/>
                            <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4" id="button">
                                {{ __('Cadastrar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const doc = document.querySelector("#document")
        const doc_type = document.querySelector("#document_type")
        const doc_error = document.querySelector("#document-error")
        const form = document.querySelector("#form")
        const phones = document.querySelectorAll('.phones')

        phones.forEach(phone => {
            phone.addEventListener('input', (e)=>{
                e.target.value = replacePhone(e.target.value);
                return;
            })
        });
        const button = document.querySelector("#button");

        form.addEventListener('submit', async function (e) {
            e.preventDefault()
            if(doc_type.value === 'CPF') {
                const cpf_valid = validarCPF(doc.value)
                if(!cpf_valid) {
                    error('Documento inválido')
                    return
                }
            }
            if(doc_type.value === "CNPJ") {
                const cnpj_valid = validarCNPJ(doc.value)
                if(!cnpj_valid) {
                    error('Documento inválido')
                    return
                }
            }

            const userConfirmed = await confirm(`Deseja cadastrar este representante?`)

            if (userConfirmed) {
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
