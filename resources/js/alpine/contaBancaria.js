export default (accountBank = []) => {
    return {
        accountBank: {
            nome: '',
            banco_id: '',
            saldo: '',
            mostra_saldo: true,
        },
        accountBankEdit: {
            nome: accountBank['nome'] ?? '',
            banco_id: accountBank['banco_id'] ?? '',
            saldo: accountBank['saldo'] ?? '',
            mostra_saldo: accountBank['mostra_saldo'],
        },
        errors: [],
        modal: {},
        csrfToken: document.querySelector('#__token').getAttribute('content'),
        openModal() {
            this.modal = new bootstrap.Modal('#modal-account');
            this.modal.show();
        },
        async send() {
            try {
                const response = await fetch('/conta-bancaria', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
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
            }
        },
        async sendEdit(accountBankId) {
            try {
                const response = await fetch(`/conta-bancaria/${accountBankId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.accountBankEdit)
                });
                let data = await response.json();

                if (!response.ok) {
                    this.errors = data.errors;
                    this.validaCriarContas();
                }
                if (response.ok) {
                    window.location.reload();
                    return;
                }
            } catch (error) {
                this.validaCriarContas();
            }
        },
        validaCriarContas() {
            const fields = ['nome', 'banco_id', 'saldo'];

            fields.forEach(field => {
                const input = document.querySelector(`#${field}`);
                if (input) {
                    if (this.errors[field]) {
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                }
            })
        }
    }
}