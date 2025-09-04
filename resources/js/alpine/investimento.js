export default () => {
    return {
        investimento: {
            nome: '',
            conta_bancaria: '',
            valor: '',
            tipo_investimento: ''
        },
        errors: [],
        modal: {},
        csrfToken: document.querySelector('#__token').getAttribute('content'),
        openModal() {
            this.modal = new bootstrap.Modal('#modal-form');
            this.modal.show();
        },
        async send() {
            try {
                const response = await fetch('/investimento', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.investimento)
                })
                let data = await response.json();

                if (!response.ok) {
                    this.errors = data.errors;
                    this.validaCriarInvestimento();
                }
                console.log(response);
                if (response.ok) {
                    this.modal.hide();
                    window.location.reload();
                    this.errors = []; // Limpa erros
                    this.investimento = { // Reset do form
                        nome: '',
                        conta_bancaria: '',
                        valor: '',
                        tipo_investimento: ''
                    };
                    return;
                }
            } catch (error) {
                this.validaCriarInvestimento();
            }
        },
        validaCriarInvestimento() {
            const fields = ['nome', 'conta_bancaria', 'tipo_investimento'];

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