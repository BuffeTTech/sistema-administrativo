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
                        <p><strong>Nome Fantasia: </strong>{{$buffet->trading_name}}</p>
                        <p><strong>Email: </strong>{{$buffet->email}}</p>
                        <p><strong>Documento: </strong>{{$buffet->document}}</p>
                        <p><strong>Dono: </strong>{{$buffet->owner->name}}</p>
                        <p><strong>Telefone 1: </strong>{{$buffet->buffet_phone1->number ?? "Número não cadastrado"}}</p>
                        <p><strong>Telefone 2: </strong>{{$buffet->buffet_phone2->number ?? "Número não cadastrado"}}</p>
                        <p><strong>Endereço: </strong>
                        @if($buffet->buffet_address)
                            CEP: {{$buffet->buffet_address->zipcode}}
                            Rua: {{$buffet->buffet_address->street}}
                            Número: {{$buffet->buffet_address->number}}
                            Complemento: {{$buffet->buffet_address->complement}}
                            Bairro: {{$buffet->buffet_address->neighborhood}}
                            Estado: {{$buffet->buffet_address->state}}
                            Cidade: {{$buffet->buffet_address->city}}
                            País: {{$buffet->buffet_address->country}}
                        @else
                            Sem endereço cadastrado
                        @endif
                        </p>
                        <p><strong>Status: </strong>{{\App\Enums\BuffetStatus::getEnumByName($buffet->status)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>