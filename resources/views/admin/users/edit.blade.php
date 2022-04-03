{{-- AUTHOR: ONG CHOON TECK --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User ('.$user->name.')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('admin-users-index')}}" class="underline">< Back to user list</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="flex items-start">
                        <div class="rounded-full overflow-hidden"><img src="{{$user->profile_photo_url}}"></div>
                        <div class="ml-4">
                            <div class="text-xl font-semibold">{{$user->name}}</div>
                            <div class="mt-1">{{$user->email}}</div>
                        </div>
                    </div>
                    <div class="mt-4 py-4 border-t">
                        <div>
                            User's Roles:
                            @if($user->roles->first())
                            <div class="mt-2 flex space-x-5">
                                @foreach ($user->roles as $role)
                                <form class="bg-sky-100 ring-2 ring-sky-200 rounded-full px-2 py-1 flex" action="{{route('admin-users-role-destroy', $user->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <span class="mr-2">{{$role->name}}</span>
                                    <button type="submit"><img src="{{asset('storage/images/svg/cancel.svg')}}"></button>
                                    <input type="hidden" id="role_id" name="role_id" value="{{$role->id}}">
                                </form>
                                @endforeach
                            </div>
                            @else
                            No Role(s)
                            @endif
                        </div>
                        <div class="mt-4 pt-4 border-t flex items-start">
                            <div class="my-auto">Assign user role:</div>
                            <form action="{{route('admin-users-update', $user->id)}}" method="POST" class="ml-4">
                                @csrf
                                @method('patch')
                                @if ($roles->first())
                                <select name="role" id="role" class="py-0">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <button class="rounded-full bg-indigo-500 font-semibold text-xl text-white px-2 py-1 ml-2" type="submit">Toggle Role</button>
                                @else
                                No Roles Available
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
