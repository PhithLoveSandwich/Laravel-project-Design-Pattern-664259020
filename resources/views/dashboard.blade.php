<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @auth
                        <h1 class="text-2xl font-bold mb-2">ยินดีต้อนรับ, {{ Auth::user()->name }} 🎉</h1>
                        <p>คุณได้เข้าสู่ระบบเรียบร้อยแล้ว</p>
                    @else
                        <h1 class="text-2xl font-bold mb-2">กรุณาเข้าสู่ระบบ</h1>
                        <a href="{{ route('login') }}" class="text-blue-600 underline">เข้าสู่ระบบ</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
