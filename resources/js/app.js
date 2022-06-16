require('./bootstrap');

window.Swal = require('sweetalert2');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//validación maxlength
(function($) {
    'use strict';
    $('#defaultconfig').maxlength({
      warningClass: "badge mt-1 badge-success",
      limitReachedClass: "badge mt-1 badge-danger"
    });
  
    $('#defaultconfig-2').maxlength({
      alwaysShow: true,
      threshold: 20,
      warningClass: "badge mt-1 badge-success",
      limitReachedClass: "badge mt-1 badge-danger"
    });
  
    $('.defaultconfig-3').maxlength({
      alwaysShow: true,
      threshold: 10,
      warningClass: "badge mt-1 badge-success",
      limitReachedClass: "badge mt-1 badge-danger",
      separator: ' de ',
      preText: 'Tu necesitas ',
      postText: ' caracteres restantes.',
      validate: true
    });
  
    $('.maxlength-textarea').maxlength({
      alwaysShow: true,
      warningClass: "badge mt-1 badge-success",
      limitReachedClass: "badge mt-1 badge-danger"
    });
  })(jQuery);