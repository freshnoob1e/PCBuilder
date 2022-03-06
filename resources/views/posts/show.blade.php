<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl space-x-5 flex mx-auto items-start">
            <div class="w-8/12 flex flex-col space-y-6 mx-auto">
                <div class="bg-white border shadow rounded-xl pt-3 overflow-hidden">
                    <div class="flex mx-3 relative">
                        <div><img src="{{asset('storage/images/avatar/placeholder/1-1.png')}}" class="overflow-hidden w-16 h-16 rounded-full"></div>
                        <div class="text-xl ml-4">
                            <div class="font-semibold">Username</div>
                            <div class="text-neutral-500">{{date("d/m/Y h:i")}}</div>
                        </div>
                    </div>
                    <div class="ml-24">
                        wat do, is post {{$post}}
                    </div>
                    <div class="mt-2 grid grid-cols-2 w-full">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
