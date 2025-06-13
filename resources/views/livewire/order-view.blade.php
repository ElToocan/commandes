<div wire:poll.2000ms>
    <div class="d-flex gap-4 mb-4">
        <div class="form-check">
            <input wire:click="orderStateExpectedWaiting" wire:model="orderStateExpected" type="radio" id="en_attente" value="en_attente" class="form-check-input" name="type">
            <label for="en_attente" class="form-check-label"> En attente </label>
        </div>
        <div class="form-check" style="margin-left: 10px">
            <input wire:click="orderStateExpectedFinish" wire:model="orderStateExpected" type="radio" id="terminer" value="terminer" class="form-check-input" name="type">
            <label for="terminer" class="form-check-label"> Terminer </label>
        </div>
    </div>

    <div class="row">
        @foreach($orders as $order)
            @if($order->state == $orderStateExpected)
                <div class="col-mb-3 px-2 ">
                    <div class="card flex-fill {{ $order->type == 'emporter' ? 'card-danger' : 'card-primary' }}">
                        <div class="card-header">
                            <h5 class="card-title m-0">
                                Commande {{ $order->type == 'emporter' ? 'de : '.$order->name : 'de la table '.$order->table_number }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-text">{{ $order->type == 'emporter' ? 'emporter' : 'sur place' }}</h6>
                            <h6 class="card-text">
                                {{ $order->type == 'emporter' ? 'tel : '.$order->phone_number : 'Nombre de personne : '.$order->person_number }}
                            </h6>
                            @if($order->type == 'emporter')
                                <h6 class="card-text">Heure de livraison : {{ $order->delivery_time }}</h6>
                            @endif

                            <h6 style="{{ $order->comment != '' ? "color: red; border: 2px solid red; padding: 8px; display: inline-block; border-radius: 5px;" : '' }}" >{{$order->comment}}</h6>

                            <br><br>

                            @foreach(\App\Models\OrderLine::where('order_id', $order->id)->get() as $orderLine)
                                <p class="card-text">
                                    {{ \App\Models\Product::where('id', $orderLine->product_id)->first()->name .' x'.$orderLine->quantity }}
                                </p>
                            @endforeach

                            {{-- Bouton Delete --}}
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');" type="submit" class="btn btn-danger">X</button>
                            </form>

                            <form action="{{ $order->state == 'en_attente' ? route('orders.validate', $order->id) : route('orders.update', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @if($order->state !== 'en_attente')
                                    @method('PUT')
                                @endif
                                <button type="submit" class="btn btn-{{ $order->state == 'en_attente' ? 'success' : 'primary' }}">
                                    {{ $order->state == 'en_attente' ? 'Valider' : 'Modifier' }}
                                </button>
                            </form>

                            <br>
                            {{-- chack box payé / non-payée --}}
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxPaid{{ $order->id }}" wire:click="togglePayment({{ $order->id }})" {{ $order->paid ? 'checked' : '' }} >
                                    <label for="checkboxPaid{{ $order->id }}">
                                        Payé
                                    </label>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
