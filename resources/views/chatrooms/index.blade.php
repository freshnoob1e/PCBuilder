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
                                @if(!empty($chatrooms))
                                @for ($i=0; $i < count($chatrooms); $i++)
                                <tr>
                                    <td class="border text-center w-[25%]">
                                    @for ($userIndex=0;$userIndex< count($chatrooms[$i]['users']); $userIndex++)
                                    @if ($chatrooms[$i]['users'][$userIndex]['uid'] != Auth::user()->id)
                                        <a href="{{route('chat-show', $chatrooms[$i]['users'][$userIndex]['uid'])}}" class="underline font-semibold">
                                            {{$chatrooms[$i]['users'][$userIndex]['name']}}
                                        </a>
                                    @endif
                                    @endfor
                                    </td>
                                    <td class="border text-center overflow-hidden w-[75%]">
                                        <div>
                                            <span class="text-lg">
                                                {{strlen($chatrooms[$i]['messages'][0]['text']) > 64 ?
                                                    substr($chatrooms[$i]['messages'][0]['text'], 0, 64).'...' :
                                                    $chatrooms[$i]['messages'][0]['text']}}
                                            </span>
                                            <span class="underline">
                                                <span class="text-sm font-semibold">{{$chatrooms[$i]['messages'][0]['user']['name']}}</span>
                                                <span class="text-xs font-semibold text-neutral-600">{{$chatrooms[$i]['messages'][0]['time_ago']}}</span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endfor
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
