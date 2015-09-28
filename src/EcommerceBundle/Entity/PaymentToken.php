<?php
namespace EcommerceBundle\Entity;

use Payum\Core\Model\Token;
use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentToken
 *
 * @ORM\Table(name="headoo_ecommerce_payment_token")
 * @ORM\Entity
 */
class PaymentToken extends Token
{
}
