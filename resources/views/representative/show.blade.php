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
                    <div class="overflow-auto">
                        <h1>Visualizar representante</h1>
                        <div><p><strong>Nome do Representante: </strong>{{$representative->user->name}}</p>
                            <p><strong>Email: </strong>{{$representative->user->email}}</p>
                            <p><strong>{{\App\Enums\DocumentType::getEnumByName($representative->user->document_type)}}: </strong>{{$representative->user->document}}</p>
                            <p><strong>Telefone 1: </strong>{{$representative->user->user_phone1->number ?? "Número não cadastrado"}}</p>
                            <p><strong>Telefone 2: </strong>{{$representative->user->user_phone2->number ?? "Número não cadastrado"}}</p>
                            <p><strong>Status: </strong>{{\App\Enums\UserStatus::getEnumByName($representative->user->status)}}</p>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>