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
                    <div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h1>Visualizar plano</h1>
                        <p><strong>Nome do pacote: </strong>{{$subscription->name}}</p>
                        <p><strong>Slug: </strong>{{$subscription->slug}}</p>
                        <p><strong>Descrição: </strong>{!! $subscription->description !!}</p>
                        <p><strong>Preço: </strong>{{$subscription->price}}</p>
                        <p><strong>Desconto atual: </strong>{{$subscription->discount}}%</p>
                        <p><strong>Status: </strong><x-status.subscription_status :status="$subscription->status" /></p>
                        <br>
                        <h1>Permissões</h1>
                        <p>Até o momento, este pacote possui <strong>{{ count($roles) }}</strong> cargos</p>
                        <br>                     
                        <ul>
                            @foreach($roles as $role)
                                <li>
                                    <p>Nome: <a href="{{ route('buffet.roles.show', $role->name) }}" title="Visualização da role {{ $role->name }}" class="underline font-bold">{{ $role->name }}</a></p>
                                    <p>Permissões:</p>
                                    <ul style="list-style: circle; list-style-position: inside">
                                        @foreach($role->permissions as $permission)
                                            <li><a href="{{ route('buffet.permissions.show', $permission->name) }}" title="Visualização da permission {{ $permission->name }}" class="underline">{{ $permission->name }}</a></li>
                                        @endforeach
                                    </ul>
                                    {{-- <p>Caso queira adicionar alguma permissão para esta role, <a href="{{ route('buffet.roles.show', $role->name) }}" title="Adicionar permissões a role {{ $role->name }}" class="underline font-bold">clique aqui</a></p> --}}
                                </li>       
                                <hr>                     
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>