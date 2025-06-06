<div class="content">
    <div class="container">
        <div class="row">

            @foreach($orders as $order)
                @if($order->state == "terminer" )

                    <!-- card left-->
                    <div class="col-lg-3">
                        <div class=" {{ $order->type == 'emporter' ? 'card card-danger card-outline' : 'card card-primary card-outline' }}  ">
                            <div class="card-header">
                                <h5 class="card-title m-0">Commande {{$order->type == 'emporter' ? 'de : '.$order->name : 'de la table '.$order->table_number}}</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-text">{{$order->type == 'emporter' ? 'emporter' : 'sur place' }}</h6>
                                <h6 class="card-text">{{$order->type == 'emporter' ? 'tel : '.$order->phone_number : 'Nombre de personne'.$order->person_number }}</h6>
                                <h6 class="card-text">{{ $order->type == 'emporter' ? 'Heure de livraison : '.$order->delivery_time : ' '}}</h6>
                                <br><br>


                                @foreach(\App\Models\OrderLine::where('order_id',$order->id)->get() as $orderLine)
                                    <p class="card-text"> {{ \App\Models\Product::where('id',$orderLine->product_id)->first()->name .' x'.$orderLine->quantity }} </p>
                                @endforeach

                                {{--Bonton Delete--}}
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');" type="submit" class="btn btn-danger">X</button>
                                </form>


                                <a href="{{ route('update', $order->id) }}" class="btn btn-primary">Modifier</a>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach



            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
