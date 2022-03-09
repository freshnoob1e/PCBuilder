<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('forum')}}" class="underline">< Back to forum</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="text-xl font-semibold">
                        Chatroom list
                    </div>
                    <div class="mt-4 w-full">
                        <table class="w-full border rounded-lg">
                            <thead>
                                <th class="border w-[25%]">User</th>
                                <th class="border w-[75%]">Last Message</th>
                            </thead>
                            <tbody>
                                @if($chatrooms->first())
                                @foreach ($chatrooms as $room)
                                <tr>
                                    <td class="border text-center w-[25%]">
                                    @foreach ($room->users as $user)
                                    @if ($user->id != Auth::user()->id)
                                        <a href="{{route('chat-show', $room->id)}}" class="underline font-semibold">
                                            {{$user->name}}
                                        </a>
                                    @endif
                                    @endforeach
                                    </td>
                                    <td class="border text-center overflow-hidden w-[75%]">
                                        <div>
                                            <span class="text-lg">
                                                {{strlen($room->messages()->first()->text) > 64 ?
                                                    substr($room->messages()->first()->text, 0, 64).'...' :
                                                    $room->messages()->first()->text}}
                                            </span>
                                            <span class="underline">
                                                <span class="text-sm font-semibold">{{$room->messages()->first()->user->name}}</span>
                                                <span class="text-xs font-semibold text-neutral-600">{{$room->messages()->first()->created_at->diffForHumans()}}</span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="font-semibold text-xl text-center border" colspan="2">No chat yet...</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
