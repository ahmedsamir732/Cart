<?php
/**
 * Cart Controller is the place we recieve all requests related to the users cart managment.
 *
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 */
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Cart;
use App\Cart\Add\Add as AddCart;
use App\Cart\Edit\Edit as EditCart;
use App\Cart\CartExist;

class CartController extends Controller
{

	/**
	 * @Route("/")
	 */
	public function show()
	{
		return new Response('show');
	}
	
	/**
	 * @Route("/cart/add")
	 */
	
	public function add()
	{
		$user = $this->getDoctrine()->getRepository(User::class)->find(1);
		$product = $this->getDoctrine()->getRepository(Product::class)->find(1);
		$quantity = 3;

		// $CartExist = new CartExist($this->getDoctrine()->getRepository(Cart::class));
		// if($CartExist->checkCart($user->getId(), $product->getId())) {
		// 	$response = "Cart updated successfully";
		// 	$cart = $CartExist->getCart();

		// 	$editObj = new EditCart($this->getDoctrine()->getManager());
		// 	$editObj->setQuantity($quantity+$cart->getQuantity());
		// 	$status = $editObj->edit($cart);
		// } else {

		// 	$response = 'added to cart successfully';
		// 	$cart = new AddCart($this->getDoctrine()->getManager());
		// 	$cart->setUser($user);
		// 	$cart->setProduct($product);
		// 	$cart->setQuantity($quantity);
		// 	$status = $cart->add();
		// 	if (!$status) {
		// 		$response = $cart->getErrorMessage();
		// 	}
		// }
		
		$response = 'added to cart successfully';
		$cart = new AddCart($this->getDoctrine()->getManager());
		$cart->setUser($user);
		$cart->setProduct($product);
		$cart->setQuantity($quantity);
		$status = $cart->add();
		if (!$status) {
			$response = $cart->getErrorMessage();
		}

		

		return new Response ($response);
	}

	/**
	 * @Route("/cart/edit/{id)")
	 */
	
	public function edit($id)
	{
		$cart = $this->getDoctrine()->getRepository(Cart::class)->find($id);
		if (!$cart) {
			return Response('Error: There no item with that id to update');
		}

		$EditCart = new EditCart($this->getDoctrine()->getManager());
		$EditCart->setQuantity($cart->getQuantity() + 0);
	}

	/**
	 * @Route("/cart/delete")
	 */
	
	public function delete()
	{
		return new Response("delete");
	}
}