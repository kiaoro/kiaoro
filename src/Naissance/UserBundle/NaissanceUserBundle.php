<?php 

namespace Naissance\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NaissanceUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}