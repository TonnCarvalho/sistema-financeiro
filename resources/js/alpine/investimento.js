export default () => {
    return {
        investimento: {
            nome: '',
            conta_bancaria: '',
            valor_aplicado: '',
            tipo_investimento: '',
            data: ''
        },
        guarda: {
            valor: ''
        },
        novo_valor_liquido: '',
        novo_valor_bruto: '',
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
                        valor_aplicado: '',
                        tipo_investimento: '',
                        data: ''
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
        investimentoCalculo() {
            // pega valor atual da div (ex: "4.000,00")
            let div = document.querySelector('#novo_valor_bruto');
            let valorAtual = div.innerText;

            // converte para número (remove pontos e troca vírgula por ponto)
            let numeroAtual = parseFloat(valorAtual.replace(/\./g, '').replace(',', '.')) || 0;
            // converte input para número
            let numeroNovo = parseFloat(this.novo_valor_liquido.replace(/\./g, '').replace(',', '.')) || 0;

            // soma
            let soma = numeroAtual + numeroNovo;

            // atualiza a div formatada
            div.innerText = soma.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
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