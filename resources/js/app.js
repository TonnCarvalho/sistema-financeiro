import '../../node_modules/bootstrap/dist/js/bootstrap.js'
import '@tabler/core/dist/js/tabler.js'


import './blockArialHidden.js'

import Alpine from 'alpinejs'

import contaBancaria from './alpine/contaBancaria'
import investimento from './alpine/investimento'
import tema from './alpine/tema'

window.Alpine = Alpine
Alpine.data('contaBancaria', contaBancaria)
Alpine.data('investimento', investimento)
Alpine.data('tema', tema)
Alpine.start()