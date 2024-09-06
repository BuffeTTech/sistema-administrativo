<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Funcionários Comerciais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h1>Visualizar comercial</h1>
                        <p><strong>Nome do Comercial: </strong>{{$commercial->user->name}}</p>
                        <p><strong>Email: </strong>{{$commercial->user->email}}</p>
                        <p><strong>{{\App\Enums\DocumentType::getEnumByName($commercial->user->document_type)}}: </strong>{{$commercial->user->document}}</p>
                        <p><strong>Telefone 1: </strong>{{$commercial->user->user_phone1->number ?? "Número não cadastrado"}}</p>
                        <p><strong>Telefone 2: </strong>{{$commercial->user->user_phone2->number ?? "Número não cadastrado"}}</p>
                        <p><strong>Status: </strong>{{\App\Enums\UserStatus::getEnumByName($commercial->user->status)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>