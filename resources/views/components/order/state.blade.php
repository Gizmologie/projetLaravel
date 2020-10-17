<form id="msform">
    <ul id="progressbar">
        <li @if($active >= 1) class="active" @endif id="delivery"><strong>Livraison</strong></li>
        <li @if($active >= 2) class="active" @endif id="payment"><strong>Paiement</strong></li>
        <li @if($active >= 3) class="active" @endif id="confirm"><strong>Terminée</strong></li>
    </ul>
</form>
