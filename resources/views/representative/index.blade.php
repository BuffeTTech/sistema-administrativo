<h1>Representantes comerciais</h1>

<a href="{{ route('representative.create') }}">Criar representante</a>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="overflow-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                            
                            <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Pergunta</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">Respostas</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">Formato</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @if(count($representatives) === 0)
                        <tr>
                            <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum representante encontrado</td>
                        </tr>
                        @else
                            @php
                                $limite_char = 50; // O número de caracteres que você deseja exibir
                                $class_active = "p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50";
                                $class_unactive = 'p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50';
                            @endphp
                            @foreach($representatives as $value)
                            
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