<x-layouts.app :title="'Perfil'">
    <div class="space-y-6 max-w-xl">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-layouts.app>