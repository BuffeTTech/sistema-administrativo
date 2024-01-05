<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Planos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div >
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h1>Visualizar plano</h1>
                        <p><strong>Nome do pacote: </strong>{{$subscription->name}}</p>
                        <p><strong>Slug: </strong>{{$subscription->slug}}</p>
                        <p><strong>Preço: </strong>{{$subscription->price}}</p>
                        <p><strong>Desconto atual: </strong>{{$subscription->discount}}%</p>
                        <p><strong>Status: </strong><x-status.subscription_status :status="$subscription->status" /></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>