<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="p-3">
        <select class="form-control" wire:model="zoo" wire:change.defer="setZooInSession">
            @foreach ($zoos as $zoo)
                <option value="{{ $zoo->id }}">{{ $zoo->name }}</option>
            @endforeach
        </select>

        @if (session()->has('message') && $shMessage)
            <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        @endif
    </div>
</div>
