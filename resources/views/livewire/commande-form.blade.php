<div>
    <!-- Boutons radio sur une ligne -->
    <div class="d-flex gap-4 mb-4">
        <div class="form-check">
            <input wire:click="typeFormulaireSurPlace" type="radio" id="surPlace" value="surPlace" class="form-check-input" name="type">
            <label for="surPlace" class="form-check-label">Sur place</label>
        </div>
        <div class="form-check" style="margin-left: 10px">
            <input wire:click="typeFormulaireEmporter" type="radio" id="emporter" value="emporter" class="form-check-input" name="type">
            <label for="emporter" class="form-check-label">À emporter</label>
        </div>
    </div>

    <!-- Formulaire conditionnel -->
    @if ($type === 'surPlace')
        <div class="row g-3">
            <div class="col-md-6">
                <label>N° de table</label>
                <input wire:model="form.tableNumber" type="number" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Nombre de personnes</label>
                <input wire:model="form.personNumber" type="number" class="form-control">
            </div>
        </div>
    @elseif ($type === 'emporter')
        <div class="row g-3">
            <div class="col-md-6">
                <label>N° de téléphone</label>
                <input wire:model="form.phoneNumber" type="tel" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Nom de la commande</label>
                <input wire:model="form.name" type="text" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Heure de livraison</label>
                <input wire:model="form.deliveryTime" type="datetime-local" class="form-control">
            </div>
        </div>
    @endif

    <div  >
        <label>Commentaire :</label><br>
        <input wire:model="form.comment" type="text" class="form-control">
    </div>


{{--IA--}}

     <div class="border border-dark rounded p-5 mt-5">
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
            <div>
                @if(count($orderLines) > 0 && $type)
                    <div class="mt-4 text-end">
                        <button wire:click="validerCommande" class="btn btn-success">
                            Valider
                        </button>
                    </div>
                @endif

            </div>
     </div>

</div>



