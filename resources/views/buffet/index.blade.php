<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buffets Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                        <div>
                            <h1 class="inline-flex items-center border border-transparent text-lg leading-4 font-semi-bold">Listagem dos buffets clientes</h1>
                            <h2><a href="{{ route('buffet.create') }}">Criar buffet</a></h2>
                        </div>
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Nome fantasia</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Documento</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Dono</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Telefone</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if($buffets->total() === 0)
                                <tr>
                                    <td colspan="7" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum buffet encontrado</td>
                                </tr>
                                @else   
                                    @foreach($buffets->items() as $buffet)
                                    <tr>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $buffet->id }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('buffet.show', [$buffet->id]) }}" class="font-bold text-blue-500 hover:underline">
                                                {{ $buffet->trading_name }}
                                            </a>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $buffet->document }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center"><x-status.buffet_status :status="$buffet->status" /></td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            @can('show buffet')
                                            <a href="{{ route('buffet.show', $buffet->id) }}" title="Visualizar '{{$buffet->trading_name}}'">👁️</a>
                                            @endcan
                                            @if($buffet->user->status !== \App\Enums\UserStatus::UNACTIVE->trading_name)
                                                @can('update buffet')
                                                    <a href="{{ route('buffet.edit', $buffet->id) }}" title="Editar '{{$buffet->trading_name}}'">✏️</a>
                                                @endcan
                                                @can('delete buffet')
                                                    <form action="{{ route('buffet.destroy', $buffet->id) }}" method="post" class="inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" title="Deletar '{{ $buffet->trading_name }}'">❌</button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $buffets->links('components.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>