<?php

namespace App\Enum;

class OrderStateEnum
{
    public static $CREATED = "created";
    public static $DELIVERY_SETUP = "delivery_setup";
    public static $BILLING_SETUP = "billing_setup";
    public static $DELIVERY_IN_PROCESS = "delivery_in_process";
    public static $FINISHED = "finished";

}
