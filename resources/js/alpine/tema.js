export default () => {
    return {
        tema: '',

        mudarTema() {
            let temaStorage = localStorage.getItem('tema');
            let body = document.querySelector('.layout-boxed')

            //muda para dark
            if (temaStorage === null || temaStorage === 'light') {
                localStorage.setItem('tema', 'dark');
                body.setAttribute('data-bs-theme', 'dark');
                this.tema = 'dark';
            }

            //muda para light
            if (temaStorage === 'dark') {
                localStorage.setItem('tema', 'light');
                body.setAttribute('data-bs-theme', 'light')
                this.tema = 'light';
            }
        },
        carregarTema() {
            let temaStorage = localStorage.getItem('tema');
            let body = document.querySelector('.layout-boxed')

            if (temaStorage == 'dark') {
                body.setAttribute('data-bs-theme', 'dark')
                this.tema = 'dark'
            } else {
                body.setAttribute('data-bs-theme', 'light')
                this.tema = 'light';
            }
        }
    }
}