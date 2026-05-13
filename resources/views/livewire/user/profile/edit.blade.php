<div class="container mx-auto px-4">
    <div class="max-w-xl mx-auto">
        <div class="text-center">
            <h1 class="font-bold text-3xl text-gray-800 sm:text-4xl">
                Edit Profile
            </h1>
        </div>

        <div class="mt-12">
            <form method="post" wire:submit.prevent="submit" class="space-y-5">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-foreground">Name</label>
                    <input type="text" id="name" name="name" wire:model.live.blur="name" class="input" placeholder="Name">
                    @error('name')
                        <div class="text-red-500 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-foreground">Name</label>
                    <input type="email" id="email" name="email" wire:model.live.blur="email" class="input" placeholder="Email">
                    @error('email')
                    <div class="text-red-500 text-sm">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div x-data="{ show_edit_password: false }">
                    <div class="text-end">
                        <button type="button" x-on:click="show_edit_password = !show_edit_password" class="text-sm font-medium text-primary-600 hover:underline">Edit Password</button>
                    </div>

                    <div x-show="show_edit_password" class="space-y-5">
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-foreground">Password</label>
                            <input type="password" id="password" name="password" wire:model.live.blur="password" class="input">
                            @error('password')
                            <div class="text-red-500 text-sm">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-foreground">Password Confirm</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" wire:model.live.blur="password_confirmation" class="input">
                            @error('password_confirmation')
                            <div class="text-red-500 text-sm">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        @if($password && $password_confirmation && $password === $password_confirmation)
                            <p class="text-green-600">Passwords match ✓</p>
                        @endif
                    </div>
                </div>

                <div class="mt-6 grid">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        Save Changes

                        <svg wire:loading.delay.long class="ml-3  -ml-1 size-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
