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
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Enviado por</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if($handouts->total() === 0)
                                <tr>
                                    <td colspan="7" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum comunicado encontrado</td>
                                </tr>
                                @else   
                                    @php
                                        $limite_char = 30; // O número de caracteres que você deseja exibir
                                    @endphp
                                    @foreach($handouts->items() as $handout)
                                        <tr>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $handout->id }}</td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                                <a href="{{ route('handout.show', [$handout->id]) }}" class="font-bold text-blue-500 hover:underline">
                                                    {!! mb_strimwidth($handout->title, 0, $limite_char, " ...") !!}
                                                </a>
                                            </td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{!! mb_strimwidth($handout->body, 0, $limite_char, " ...") !!}</td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $handout->author->name }}</td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center"><x-status.handout_status :status="$handout->status" /></td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                                @can('show handout')
                                                    <a href="{{ route('handout.show', $handout->id) }}" title="Visualizar '{{$handout->title}}'">👁️</a>
                                                @endcan
                                                @if($handout->status !== \App\Enums\HandoutStatus::UNACTIVE->name)
                                                    @can('update handout')
                                                        <a href="{{ route('handout.edit', $handout->id) }}" title="Editar '{{$handout->title}}'">✏️</a>
                                                    @endcan
                                                    @can('delete handout')
                                                    <form action="{{ route('handout.destroy', $handout->id) }}" method="post" class="inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" title="Deletar '{{ $handout->ttle }}'">❌</button>
                                                    </form>
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
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