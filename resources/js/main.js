import '../scss/styles.scss';
import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

    const successToastEl = document.getElementById('successToast');
    if (successToastEl) {
        const successToast = new bootstrap.Toast(successToastEl, {
            delay: 4000
        });
        successToast.show();
    }

    const unavailableToastEl = document.getElementById('unavailableToast');
    if (unavailableToastEl) {
        const unavailableToast = new bootstrap.Toast(unavailableToastEl, {
            delay: 3000
        });

        document.querySelectorAll('.load-toast-trigger').forEach(btn => {
            btn.addEventListener('click', () => {
                unavailableToast.show();
            });
        });
    }
});