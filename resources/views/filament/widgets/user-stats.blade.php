<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-lg border border-blue-100 min-h-[350px]">
            <div class="mb-2">
                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5a4 4 0 11-8 0 4 4 0 018 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h2 class="text-4xl font-extrabold text-blue-700 mb-1">{{ $userCount }}</h2>
            <div class="text-gray-600 text-lg font-medium">Tổng số người dùng</div>
            <div class="text-gray-400 text-sm mt-1">Tăng trưởng ổn định mỗi tháng</div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
