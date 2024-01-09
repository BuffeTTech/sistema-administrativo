<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>

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
                                    @foreach($permissions->items() as $key=>$permission)
                                    <tr>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center font-bold">
                                            <a href="{{ route('buffet.permissions.show', ['permission'=>$permission->name]) }}" class="underline font-bold" title='Visualizar cargos da permissão "{{ $permission->name }}"'>{{ $permission->name}}</a>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <form action="{{ route('buffet.permissions.add_role',$permission->id) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                
                                                <select id="roles-{{$permission->name}}" multiple class="roles" onchange="this.form.submit()">
                                                    @foreach($permission->all_roles as $role)
                                                    <option value="{{ $role['name'] }}" @if($role['linked']) selected @endif>{{ $role['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                            {{-- <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50"></span> --}}
                                            {{-- <button class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">+</button> --}}
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

    <script>
        const SITEURL = "{{ url('/') }}";
        const csrf = document.querySelector('meta[name="csrf-token"]').content



        const selects = document.querySelectorAll('.roles')
        selects.forEach(element => {
            new MultiSelectTag(element.id, {
                rounded: true,    // default true
                shadow: true,      // default false
                placeholder: 'Search',  // default Search...
                tagColor: {
                    textColor: '#327b2c',
                    borderColor: '#92e681',
                    bgColor: '#eaffe6',
                },
                onChange: async function(values) {
                    console.log(values)
                    const route = element.id.split('roles-')[1]
                    const data = await axios.patch(SITEURL + '/subscription/permissions/'+route, {
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        },
                        data: {
                            roles: values
                        }
                    })
                    console.log(data)
                }
            })
        });
    </script>
</x-app-layout>