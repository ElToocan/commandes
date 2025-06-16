<div wire:poll.30000ms>
    <div class="d-flex gap-4 mb-4">
        <div class="form-check">
            <input wire:click="orderStateExpectedWaiting" wire:model="orderStateExpected" type="radio" id="en_attente" value="en_attente" class="form-check-input" name="type">
            <label for="en_attente" class="form-check-label"> En attente </label>
        </div>
        <div class="form-check" style="margin-left: 10px">
            <input wire:click="orderStateExpectedFinish" wire:model="orderStateExpected" type="radio" id="terminer" value="terminer" class="form-check-input" name="type">
            <label for="terminer" class="form-check-label"> Terminées </label>
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
                            <h6 class="card-text">{{ $order->type == 'emporter' ? 'A emporter' : 'Sur place' }}</h6>
                            <h6 class="card-text">
                                <i class="{{ $order->type == 'emporter' ? 'fa fa-mobile' : 'fa fa-user : ' }}"></i> : {{ $order->type == 'emporter' ? $order->phone_number : $order->person_number }}
                            </h6>
                            @if($order->type == 'emporter')
                                <h6 class="card-text"><i class="fa fa-clock" ></i> : {{ $order->delivery_time->format('d/m H:i') }}</h6>
                            @endif

                            <h6 style="{{ $order->comment != '' ? "color: red; border: 2px solid red; padding: 8px; display: inline-block; border-radius: 5px;" : '' }}" >{{$order->comment}}</h6>

                            <br>

                            @foreach(\App\Models\OrderLine::where('order_id', $order->id)->get() as $orderLine)
                                <button wire:click="toggleOrderLine({{$orderLine->id}})"
                                        class="btn btn-outline-dark btn-sm mb-1">
                                    {{ \App\Models\Product::where('id', $orderLine->product_id)->first()->name .' x'.$orderLine->quantity }}
                                </button>
                                <i class="{{ $orderLine->status ? 'fa fa-check-square' : 'fa fa-window-close'}}"></i>
                                <br>
                            @endforeach

                            <br><br>

                            {{-- Bouton Delete --}}
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');" type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                            </form>

                            <form action="{{ route('orders.update', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-info btn-sm">
                                    Modifier
                                </button>
                            </form>

                            @if($order->state === 'en_attente')
                                <form action="{{route('orders.validate', $order->id)}}" method="POST" style="display:inline;" >
                                    @csrf
                                    <button type="submit" class="btn btn-{{ $order->state == 'en_attente' ? 'success' : 'primary' }} btn-sm">
                                        Terminé
                                    </button>
                                </form>
                            @endif



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
