<div>
    <div class="flex mt-4">
        <div class="w-1/4 flex justify-center">
            <livewire:left-menu />
        </div>

        
        <div class="flex-1">
            <livewire:show-tweets :tweets="$tweets"/>
        </div>
        <div class="w-1/4 ml-4">
            <livewire:following-side-bar :user="auth()->user()"/>
        </div>
    </div>
</div>
