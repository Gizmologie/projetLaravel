<div class="bs-stepper vertical linear">
    <div class="bs-stepper-header mx-auto" role="tablist">
        <div class="step @if($order->getDeliveryStateNumber() >= 3) done @endif" >
            <button type="button" class="step-trigger" role="tab">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Commande prise en compte</span>
            </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step @if($order->getDeliveryStateNumber() >= 4) done @endif" >
            <button type="button" class="step-trigger" role="tab">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Commande en cours de livraison</span>
            </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step @if($order->getDeliveryStateNumber() >= 5) done @endif" >
            <button type="button" class="step-trigger" role="tab">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Commande livrée</span>
            </button>
        </div>
    </div>
</div>
