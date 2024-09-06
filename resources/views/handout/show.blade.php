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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h1>Visualizar comunicado</h1>
                        <div><p><strong>Título do comunicado: </strong>{{$handout->title}}</p>
                            <p><strong>Corpo: </strong>{{$handout->body}}</p>
                            <p><strong>Autor: </strong>{{ $handout->author->name }}</p>
                            <p><strong>Status: </strong><x-status.handout_status :status="$handout->status" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>