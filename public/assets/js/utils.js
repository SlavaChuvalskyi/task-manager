const submitFormHandler = async (form) => {

    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: formData,
        }).then(res => {
            if (res.redirected && res.status === 200) {
                window.location.reload();
                return null;
            }
            return res;
        });

        if (!response) {
            return response;
        }

        const data = await response.json();

        if (data.success) {
            return true;
        } else if (data.errors) {

            // ❌ Show validation messages
            Object.entries(data.errors).forEach(([field, messages]) => {
                const errorEl = form.querySelector(`[data-error="${field}"]`);

                if (errorEl) {
                    errorEl.textContent = messages[0];
                    errorEl.classList.remove('hidden');
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) input.classList.add('!border-red-500');

                }
            });
            return false;
        }
    } catch (err) {
        console.error('Request err:', err);
        return true;
    }
}

const onSubmitForm = async (e, id) => {
    e.preventDefault();
    const form = e.target;

    const spinnerBlock = form.querySelector('div.loading');
    const footerBlock = form.querySelector('div.footer');
    if (spinnerBlock && footerBlock) {
        spinnerBlock.classList.remove('hidden');
        footerBlock.classList.add('hidden');
    }

    const submittedSuccessfully = await submitFormHandler(form);
    if (submittedSuccessfully) {
        form.reset();
        toggleModal(id, false);
    }

    if (submittedSuccessfully !== null && spinnerBlock && footerBlock) {
        spinnerBlock.classList.add('hidden');
        footerBlock.classList.remove('hidden');
    }

}

function toggleModal(id, show = true) {
    const modal = document.getElementById(id);

    if (!modal) return;

    const form = modal.querySelector('form');

    if (show) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.addEventListener('keydown', escHandler);
        document.addEventListener('click', clickHandlerOutsideModal);

    } else {
        document.removeEventListener('keydown', escHandler);
        document.removeEventListener('click', clickHandlerOutsideModal);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (form) {
            form.reset();
            form.querySelectorAll('[data-error]').forEach(el => el.classList.add('hidden'));
            form.querySelectorAll('input, textarea, select').forEach(el => el.classList.remove('!border-red-500'));
        }
    }

    function escHandler(e) {
        if (e.key === 'Escape') toggleModal(id, false);
    }

    function clickHandlerOutsideModal(e) {
        const modal = e.target.closest('.fixed.inset-0');
        if (modal && e.target === modal) toggleModal(modal.id, false);
    }

}
