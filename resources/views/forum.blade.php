<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-8/12 flex flex-col space-y-6">
                {{-- Add post --}}
                <div class="bg-white border shadow rounded-xl py-3 overflow-hidden">
                    <div class="flex mx-3 relative items-start">
                        @if(!is_null(Auth::user()->profile_photo_path))
                        <div><img src="/storage/{{Auth::user()->profile_photo_path}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                        @else
                        <div><img src="{{Auth::user()->profile_photo_url}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                        @endif
                        <div class="text-xl ml-4 w-full">
                            <div class="font-semibold">{{auth()->user()->name}}</div>
                            <form action="{{route('post-store')}}" method="POST" class="w-full">
                                @csrf
                                <textarea rows="10" class="border-gray-200 rounded-xl w-full h-32" placeholder="Share something..."
                                            id="content" name="content"></textarea>
                                @if ($errors->any())
                                    <div class="text-red-500">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <button class="text-lg bg-indigo-500 font-semibold w-full rounded-xl text-white py-1" type="submit">Post</button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- All posts --}}
                @foreach ($posts as $post)
                    <div class="bg-white border shadow rounded-xl pt-3 overflow-hidden">
                        <div class="flex mx-3 relative">
                            @if(!is_null($post->user->profile_photo_path))
                            <div><img src="/storage/{{$post->user->profile_photo_path}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                            @else
                            <div><img src="{{$post->user->profile_photo_url}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                            @endif
                            <div class="text-xl ml-4">
                                <div class="font-semibold">{{$post->user->name}}</div>
                                <div class="text-neutral-500">{{$post->created_at->diffForHumans()}}</div>
                            </div>
                            <a class="absolute right-0 hover:bg-neutral-100 transition duration-150" href="{{route('post', $post->id)}}">
                                <img src="{{ asset('storage/images/svg/open_in_new.svg') }}" class="h-4 w-4 my-auto object-fill">
                            </a>
                            @if(Auth::user()->isAdmin || Auth::user()->isMod || Auth::user()->id == $post->user->id)
                            <form action="{{route('post-destroy', $post->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="absolute right-0 mr-8 hover:bg-neutral-100 transition duration-150" type="submit">
                                    <img src="{{ asset('storage/images/svg/delete.svg') }}" class="h-4 w-4 my-auto object-fill">
                                </button>
                            </form>
                            @endif
                            @if(Auth::user()->id == $post->user->id)
                            <a class="absolute right-0 mr-16 hover:bg-neutral-100 transition duration-150" href="{{route('post-edit', $post->id)}}">
                                <img src="{{ asset('storage/images/svg/edit.svg') }}" class="h-4 w-4 my-auto object-fill">
                            </a>
                            @endif
                        </div>
                        <div class="ml-24">
                            {{$post->content}}
                        </div>
                        <div class="mt-2 grid grid-cols-2 w-full">
                            <div class="text-center font-semibold text-neutral-500 border-r cursor-pointer hover:bg-neutral-50 hover:text-neutral-800 transition">
                                <div class="flex mx-auto justify-center space-x-2">
                                    <img src="{{ asset('storage/images/svg/like.svg') }}" class="h-4 w-4 my-auto">
                                    <div class="my-auto">Like</div>
                                </div>
                            </div>
                            <a href="{{route('post', $post->id)}}" class="text-center font-semibold text-neutral-500 border-l cursor-pointer hover:bg-neutral-50 hover:text-neutral-800 transition">
                                <div class="flex mx-auto justify-center space-x-2">
                                    <img src="{{ asset('storage/images/svg/comment.svg') }}" class="h-4 w-4 my-auto">
                                    <div class="my-auto">Comment</div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-green-500 w-4/12">
                idk man what add
            </div>
        </div>
    </div>
</x-app-layout>
