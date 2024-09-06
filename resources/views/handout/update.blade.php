<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comunicados') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Cadastrar comunicado</h1>
                    <form method="POST" action="{{ route('handout.update', ['handout'=>$handout->id]) }}" id="form">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Name -->
                        <div>
                            <x-input-label for="title" :value="__('Nome')" class="dark:text-slate-800"/>
                            <x-text-input id="title" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="text" name="title" :value="old('title') ?? $handout->title" required autofocus placeholder="Título do comunicado"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-2">
                            <x-input-label for="body" :value="__('Conteúdo')" class="dark:text-slate-800"/>
                            <x-textarea id="body" class="textarea-container block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" name="body" :value="old('body') ?? $handout->body" required placeholder="Conteúdo"/>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="send_in" :value="__('Enviar em')" class="dark:text-slate-800"/>
                            <x-text-input id="send_in" class="block mt-1 w-full dark:bg-slate-100 dark:text-slate-500" type="datetime-local" name="send_in" :value="old('send_in') ?? $handout->send_in" required autofocus placeholder="Horário de envio"/>
                            <x-input-error :messages="$errors->get('send_in')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4" id="button">
                                {{ __('Atualizar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.querySelector("#form")
    
            form.addEventListener('submit', async function(e) {
                e.preventDefault()
                const userConfirmed = await confirm(`Deseja atualizar este comunicado?`)
    
                if (userConfirmed) {
                    this.submit();
                }
            })
            
            const textarea = document.querySelectorAll(".textarea-container")
            textarea.forEach(element => {
                ClassicEditor
                    .create(element)
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>
</x-app-layout>
