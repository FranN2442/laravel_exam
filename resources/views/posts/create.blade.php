<x-app-layout>
    @if (Gate::allows('create-post'))
        <form action="{{ route('post.store') }}" method="POST">
            @csrf
            <div>
                <x-input-label for="titulo" :value="__('Title')" />
                <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo')" />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="titulo" :value="__('Extract')" />
                <x-text-input id="extracto" class="block mt-1 w-full" type="text" name="extracto"
                    :value="old('extracto')" />
                <x-input-error :messages="$errors->get('extracto')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="contenido" :value="__('Content')" />
                <x-text-input id="contenido" class="block mt-1 w-full" type="text" name="contenido"
                    :value="old('contenido')" />
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
    @else
        <h2 style="color: white">El usuario {{Auth::user()->name}} no tiene permitido estas opciones</h2>
        <p style="color: white">Rol del usuario : {{Auth::user()->rol}}</p>
    @endif
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($posts as $post)
            @if (Gate::allows('read-posts', $post))
                <div class="p-6 flex space-x-2 border">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $post->user->name }}</span>
                                <small
                                    class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $post->contenido }}</p>

                    </div>
                    <a class="" href="{{ route('post.delete', $post->id) }}">@lang('Delete')</a>
                    <a class="" href="{{ route('post.edit', $post->id) }}">@lang('Edit')</a>
                </div>
            @endif
        @endforeach
    </div>
</x-app-layout>
