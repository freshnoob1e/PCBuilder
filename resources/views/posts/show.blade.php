<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post (#'.$post->id.')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-8/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl pt-3 overflow-hidden">
                    <div class="flex mx-3 relative">
                        <div><img src="{{asset('storage/images/avatar/placeholder/1-1.png')}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                        <div class="text-xl ml-4">
                            <div class="font-semibold">{{$post->user->name}}</div>
                            <div class="text-neutral-500">{{$post->created_at->diffForHumans()}}</div>
                        </div>
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
                            <div class="w-1/12"><img src="{{asset('storage/images/avatar/placeholder/1-1.png')}}" class="w-10 h-10 rounded-full overflow-hidden"></div>
                            <form class="mx-2 space-y-1 bg-gray-100 rounded-2xl p-1 w-11/12 overflow-hidden" action="{{route('comment-store', $post->id)}}" method="POST">
                                @csrf
                                <input type="text" class="w-full bg-gray-100 border-0 focus:ring-0" placeholder="Write a comment..."
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
                            <div class="w-1/12"><img src="{{asset('storage/images/avatar/placeholder/1-1.png')}}" class="w-10 h-10 rounded-full overflow-hidden"></div>
                            <div class="mx-2 space-y-1 bg-gray-100 rounded-2xl px-3 py-1 w-11/12 overflow-hidden">
                                <div>
                                    <span class="font-semibold text-lg text-gray-800">{{$comment->user->name}}</span>
                                    <span class="ml-1 text-xs text-gray-500">{{$comment->created_at->diffForHumans()}}</span>
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
