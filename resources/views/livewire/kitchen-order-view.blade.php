<div wire:poll.30000ms>

    <div class="col-mb-3 px-2 ">
        <div class="card flex-fill {{ $order->type == 'emporter' ? 'card-danger' : 'card-primary' }}">
            <div class="card-header">
                <h5 class="card-title m-0">
                    Commande {{ $order->type == 'emporter' ? 'de : '.$order->name : 'de la table '.$order->table_number }}
                </h5>
            </div>
            <div class="card-body">
                <h6 class="card-text">{{ $order->type == 'emporter' ? 'A emporter' : 'Sur place' }}</h6>

                @if($order->type == 'emporter')
                    <h6 class="card-text"><i class="fa fa-clock"></i> : {{ $order->delivery_time->format('d/m') }}
                        <strong> {{ $order->delivery_time->format('H:i') }} </strong></h6>
                @endif

                <h6 style="{{ $order->comment != '' ? "color: red; border: 2px solid red; padding: 8px; display: inline-block; border-radius: 5px;" : '' }}">{{$order->comment}}</h6>

                <br>

                @foreach($categories as $category)
                    {{--AI--}}
                    @php
                        // On filtre les lignes de commande dont le produit appartient à la catégorie en cours
                        $linesInCategory = $order->orderLines->filter(function($line) use ($category) {
                            return $line->product && $line->product->product_categories_id == $category->id;
                        });
                    @endphp

                    @if($linesInCategory->count() > 0)
                        <strong>{{ $category->name }}</strong> <br>

                        @foreach($linesInCategory as $orderLine)
                            <button wire:click="toggleOrderLine({{ $orderLine->id }})"
                                    class="btn btn-sm mb-1">
                                {{ $orderLine->product->name . ' x' . $orderLine->quantity }}
                            </button>
                            <i class="{{ $orderLine->status ? 'fa fa-check-square' : '' }}"></i>
                            <br>
                        @endforeach

                        <br>
                    @endif
                    {{--END AI--}}
                @endforeach

                <br>

                {{-- Bouton Delete --}}
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');" type="submit"
                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="checkbox" id="checkboxPaid{{ $order->id }}"
                               wire:click="togglePayment({{ $order->id }})" {{ $order->paid ? 'checked' : '' }} >
                        <label for="checkboxPaid{{ $order->id }}">
                            Payé
                        </label>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
