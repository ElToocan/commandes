<div wire:poll.30000ms class="col-sm-12 col-md-3 px-2 ">
    <div class="card flex-fill {{ $order->type == 'emporter' ? 'card-danger' : 'card-primary' }}">
        <div class="card-header">
            <h5 class="card-title m-0">
                Commande {{ $order->type == 'emporter' ? 'de : '.$order->name : 'de la table '.$order->table_number }}
            </h5>
        </div>
        <div class="card-body">
            <h6 class="card-text">{{ $order->type == 'emporter' ? 'A emporter' : 'Sur place' }}</h6>
            <h6 class="card-text">
                <i class="{{ $order->type == 'emporter' ? 'fa fa-mobile' : 'fa fa-user : ' }}"></i>
                : {{ $order->type == 'emporter' ? $order->phone_number : $order->person_number }}
            </h6>
            @if($order->type == 'emporter')
                <h6 class="card-text"><i class="fa fa-clock"></i> : {{ $order->delivery_time->format('d/m') }}
                    <strong> {{ $order->delivery_time->format('H:i') }} </strong></h6>
            @endif

            <h6 style="{{ $order->comment != '' ? "color: red; border: 2px solid red; padding: 8px; display: inline-block; border-radius: 5px;" : '' }}">{{$order->comment}}</h6>

            <br>

            @foreach($order->orderLines()->with('product')->get() as $orderLine)
                <button wire:click="toggleOrderLine({{$orderLine->id}})"
                        class="btn btn-sm mb-1">
                    {{ $orderLine->product->name .' x'.$orderLine->quantity }}
                </button>
                <i class="{{ $orderLine->status ? 'fa fa-check-square' : ''}}"></i>
                <br>
            @endforeach

            <br>

            {{-- Bouton Delete --}}
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');" type="submit"
                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </form>

            <form action="{{ route('orders.update', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-info btn-sm">
                    Modifier
                </button>
            </form>

            @if($order->state === 'en_attente')
                <form action="{{route('orders.validate', $order->id)}}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit"
                            class="btn btn-{{ $order->state == 'en_attente' ? 'success' : 'primary' }} btn-sm">
                        Terminé
                    </button>
                </form>
            @endif


            <br>
            {{-- chack box payé / non-payée --}}
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" id="checkboxPaid{{ $order->id }}" class="custom-control-input"
                           wire:click="togglePayment({{ $order->id }})" {{ $order->paid ? 'checked' : '' }} >
                    <label for="checkboxPaid{{ $order->id }}" class="custom-control-label">
                        Payé
                    </label>
                </div>
            </div>


        </div>
    </div>
</div>
