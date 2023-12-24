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
                        <div>
                            <h1 class="inline-flex items-center border border-transparent text-lg leading-4 font-semi-bold">Listagem dos representantes</h1>
                            <h2><a href="{{ route('representative.create') }}">Criar representante</a></h2>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Nome</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Email</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Tipo Doc.</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Documento</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if($representatives->total() === 0)
                                <tr>
                                    <td colspan="7" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhuma reserva encontrada</td>
                                </tr>
                                @else   
                                    @foreach($representatives->items() as $representative)
                                    <tr>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $representative->id }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('representative.show', [$representative->id]) }}" class="font-bold text-blue-500 hover:underline">
                                                {{ $representative->user->name }}
                                            </a>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $representative->user->email }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ \App\Enums\DocumentType::getEnumByName($representative->user->document_type) }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $representative->user->document }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center"><x-status.user_status :status="$representative->user->status" /></td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            @can('show representative')
                                            <a href="{{ route('representative.show', $representative->id) }}" title="Visualizar '{{$representative->user->name}}'">👁️</a>
                                            @endcan
                                            @if($representative->user->status !== \App\Enums\UserStatus::UNACTIVE->name)
                                                @can('update representative')
                                                    <a href="{{ route('representative.edit', $representative->id) }}" title="Editar '{{$representative->user->name}}'">✏️</a>
                                                @endcan
                                                @can('delete representative')
                                                    <form action="{{ route('representative.destroy', $representative->id) }}" method="post" class="inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" title="Deletar '{{ $representative->user->name }}'">❌</button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $representatives->links('components.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>