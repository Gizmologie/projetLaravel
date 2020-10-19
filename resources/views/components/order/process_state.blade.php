<div class="container mt-5 ">
    <div class="bs-stepper">
        <div class="bs-stepper-header" role="tablist">
            <div class="step @if($active == 1) active @elseif($active > 1) done @endif">
                <a href="@if($active >= 1) {{ route('orderStep1') }} @endif" type="button" class="step-trigger" role="tab">
                <span class="bs-stepper-circle">
                  <span class="fas fa-truck" aria-hidden="true"></span>
                </span>
                    <span class="bs-stepper-label">Livraison</span>
                </a>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step @if($active == 2) active @elseif($active > 2) done @endif">
                <a href="@if($active >= 2) {{ route('orderStep2') }} @endif" type="button" class="step-trigger" role="tab">
                <span class="bs-stepper-circle">
                  <span class="fas fa-credit-card" aria-hidden="true"></span>
                </span>
                    <span class="bs-stepper-label">Paiement</span>
                </a>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step @if($active == 3) done @endif">
                <a href="@if($active >= 3) {{ route('orderStep3') }} @endif" type="button" class="step-trigger" role="tab">
                <span class="bs-stepper-circle">
                  <span class="fas fa-check" aria-hidden="true"></span>
                </span>
                    <span class="bs-stepper-label">Terminée</span>
                </a>
            </div>
        </div>
    </div>
</div>
