<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\ProductCategories;
use Livewire\Component;

class CommandeFormUpdate extends Component
{
    public Order $order;

    public string $type = '';

    public array $form = [
        'name' => '',
        'phoneNumber' => '',
        'deliveryTime' => '',
        'personNumber' => '',
        'tableNumber' => '',
        'comment' => '',
    ];

    public string $state;

    public $categories;
    public $selectedCategory = null;
    public $products = [];
    public $orderLines = [];

    public function mount($id)
    {
        $this->order = Order::find($id);
        $this->type = $this->order->type;
        $this->state = $this->order->state;

        // Utilise $this->order pour accéder aux propriétés
        $this->form['name'] = $this->order->name;
        $this->form['phoneNumber'] = $this->order->phone_number;
        $this->form['deliveryTime'] = $this->order->delivery_time;
        $this->form['personNumber'] = $this->order->person_number;
        $this->form['tableNumber'] = $this->order->table_number;
        $this->form['comment'] = $this->order->comment;

        $this->categories = ProductCategories::all();

        $this->orderLines = OrderLine::where('order_id', $id)
            ->with('product')
            ->get()
            ->map(function ($line) {
                return [
                    'product_id' => $line->product_id,
                    'product_name' => $line->product->name ?? '',
                    'quantity' => $line->quantity,
                    'unit_price' => $line->product->price,
                    'total_price' => $line->quantity * $line->product->price,
                ];
            })->toArray();

    }

    public function typeFormulaireSurPlace()
    {
        $this->type = 'surPlace';
    }

    public function typeFormulaireEmporter()
    {
        $this->type = 'emporter';
    }

    public function selectCategories($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->products = Product::where('product_categories_id', $categoryId)->get();
    }

    public function updatedSelectedCategory($value)
    {
        if ($value === null) {
            $this->products = [];
        }
    }


    public function addProductToOrder($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        $existing = collect($this->orderLines)->firstWhere('product_id', $productId);
        if ($existing) {
            foreach ($this->orderLines as &$line) {
                if ($line['product_id'] == $productId) {
                    $line['quantity'] += 1;
                    $line['total_price'] = $line['quantity'] * $product->price;
                }
            }
        } else {
            $this->orderLines[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => 1,
                'unit_price' => $product->price,
                'total_price' => $product->price,
            ];
        }
    }

    public function incrementQuantity($index)
    {
        if (isset($this->orderLines[$index])) {
            $this->orderLines[$index]['quantity'] += 1;
            $this->orderLines[$index]['total_price'] =
                $this->orderLines[$index]['quantity'] * $this->orderLines[$index]['unit_price'];
        }
    }

    public function decrementQuantity($index)
    {
        if (isset($this->orderLines[$index])) {
            if ($this->orderLines[$index]['quantity'] > 1) {
                $this->orderLines[$index]['quantity'] -= 1;
                $this->orderLines[$index]['total_price'] =
                    $this->orderLines[$index]['quantity'] * $this->orderLines[$index]['unit_price'];
            } else {
                unset($this->orderLines[$index]);
                $this->orderLines = array_values($this->orderLines);
            }
        }
    }

    public function updateCommande()
    {
        if (empty($this->orderLines) || !$this->type) {
            session()->flash('error', 'Veuillez compléter la commande.');
            return;
        }

        // Calcul du total général de la commande
        $total = collect($this->orderLines)->sum(function ($line) {
            return $line['quantity'] * $line['unit_price'];
        });

        // Récupération de la commande existante (à adapter selon ta logique)
        $order = Order::find($this->order->id);

        if (!$order) {
            session()->flash('error', 'Commande introuvable.');
            return;
        }

        // Mise à jour des champs de la commande
        $order->update([
            'type' => $this->type,
            'name' => $this->form['name'] ?? null,
            'phone_number' => $this->form['phoneNumber'] ?? null,
            'delivery_time' => $this->form['deliveryTime'] ?? null,
            'table_number' => $this->form['tableNumber'] ?? null,
            'person_number' => $this->form['personNumber'] ?? null,
            'comment' => $this->form['comment'],
            'total_price' => $total,
            'state' => $this->state, // ou 'draft', etc.
            'paid' => false,
        ]);

        // Suppression des anciennes lignes de commande (optionnel, selon ta logique)
        $order->orderLines()->delete();

        // Recréation des lignes de commande avec les nouvelles données
        foreach ($this->orderLines as $line) {
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $line['product_id'],
                'quantity' => $line['quantity'],
                'price' => $line['unit_price'] * $line['quantity'],
            ]);
        }

        return redirect()->route('view');

    }


    public function render()
    {
        return view('livewire.commande-form-update');
    }
}
