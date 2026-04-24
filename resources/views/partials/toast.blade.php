@if(session('success') || session('error'))
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="liveToast" class="toast show overflow-hidden border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white">
            <div class="toast-body p-3">
                <div class="d-flex align-items-center">
                    <i class="bi {{ session('success') ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }} fs-5 me-2"></i>
                    <span>{{ session('success') ?? session('error') }}</span>
                </div>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        {{-- Barre de progression --}}
        <div class="progress" style="height: 4px; background: rgba(0,0,0,0.1); border-radius: 0;">
            <div id="toastProgress" class="progress-bar bg-white opacity-75" role="progressbar" style="width: 100%;"></div>
        </div>
    </div>
</div>

<style>
    #toastProgress {
        transition: width 5s linear !important;
    }
    .toast {
        border-radius: 8px !important;
        min-width: 320px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('liveToast');
        const progressBar = document.getElementById('toastProgress');

        if (toastEl) {
            // 1. Lance l'animation de la barre
            setTimeout(() => {
                progressBar.style.setProperty('width', '0%', 'important');
            }, 100);

            // 2. Disparition automatique après 5 secondes
            setTimeout(() => {
                // On ajoute une classe de sortie fluide
                toastEl.style.transition = "opacity 0.5s ease";
                toastEl.style.opacity = "0";

                // On supprime l'élément du DOM après l'animation de sortie
                setTimeout(() => {
                    toastEl.remove();
                }, 500);
            }, 5000);
        }
    });
</script>
@endif
