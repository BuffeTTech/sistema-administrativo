<x-app-layout>
    <h1>Criar Plano</h1>
    <div>
        <form method="POST" action="{{ route('buffet.subscription.store') }}" id="form">
            @csrf

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus  />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="slug" :value="__('slug')" />
                <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" required />
                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('description')" />
                <textarea name="description" id="description" cols="30" rows="10" class="block mt-1 w-full" required>{{old('description')}}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="price" :value="__('price')" />
                <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
