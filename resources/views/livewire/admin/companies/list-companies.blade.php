<div class="p-6 rounded shadow container">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Companies</h1>

    </div>

    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search companies..." class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500">
    </div>

    <!-- Table Companies -->
    <div>
        <flux:table :paginate="$companies">
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Logo</flux:table.column>
                <flux:table.column>Company name</flux:table.column>
                <flux:table.column>Website</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Date Registered</flux:table.column>
                <flux:table.column>Actions</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse ($companies as $company)
                    <flux:table.row wire:key="$company->id">
                        <flux:table.cell>{{ $company->id }}</flux:table.cell>
                        <flux:table.cell>
                            @if($company->logo)
                               <img src="{{ \Storage::url($company->logo) }}" class="rounded-full h-10 w-10 object-cover" />
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>{{ $company->company_name }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap text-overflow-ellipsis overflow-hidden">
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap text-overflow-ellipsis overflow-hidden">
                            @if($company->email)
                                <a href="mailto:{{ $company->email }}" target="_blank">{{ $company->email }}</a>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $company->created_at->format('Y-m-d') }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-2">
                                <flux:modal.trigger name="view-company">
                                    <a href="#" wire:click.prevent="viewCompany({{ $company->id }})">
                                        <flux:icon name="eye" class="text-gray-500 hover:text-gray-700 size-6" />
                                    </a>
                                </flux:modal.trigger>
                                <flux:modal.trigger name="send-email">
                                    <a href="#" wire:click.prevent="openSendMail({{ $company->id }})">
                                        <flux:icon name="envelope" class="text-gray-500 hover:text-gray-700 size-6" />
                                    </a>
                                </flux:modal.trigger>

                                <a href="{{route('admin.jobs.index')}}?company_id={{$company->id}}" wire:navigate title="view jobs" class="text-blue-600">
                                    <flux:icon name="megaphone" />
                                </a>

                                <a href="#" wire:click.prevent="destroy({{$company->id}})" wire:confirm="Are you sure you wanto to delete this item?" title="delete">
                                    <flux:icon name="trash" class="text-red-500 hover:text-red-700 size-6" />
                                </a>
                            </div>

                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <div class="text-center text-gray-500 text-sm">
                            No companies registered yet.
                        </div>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <!-- View Company Modal -->
    <flux:modal name="view-company" class="md:w-96 lg:w-full" scroll="body">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">View company #{{$viewedCompany?->id}}</flux:heading>
                <flux:text class="mt-2">Display company info for company "{{$viewedCompany?->company_name}}".</flux:text>
            </div>
            <div class="flex items-center gap-4">
                <flux:icon name="photo" class="text-gray-500" />
                <flux:text>Logo:</flux:text>
                @if($viewedCompany?->logo)
                    <img src="{{ \Storage::url($viewedCompany?->logo) }}" class="rounded-full h-10 w-10 object-cover" />
                @endif
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="flex items-center gap-4">
                    <flux:icon name="building-office" class="text-gray-500" />
                    <flux:text>Company name:</flux:text>
                    <flux:text class="font-semibold">{{$viewedCompany?->company_name}}</flux:text>
                </div>
                <div class="flex items-center gap-4">
                    <flux:icon name="globe-alt" class="text-gray-500" />
                    <flux:text>Website:</flux:text>
                    <flux:text class="font-semibold">{{$viewedCompany?->website}}</flux:text>
                </div>
                <div class="flex items-center gap-4">
                    <flux:icon name="envelope" class="text-gray-500" />
                    <flux:text>Email:</flux:text>
                    <flux:text class="font-semibold">{{$viewedCompany?->email}}</flux:text>
                </div>
                <div class="flex items-center gap-4">
                    <flux:icon name="calendar" class="text-gray-500" />
                    <flux:text>Date registered:</flux:text>
                    <flux:text class="font-semibold">{{$viewedCompany?->created_at->format('Y-m-d')}}</flux:text>
                </div>
                <div class="flex items-center gap-4">
                    <flux:icon name="document-text" class="text-gray-500" />
                    <flux:text>Bio:</flux:text>
                    <flux:text class="font-semibold">{{$viewedCompany?->bio}}</flux:text>
                </div>
                <div class="flex items-center gap-4">
                    <flux:icon name="building-library" class="text-gray-500" />
                    <flux:text>Number of users:</flux:text>
                    <flux:text class="font-semibold">{{$viewedCompany?->users->count()}}</flux:text>
                </div>
            </div>
            <div class="flex">
                <flux:spacer />
            </div>
        </div>
    </flux:modal>

    <!-- Send Mail Modal -->
    <flux:modal name="send-email" class="min-w-[30rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Send email to "{{$sendToCompany?->company_name}}"</flux:heading>

                <div class="mt-3">
                    <textarea
                        wire:model.defer="message"
                        rows="6"
                        class="w-full border rounded-md p-2"
                        placeholder="Write your message..."
                    ></textarea>

                    @error('message')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="button" wire:click="send" variant="primary">Send</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
