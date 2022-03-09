<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post (#'.$post->id.')') }}
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
                        @if($isAdmin || $isMod || $isPostOwner)
                        <form action="{{route('post-destroy', $post->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="absolute right-0 hover:bg-neutral-100 transition duration-150" type="submit">
                                <img src="{{ asset('storage/images/svg/delete.svg') }}" class="h-4 w-4 my-auto object-fill">
                            </button>
                        </form>
                        @endif
                        @if($isPostOwner)
                        <a class="absolute right-0 mr-8 hover:bg-neutral-100 transition duration-150" href="{{route('post-edit', $post->id)}}">
                            <img src="{{ asset('storage/images/svg/edit.svg') }}" class="h-4 w-4 my-auto object-fill">
                        </a>
                        @endif
                    </div>
                    <div class="ml-24">
                        {{$post->content}}
                    </div>
                    <div class="mt-2 grid grid-cols-2 w-full border-b-gray-100 border-b">
                        <div class="text-center font-semibold text-neutral-500 border-r cursor-pointer hover:bg-neutral-50 hover:text-neutral-800 transition">
                            <div class="flex mx-auto justify-center space-x-2">
                                <img src="{{ asset('storage/images/svg/like.svg') }}" class="h-4 w-4 my-auto">
                                <div class="my-auto">Like</div>
                            </div>
                        </div>
                        <div class="text-center font-semibold text-neutral-500 border-l cursor-pointer hover:bg-neutral-50 hover:text-neutral-800 transition">
                            <div class="flex mx-auto justify-center space-x-2">
                                <img src="{{ asset('storage/images/svg/comment.svg') }}" class="h-4 w-4 my-auto">
                                <div class="my-auto">Comment</div>
                            </div>
                        </div>
                    </div>
                    {{-- Write comment --}}
                    <div class="py-3">
                        <div class="flex mx-3 items-start">
                            @if(!is_null($post->user->profile_photo_path))
                            <div class="my-auto"><img src="/storage/{{$post->user->profile_photo_path}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                            @else
                            <div class="my-auto"><img src="{{$post->user->profile_photo_url}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                            @endif
                            <form class="mx-2 space-y-1 bg-gray-100 rounded-2xl p-1 w-11/12 overflow-hidden" action="{{route('comment-store', $post->id)}}" method="POST">
                            @csrf
                                <input type="text" class="w-full bg-gray-100 border-0 focus:ring-0 my-auto" placeholder="Write a comment..."
                                        id="text" name="text">
                            </form>
                        </div>
                    </div>
                    {{-- Show post's comments --}}
                    <div class="py-3 space-y-4">
                        @if (!$post->comments->first())
                        <div class="text-center mx-auto text-gray-600">
                            No comments yet...
                        </div>
                        @else
                        @foreach ($post->comments as $comment)
                        <div class="flex mx-3 items-start">
                            @if(!is_null($comment->user->profile_photo_path))
                            <div><img src="/storage/{{$comment->user->profile_photo_path}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                            @else
                            <div><img src="{{$comment->user->profile_photo_url}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                            @endif
                            <div class="mx-2 space-y-1 bg-gray-100 rounded-2xl px-3 py-1 w-11/12 overflow-hidden">
                                <div class="relative">
                                    <span class="font-semibold text-lg text-gray-800">{{$comment->user->name}}</span>
                                    <span class="ml-1 text-xs text-gray-500">{{$comment->created_at->diffForHumans()}}</span>
                                    @if($isAdmin || $isMod || $isPostOwner || Auth::user()->id == $comment->user->id)
                                    <form action="{{route('comment-destroy', [$post->id, $comment->id])}}" method="POST" class="absolute right-0 top-0 my-1">
                                        @csrf
                                        @method('delete')
                                        <button class="hover:bg-neutral-200 transition duration-150" type="submit">
                                            <img src="{{ asset('storage/images/svg/delete.svg') }}" class="h-4 w-4 my-auto object-fill">
                                        </button>
                                    </form>
                                    @endif
                                </div>
                                <div class="text-gray-700">{{$comment->text}}</div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
