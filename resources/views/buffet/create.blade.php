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
                <x-input-label for="document" :value="__('Documento')" />
                <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="old('document')" required autofocus autocomplete="document" />
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
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
                <x-input-label for="phone1" :value="__('Telefone')" />
                <x-text-input id="phone1" class="block mt-1 w-full" type="text" name="phone1" :value="old('phone1')" required autofocus autocomplete="phone1" />
                <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="phone2" :value="__('Telefone')" />
                <x-text-input id="phone2" class="block mt-1 w-full" type="text" name="phone2" :value="old('phone2')" required autofocus autocomplete="phone2" />
                <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="zipcode" :value="__('CEP')" />
                <x-text-input id="zipcode" class="block mt-1 w-full" type="text" name="zipcode" :value="old('zipcode')" required autofocus autocomplete="zipcode" />
                <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="street" :value="__('Logradouro')" />
                <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required autofocus autocomplete="street" readonly aria-readonly />
                <x-input-error :messages="$errors->get('street')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="neighborhood" :value="__('Bairro')" />
                <x-text-input id="neighborhood" class="block mt-1 w-full" type="text" name="neighborhood" :value="old('neighborhood')" required autofocus autocomplete="neighborhood" readonly aria-readonly />
                <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="state" :value="__('Estado')" />
                <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')" required autofocus autocomplete="state" readonly aria-readonly />
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="city" :value="__('Cidade')" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" readonly aria-readonly />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="number" :value="__('Número')" />
                <x-text-input id="number" class="block mt-1 w-full" type="text" name="number" :value="old('number')" required autofocus autocomplete="number" readonly aria-readonly />
                <x-input-error :messages="$errors->get('number')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="complement" :value="__('Complemento')" />
                <x-text-input id="complement" class="block mt-1 w-full" type="text" name="complement" :value="old('complement')" required autofocus autocomplete="complement" />
                <x-input-error :messages="$errors->get('complement')" class="mt-2" />
            </div>
            <input type="hidden" name="country" value="Brazil">
            {{-- <div>
                <x-input-label for="country" :value="__('country')" />
                <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required autofocus autocomplete="country" readonly aria-readonly />
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div> --}}


            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        const zipcode = document.querySelector('#zipcode');
        const street = document.querySelector('#street');
        const number = document.querySelector('#number');
        const complement = document.querySelector('#complement');
        const neighborhood = document.querySelector('#neighborhood');
        const state = document.querySelector('#state');
        const city = document.querySelector('#city');
        const country = document.querySelector('#country');

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
                street.value = responseCep.logradouro
                neighborhood.value = responseCep.bairro
                state.value = responseCep.uf
                city.value = responseCep.localidade

                // number.innerHTML = response
                // complement.innerHTML = response
                // country.innerHTML = response

            } catch(error) {
                if(error?.cep_error) {
                    alert(error.cep_error)
                }
                console.log(error)
            }
        });
    </script>
</x-app-layout>
