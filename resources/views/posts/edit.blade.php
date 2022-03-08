<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Your Post (#'.$post->id.')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-8/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('forum')}}" class="underline">< Back to forum</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-8/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl py-3 overflow-hidden">
                    <div class="flex mx-3 relative items-start">
                        @if(!is_null($post->user->profile_photo_path))
                        <div><img src="/storage/{{$post->user->profile_photo_path}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                        @else
                        <div><img src="{{$post->user->profile_photo_url}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                        @endif
                        <div class="text-xl ml-4 w-full">
                            <div class="font-semibold">{{$post->user->name}}</div>
                            <form action="{{route('post-update', $post->id)}}" method="POST" class="w-full">
                                @csrf
                                @method('patch')
                                <textarea rows="10" class="border-gray-200 rounded-xl w-full h-32" placeholder="Share something..."
                                            id="content" name="content">{{$post->content}}</textarea>
                                @if ($errors->any())
                                    <div class="text-red-500">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <button class="text-lg bg-indigo-500 font-semibold w-full rounded-xl text-white py-1" type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
