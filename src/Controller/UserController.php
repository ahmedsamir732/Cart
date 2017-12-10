<?php
/**
 * user Controller.
 *
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 */
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class UserController extends Controller
{

	/**
	 * @Route("/user/add")
	 */
	public function add()
	{
		$user = new User();
		$user->setName('Ahmed Samir');
		$user->setEmail('ahmedsamir732@gmail.com');
		$user->setPassword('xxxxxxxxx');

		$doctrineManager = $this->getDoctrine()->getManager();
		$doctrineManager->persist($user);
		$doctrineManager->flush();

		return new Response(
			'Saved new user with id: '. $user->getId()
		);
	}
	
}