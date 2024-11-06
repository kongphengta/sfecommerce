<?php

namespace   App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{

    public function __construct(private RequestStack $requestStack,)
    {
        
    }
    /**
     * add()
     * Fonction permettant l'ajout d'un produit au panier
     */

    public function add($product)
 {
    // Appeler la session de Symfony
    $cart = $this->getCart();
   
    // Ajouter une quantité +1 à mon produit
    if (isset($cart[$product->getId()])) {
        $cart[$product->getId()] = [
            'object' => $product,
            'qty' => $cart[$product->getId()]['qty'] + 1
        ];
    } else { 
        $cart[$product->getId()] = [
            'object' => $product,
            'qty' => 1
        ];
    }

    // Créer ma session Cart
    $this->requestStack->getSession()->set('cart', $cart);  
 }
     /**
     * decrease()
     * Fonction permettant d'une suppression d'une quantité d'un produit du panier
     */
    public function decrease($id)
    {
       $cart = $this->getCart();
        if ($cart[$id]['qty'] > 1 ) 
        {
            $cart[$id]['qty'] = $cart[$id]['qty'] - 1;
        } else 
        {
            unset($cart[$id]);
        }
        $this->requestStack->getSession()->set('cart', $cart);
    }
    /**
     * fullQuantity()
     * Fonction retournant le nombre total de produit au panier
     */
    public function fullQuantity()
    {
        $cart = $this->getCart();
        $quantity = 0;

        if (!isset($cart))
        return $quantity;
    }
    /**
     * getTotalWt()
     * Fonction retournant le prix total des produits au panier
     */
    public function getTotalWt()
    {
        $cart = $this->getCart();
        $price = 0;

        if (!isset($cart))
        return $price;
    }
     /**
     * remove()
     * Fonction permettant de squpprimer totalement le panier
     */
    public function remove()
    {
        return $this->requestStack->getSession()->remove('cart');
    }
     /**
     * getCart()
     * Fonction retournant le panier
     */
    public function getCart()
    {
        return $this->requestStack->getSession()->get('cart');
    }
}