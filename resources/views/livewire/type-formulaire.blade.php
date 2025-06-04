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
                <input wire:model="form.deliveryTime" type="time" class="form-control">
            </div>
        </div>
    @endif
</div>
