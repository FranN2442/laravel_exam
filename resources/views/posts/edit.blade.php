<x-app-layout>
    <form action="{{ route('post.update',$post->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div>
            <x-input-label for="titulo" :value="__('Title')" />
            <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo',$post->titulo)" />
            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="titulo" :value="__('Extract')" />
            <x-text-input id="extracto" class="block mt-1 w-full" type="text" name="extracto" :value="old('titulo',$post->extracto)" />
            <x-input-error :messages="$errors->get('extracto')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="contenido" :value="__('Content')" />
            <x-text-input id="contenido" class="block mt-1 w-full" type="text" name="contenido" :value="old('titulo',$post->contenido)" />
            <x-input-error :messages="$errors->get('contenido')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="caducable" :value="__('Expirable')" />
            <input type="checkbox" name="caducable">
            <x-input-label for="comentable" :value="__('Commentable')" />
            <input type="checkbox" name="comentable">
        </div>
        <div>
            <x-input-label for="acceso" :value="__('Access')" />
            <select name="acceso">
                <option value="publico">@lang('Public')</option>
                <option value="privado">@lang('Private')</option>
            </select>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </div>

        <x-primary-button class="ms-3">
            {{ __('Send') }}
        </x-primary-button>
    </form>
</x-app-layout>