@props(['submit'])



<div class="card">
    <form wire:submit="{{ $submit }}">
        <div class="card-body">
            <div class="row">
                {{ $form }}
            </div>

            @if (isset($actions))
            <div class="modal-footer">
                {{ $actions }}
            </div>
            @endif

        </div>
    </form>
</div>