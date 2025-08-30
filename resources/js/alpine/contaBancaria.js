export default () => {
    return {
        accountBank: {
            nome: '',
            banco_id: '',
            saldo: '',
            mostra_saldo: true,
        },
        errors: [],
        modal: {},
        openModal() {
            this.modal = new bootstrap.Modal('#modal-account');
            this.modal.show();
        },
        async send() {

            try {
                const response = await fetch('/conta-bancaria', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('#__token').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.accountBank)
                })

                let data = await response.json();

                if (!response.ok) {
                    this.errors = data.errors;
                    this.validaCriarContas();
                }

                if (response.ok) {
                    this.modal.hide();
                    window.location.reload();
                    return;
                }
            } catch (error) {
                this.validaCriarContas();
            } finally {
            }
        },
        validaCriarContas() {
            const fields = ['nome', 'banco_id', 'saldo'];

            fields.forEach(field => {
                const element = document.querySelector(`#${field}`);
                if (element) {
                    if (this.errors[field]) {
                        element.classList.add('is-invalid');
                    } else {
                        element.classList.remove('is-invalid');
                    }
                }
            })
        }
    }
}