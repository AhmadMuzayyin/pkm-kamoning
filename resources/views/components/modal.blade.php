@props(['name', 'id', 'title', 'footer' => false])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $name }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ $id }}">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if ($footer)
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            @endif
        </div>
    </div>
</div>
