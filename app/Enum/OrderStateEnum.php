<?php

namespace App\Enum;

class OrderStateEnum
{
    public static $CREATED = "created";
    public static $DELIVERY_SETUP = "delivery_setup";
    public static $BILLING_SETUP = "billing_setup";
    public static $ACCEPTED = "accepted";
    public static $DELIVERY_IN_PROCESS = "delivery_in_process";
    public static $FINISHED = "finished";

    public static function getName($name){
        switch ($name){
            case self::$CREATED:
                return 'Créée';
            case self::$DELIVERY_SETUP:
                return 'Choix de la livraison';
            case self::$BILLING_SETUP:
                return 'Paiement en cours';
            case self::$ACCEPTED:
                return 'Commande acceptée';
            case self::$DELIVERY_IN_PROCESS:
                return 'Livraison en cours';
            case self::$FINISHED:
                return 'Commande livrée';
            default:
                return $name;
        }
    }

}
