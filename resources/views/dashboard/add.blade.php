<div class="content">
    <div class="container">
        <div class="row">

            <div>

                <livewire:type-formulaire/>

                @if(!empty($pageInclude))
                    <div class="border border-dark rounded p-5 mt-5" style="min-height: 400px; min-width: 400px; border-width: 4px;">
                        @include($pageInclude)
                    </div>
               @endif
            </div>

        </div>
    </div>
</div>
