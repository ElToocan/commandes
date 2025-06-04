<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCategories;
use App\Models\Product;

class ProductsByCategory extends Component
{
    public $categories;
    public $selectedCategory = null;
    public $products = [];
    public $orderLines = [];

    public function mount()
    {
        $this->categories = ProductCategories::all();
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


    //IA
    public function addProductToOrder($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        // Vérifie si le produit est déjà dans la commande
        $existing = collect($this->orderLines)->firstWhere('product_id', $productId);
        if ($existing) {
            // Incrémente la quantité si déjà présent
            foreach ($this->orderLines as &$line) {
                if ($line['product_id'] == $productId) {
                    $line['quantity'] += 1;
                    $line['total_price'] = $line['quantity'] * $product->price;
                }
            }
        } else {
            // Sinon, ajoute une nouvelle ligne
            $this->orderLines[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => 1,
                'unit_price' => $product->price,
                'total_price' => $product->price,
            ];
        }
    }

    //IA
    public function incrementQuantity($index)
    {
        if (isset($this->orderLines[$index])) {
            $this->orderLines[$index]['quantity'] += 1;
            $this->orderLines[$index]['total_price'] =
                $this->orderLines[$index]['quantity'] * $this->orderLines[$index]['unit_price'];
        }
    }


    //IA
    public function decrementQuantity($index)
    {
        if (isset($this->orderLines[$index])) {
            if ($this->orderLines[$index]['quantity'] > 1) {
                $this->orderLines[$index]['quantity'] -= 1;
                $this->orderLines[$index]['total_price'] =
                    $this->orderLines[$index]['quantity'] * $this->orderLines[$index]['unit_price'];
            } else {
                // Si quantité = 1 et on veut descendre => on retire la ligne
                unset($this->orderLines[$index]);
                $this->orderLines = array_values($this->orderLines); // Re-indexer le tableau
            }
        }
    }


    public function render()
    {
        return view('livewire.products-by-category');
    }
}

