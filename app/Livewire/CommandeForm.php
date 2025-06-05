<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderLine;


class CommandeForm extends Component
{
    public string $type = '';

    public array $form = [
        'name' => '',
        'phoneNumber' => '',
        'deliveryTime' => '',
        'personNumber' => '',
        'tableNumber' => '',
        'comment' => '',
    ];

    public $categories;
    public $selectedCategory = null;
    public $products = [];
    public $orderLines = [];

    public function mount()
    {
        $this->categories = ProductCategories::all();
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

    public function render()
    {
        return view('livewire.commande-form');
    }

    public function validerCommande()
    {
        if (empty($this->orderLines) || !$this->type) {
            session()->flash('error', 'Veuillez compléter la commande.');
            return;
        }

        // Calcul du total général de la commande
        $total = collect($this->orderLines)->sum(function ($line) {
            return $line['quantity'] * $line['unit_price'];
        });

        // Création de la commande avec les nouveaux champs
        $order = Order::create([
            'type' => $this->type,
            'name' => $this->form['name'] ?? null,
            'phone_number' => $this->form['phoneNumber'] ?? null,
            'delivery_time' => $this->form['deliveryTime'] ?? null,
            'table_number' => $this->form['tableNumber'] ?? null,
            'person_number' => $this->form['personNumber'] ?? null,
            'total_price' => $total,
            'state' => 'en_attente', // ou 'draft', etc.
            'paid' => false,
        ]);

        // Création des lignes de commande sans total_price
        foreach ($this->orderLines as $line) {
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $line['product_id'],
                'quantity' => $line['quantity'],
                'price' => $line['unit_price'] * $line['quantity'],
            ]);
        }

        // Réinitialisation du formulaire
        $this->reset([
            'type',
            'form',
            'selectedCategory',
            'products',
            'orderLines'
        ]);

        session()->flash('success', 'Commande enregistrée avec succès !');
//        try {
//
//
//        } catch (\Exception $e) {
//            DB::rollBack();
//            session()->flash('error', 'Erreur : ' . $e->getMessage());
//        }

    }
}
