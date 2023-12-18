<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comercial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                        <div>
                            <h1 class="inline-flex items-center border border-transparent text-lg leading-4 font-semi-bold">Listagem dos nosso comercial</h1>
                            <h2><a href="{{ route('commercial.create') }}">Criar funcionário do nosso comercial</a></h2>
                        </div>
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
                                @if($commercials->total() === 0)
                                <tr>
                                    <td colspan="7" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum comercial encontrado</td>
                                </tr>
                                @else   
                                    @foreach($commercials->items() as $commercial)
                                    <tr>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $commercial->id }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('commercial.show', [$commercial->id]) }}" class="font-bold text-blue-500 hover:underline">
                                                {{ $commercial->user->name }}
                                            </a>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $commercial->user->email }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ \App\Enums\DocumentType::getEnumByName($commercial->user->document_type) }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $commercial->user->document }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center"><x-status.user_status :status="$commercial->user->status" /></td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            @can('show commercial')
                                            <a href="{{ route('commercial.show', $commercial->id) }}" title="Visualizar '{{$commercial->user->name}}'">👁️</a>
                                            @endcan
                                            @if($commercial->user->status !== \App\Enums\UserStatus::UNACTIVE->name)
                                                @can('update commercial')
                                                    <a href="{{ route('commercial.edit', $commercial->id) }}" title="Editar '{{$commercial->user->name}}'">✏️</a>
                                                @endcan
                                                @can('delete commercial')
                                                    <form action="{{ route('commercial.destroy', $commercial->id) }}" method="post" class="inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" title="Deletar '{{ $commercial->user->name }}'">❌</button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $commercials->links('components.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>