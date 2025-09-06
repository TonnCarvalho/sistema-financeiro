export default () => {
    return {
        investimento: {
            nome: '',
            conta_bancaria: '',
            valor_bruto: '',
            tipo_investimento: ''
        },
        guarda: {
            valor: ''
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
                if (response.ok) {
                    this.modal.hide();
                    window.location.reload();
                    this.errors = [];
                    this.investimento = {
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
        async guarda(investimentoId) {
            try {
                const response = await fetch(`/investimento/${investimentoId}/guarda`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        guarda_valor: this.guarda.valor
                    })
                })

                let data = await response.json();

                if (!response.ok) {
                    this.errors = data.errors
                    this.validaGuardaValor();
                }

                if (response.ok) {
                    this.modal.hide();
                    this.guarda.valor = '';
                    this.errors = [];
                    window.location.reload();
                    return;
                }
            } catch (error) {
                this.validaGuardaValor();
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
        },
        validaGuardaValor() {
            const input = document.querySelector('#guarda_valor');
            if (this.errors) {
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        }
    }
}