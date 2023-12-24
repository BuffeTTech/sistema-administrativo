<x-app-layout>
    <div>
        <form method="POST" action="{{ route('representative.update', ['representative'=>$representative->id]) }}" id="form">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @csrf
            @method('put')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$representative->user->name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$representative->user->email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="document" :value="__('Documento')" />
                <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="$representative->user->document" required autofocus autocomplete="document" />
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                <span class="text-sm text-red-600 dark:text-red-400 space-y-1" id="document-error"></span>
            </div>

            {{-- <div>
                <x-input-label for="document_type" :value="__('Documento')" />
                <select name="document_type" id="document_type">
                    <option value="cpf">CPF</option>
                    <option value="cnpj">CNPJ</option>
                </select>
                <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
            </div> --}}

            <div>
            <x-input-label for="document_type" :value="__('Documento')" />
             <select name="document_type" id="document_type">
                 @foreach( App\Enums\DocumentType::array() as $key => $value )
                <option value="{{$value}}" {{ $representative->user->document_type == $value ? 'selected' : ""}}>{{$key}}</option>
                @endforeach
                <!-- <option value="invalid2"  disabled>Nenhum horario disponivel neste dia, tente novamente!</option> -->
                </select>
                <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
            </div>
            
            <div>
                <x-input-label for="phone1" :value="__('Telefone 1')" />
                <x-text-input id="phone1" class="block mt-1 w-full" type="text" name="phone1" :value="$representative->user->user_phone1->number ?? ''" required autofocus autocomplete="phone1" />
                <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="phone2" :value="__('Telefone 2')" />
                <x-text-input id="phone2" class="block mt-1 w-full" type="text" name="phone2" :value="$representative->user->user_phone2->number ?? ''" autofocus autocomplete="phone2" />
                <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4" id="button">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    <script>
        const doc = document.querySelector("#document")
        const doc_type = document.querySelector("#document_type")
        const doc_error = document.querySelector("#document-error")
        const form = document.querySelector("#form")

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
            } else {
                error("Ocorreu um erro!")
                return;
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
    </script>
</x-app-layout>
