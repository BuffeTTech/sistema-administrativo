<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permissões') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Nome</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Roles</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if($permissions->total() === 0)
                                <tr>
                                    <td colspan="2" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhuma reserva encontrada</td>
                                </tr>
                                @else   
                                    @foreach($permissions->items() as $permission)
                                    <tr>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center font-bold">{{ $permission->name}}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            @foreach($permission->roles as $role)
                                                <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">{{ $role->name }}</span>
                                            @endforeach
                                            <button class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">+</button>
                                            <form action="{{ route('buffet.permissions.add_role',$permission->id) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $permissions->links('components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>