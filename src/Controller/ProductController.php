<?php
/**
 * Product Controller.
 *
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 */
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class ProductController extends Controller
{

	/**
	 * @Route("/product/add")
	 */
	public function add()
	{
		$product = new Product();
		$product->setName('product'.mt_rand(0, 1000));
		$product->setPrice(mt_rand(100, 100000));

		$doctrineManager = $this->getDoctrine()->getManager();
		$doctrineManager->persist($product);
		$doctrineManager->flush();

		return new Response(
			'Saved new product with id: '. $product->getId()
		);
	}
	
}