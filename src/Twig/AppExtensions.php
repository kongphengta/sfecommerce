<?php
namespace App\Twig;

use App\Classe\Cart;
use App\Repository\CategoryRepository;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

class AppExtensions extends AbstractExtension implements GlobalsInterface
{
    private $categoeyRepository;
    private $cart;
    public function __construct(CategoryRepository $categoeyRepository, Cart $cart)
    {
        $this->categoeyRepository= $categoeyRepository;
        $this->cart = $cart;
    }
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice'])
        ];
    }
    public function formatPrice($number)
    {
        return number_format($number, '2', ','). ' €';
    }
    public function getGlobals(): array
    {
        return [
            'allCategories' => $this->categoeyRepository->findAll(),
            'fullCartQuantity' => $this->cart->fullQuantity()
        ];
    }
}