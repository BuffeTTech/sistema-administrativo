<x-app-layout>
    <div>
        <form method="POST" action="{{ route('commercial.update', ['commercial'=>$commercial->id]) }}">
            @csrf
            @method('put')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$commercial->user->name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$commercial->user->email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="document" :value="__('Documento')" />
                <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="$commercial->user->document" required autofocus autocomplete="document" />
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
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
                <option value="{{$value}}" {{ $commercial->user->document_type == $value ? 'selected' : ""}}>{{$key}}</option>
                @endforeach
                <!-- <option value="invalid2"  disabled>Nenhum horario disponivel neste dia, tente novamente!</option> -->
                </select>
                <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
            </div>
            
            <div>
                <x-input-label for="phone1" :value="__('Telefone 1')" />
                <x-text-input id="phone1" class="block mt-1 w-full" type="text" name="phone1" :value="$commercial->user->user_phone1->number ?? ''" required autofocus autocomplete="phone1" />
                <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="phone2" :value="__('Telefone 2')" />
                <x-text-input id="phone2" class="block mt-1 w-full" type="text" name="phone2" :value="$commercial->user->user_phone2->number ?? null" autofocus autocomplete="phone2" />
                <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
