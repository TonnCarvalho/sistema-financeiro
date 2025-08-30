import '@tabler/core/dist/js/tabler.js'
import '../../node_modules/bootstrap/dist/js/bootstrap.js'

import './blockArialHidden.js'

import Alpine from 'alpinejs'

import contaBancaria from './alpine/contaBancaria'


window.Alpine = Alpine
Alpine.data('contaBancaria', contaBancaria)

Alpine.start()