<x-app-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Criar Planos</h1>
                    <form method="POST" action="{{ route('buffet.subscription.store') }}" id="form">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div>
                            <x-input-label for="name" :value="__('Nome')" class="dark:text-slate-800"/>
                            <x-text-input id="name" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="name" :value="old('name')" required autofocus  />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="slug" :value="__('Slug')" class="dark:text-slate-800"/>
                            <x-text-input id="slug" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="slug" :value="old('slug')" required />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            <x-input-helper>Será o link de acesso do pacote e o prefixo da role criada</x-helper-input>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Descrição')" class="dark:text-slate-800"/>
                            <x-textarea name="description" id="description" cols="30" rows="10" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500">{{old('description')}}</x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Preço')" class="dark:text-slate-800"/>
                            <x-text-input id="price" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="number" name="price" :value="old('price')" required step="0.01" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Cadastrar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const description = document.querySelector('#description');
        const form = document.querySelector("#form")

        ClassicEditor
            .create(description)
            .catch(error => {
                console.error(error);
            });

            form.addEventListener('submit', async (e)=>{
            e.preventDefault()

            if(description.value === "") {
                error("A descrição não pode estar vazia!")
                return;
            }
            form.submit()
        })

    });
</script>
</x-app-layout>
