<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start mb-6">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <a href="{{route('admin-dashboard')}}" class="underline">< Back to dashboard</a>
            </div>
        </div>
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-10/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl p-3 overflow-hidden">
                    <div class="text-xl font-semibold">Users</div>
                    <div class="border border-gray-300 rounded-lg mt-4">
                        <table class="w-full rounded-lg overflow-hidden">
                            <thead class="border-b border-b-gray-300">
                                <th>
                                    Username
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Roles
                                </th>
                                <th>
                                    Join date
                                </th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($users as $user)
                                @if($i%2==0)
                                <tr class="border-b border-gray-300">
                                @else
                                <tr class="border-b border-gray-300 bg-gray-50">
                                @endif
                                    <td class="border-r border-gray-300 px-2 py-1 text-center">
                                        <a href="{{route('admin-users-edit', $user->id)}}" class="underline">{{$user->name}}</a>
                                    </td>
                                    <td class="border-r border-gray-300 px-2 py-1 text-center">
                                        {{$user->email}}
                                    </td>
                                    <td class="border-r border-gray-300 px-2 py-1 text-center">
                                        @if($user->roles->first())
                                        <div class="mt-2 flex space-x-5 justify-center">
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
                                        No role(s)
                                        @endif
                                    </td>
                                    <td class="border-gray-300 px-2 py-1 text-center">
                                        {{$user->created_at}}
                                    </td>
                                </tr>
                                @php
                                    $i++
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
