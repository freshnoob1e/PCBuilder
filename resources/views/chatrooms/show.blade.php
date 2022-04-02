<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat with: '.'asdf') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('chat-index')}}" class="underline">< Back to chats list</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="text-xl font-semibold">
                        Chatting with:
                        @foreach ($chatroom['users'] as $user)
                        @if ($user['uid'] != Auth::user()->id)
                            {{$user['name']}}
                            @php
                                $target_id = $user['uid']
                            @endphp
                        @endif
                        @endforeach
                    </div>

                    <div class="mt-6 border border-gray-300 rounded-xl h-[70vh] overflow-hidden shadow">
                        <div class="bg-gray-50 h-[90%] flex flex-col-reverse overflow-auto">
                            @if (array_key_exists('messages', $chatroom))
                            @foreach($chatroom['messages'] as $message)
                            @if($message['user']['uid'] == Auth::user()->id)
                            <div class="bg-indigo-300 border place-self-end text-lg p-2 mx-4 my-2 rounded-xl max-w-[60%] shadow overflow-x-hidden">
                            @else
                            <div class="bg-gray-100 border place-self-start text-lg p-2 mx-4 my-2 rounded-xl max-w-[60%] shadow overflow-x-hidden">
                            @endif
                                <div>
                                    <span class="text-lg font-semibold">{{$message['user']['name']}}</span>
                                    <span class="text-xs text-neutral-600">{{$message['time_ago']}}</span>
                                </div>
                                <div class="text-md">{{$message['text']}}</div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="bg-gray-50 h-[10%] px-2 py-1 flex items-end">
                            <form action="{{route('message-store', [Auth::user()->id, $target_id])}}" method="POST" class="w-full relative">
                                @csrf
                                <input type="text" class="w-full border-neutral-200 rounded-lg shadow" placeholder="Write your message here..."
                                        id="text" name="text">
                                <button class="absolute right-0 z-10 mt-2 mr-4" type="submit">
                                    <img src="{{asset('storage/images/svg/send.svg')}}">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
