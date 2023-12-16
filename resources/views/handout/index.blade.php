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
                    <div class="overflow-auto">
                        <div>
                            <h1 class="inline-flex items-center border border-transparent text-lg leading-4 font-semi-bold">Listagem dos comunicados</h1>
                            <h2><a href="{{ route('handout.create') }}">Criar comunicado</a></h2>
                        </div>
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Título</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Corpo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if($handouts->total() === 0)
                                <tr>
                                    <td colspan="7" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum comunicado encontrado</td>
                                </tr>
                                @else   
                                    @foreach($handouts->items() as $handout)
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $handout->id }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('handout.show', [$handout->id]) }}" class="font-bold text-blue-500 hover:underline">
                                                {{ $handout->title }}
                                            </a>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $handout->body }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('handout.show', $handout->id) }}" title="Visualizar '{{$handout->title}}'">👁️</a>
                                            <a href="{{ route('handout.edit', $handout->id) }}" title="Editar '{{$handout->title}}'">✏️</a>
                                            <form action="{{ route('handout.destroy', $handout->id) }}" method="post" class="inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" title="Deletar '{{ $handout->ttle }}'">❌</button>
                                            </form>
                                        </td>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $handouts->links('components.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>