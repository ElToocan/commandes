<div>
    <!-- Boutons radio -->
    <div class="form-check">
        <input wire:click="typeFormulaire" type="radio" id="surPlace" value="surPlace" class="form-check-input" name="type">
        <label for="surPlace" class="form-check-label">Sur place</label>
    </div>

    <div class="form-check">
        <input wire:click="typeFormulaire" type="radio" id="emporter" value="emporter" class="form-check-input" name="type">
        <label for="emporter" class="form-check-label">À emporter</label>
    </div>

    <br>

    <!-- Formulaire conditionnel -->
    @if ($type === 'surPlace')
        <div>
            <h4>Formulaire pour manger sur place</h4>
            <input wire:model="form.table" type="text" class="form-control" placeholder="Numéro de table">
        </div>
    @elseif ($type === 'emporter')
        <div>
            <h4>Formulaire pour emporter</h4>
            <input wire:model="form.address" type="text" class="form-control" placeholder="Adresse de livraison">
        </div>
    @endif
</div>
