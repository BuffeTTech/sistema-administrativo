<x-app-layout>
    <div>
        <form method="POST" action="{{ route('handout.update', ['handout'=>$handout->id]) }}">
            @csrf
            @method('put')

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$handout->title" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Body -->
            <div class="mt-4">
                <x-input-label for="body" :value="__('Body')" />
                <x-text-input id="body" class="block mt-1 w-full" type="body" name="body" :value="$handout->body" required autocomplete="body" />
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <!-- Send_in -->
            <div class="mt-4">
                <x-input-label for="send_in" :value="__('Enviar em')" />
                <input type="datetime-local" name="send_in" id="send_in" class="block mt-1 w-full" value={{old('send_in') ?? \Carbon\Carbon::now()->format('Y-m-d\TH:i')}} required>
                {{-- <x-text-input id="body" class="block mt-1 w-full" type="text" name="body" :value="old('body')" required autocomplete="body" /> --}}
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
