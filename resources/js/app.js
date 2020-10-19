require('./bootstrap');

import 'bootstrap/dist/js/bootstrap.min'
import 'bootstrap/dist/css/bootstrap.min.css'

import '@fortawesome/fontawesome-free/css/all.min.css'
import '@fortawesome/fontawesome-free/js/all.min'

import './cart'
import './product'


document.dispatchEvent(new Event('loadCart'))
