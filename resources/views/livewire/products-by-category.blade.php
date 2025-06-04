{{--IA--}}

<div>
    @if (!$selectedCategory)
        <div>
            @foreach($categories as $category)
                <button
                    wire:click="selectCategories({{ $category->id }})"
                    class="btn btn-primary"
                    style="margin: 5px"
                >
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    @else
        <button
            wire:click="$set('selectedCategory', null)"
            class="btn btn-secondary mb-3"
        >
            Back to categories
        </button>
    @endif

    <div>
        @if(count($products) > 0)
            @foreach($products as $product)
                <button
                    type="button"
                    class="btn btn-outline-success m-1"
                    wire:click="addProductToOrder({{ $product->id }})"
                >
                    {{ $product->name }}
                </button>
            @endforeach
        @endif
    </div>

    {{-- Affichage des lignes de commande --}}
    @if(count($orderLines) > 0)
        <hr>
        <h5>Commande</h5>
            <ul class="list-group">
                @foreach($orderLines as $index => $line)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $line['product_name'] }}
                            <button wire:click="decrementQuantity({{ $index }})" class="btn btn-sm btn-outline-danger mx-1">−</button>
                            <span>{{ $line['quantity'] }}</span>
                            <button wire:click="incrementQuantity({{ $index }})" class="btn btn-sm btn-outline-success mx-1">+</button>
                        </div>
                        <span>{{ number_format($line['total_price'], 2) }} €</span>
                    </li>
                @endforeach
            </ul>
    @endif
</div>
