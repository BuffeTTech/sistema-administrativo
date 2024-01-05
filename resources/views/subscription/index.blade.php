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
                    <div class="overflow-auto">
                        <div>
                            <h1 class="inline-flex items-center border border-transparent text-lg leading-4 font-semi-bold">Listagem das subscriptions</h1>
                            <h2><a href="{{ route('buffet.subscription.create') }}">Criar subscription</a></h2>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Nome</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Slug</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Preço</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if($subscriptions->total() === 0)
                                <tr>
                                    <td colspan="2" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhuma reserva encontrada</td>
                                </tr>
                                @else   
                                @foreach($subscriptions->items() as $subscription)
                                <tr>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('buffet.subscription.show', ['subscription'=>$subscription->slug]) }}" class="underline font-bold" title='Visualizar cargos da permissão "{{ $subscription->name }}"'>{{ $subscription->name}}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $subscription->slug }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $subscription->price }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center"><x-status.subscription_status :status="$subscription->status" /></td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('buffet.subscription.show', $subscription->slug) }}" title="Visualizar '{{$subscription->name}}'">👁️</a>
                                        <a href="{{ route('buffet.subscription.edit', $subscription->slug) }}" title="Editar '{{$subscription->name}}'">✏️</a>
                                        <form method="post" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" title="Deletar '{{ $subscription->name }}'">❌</button>
                                        </form>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $subscriptions->links('components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>