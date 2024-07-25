<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between items-center">
            <span>
                @if ($paginator->onFirstPage())
                    <span class="btn btn-disabled">Previous</span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="btn">Previous</button>
                @endif
            </span>
 
            <span>
                @if ($paginator->onLastPage())
                    <span class="btn btn-disabled">Next</span>
                @else
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="btn">Next</button>
                @endif
            </span>
        </nav>
    @endif
</div>
