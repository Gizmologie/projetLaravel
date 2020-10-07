import 'select2'
import 'select2/dist/css/select2.min.css'
import $ from 'jquery'

$.noConflict()
$(document).ready(function() {
    $('.js-select2').select2();
});
