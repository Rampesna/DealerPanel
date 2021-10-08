"use strict";

// Class definition
var KTWizard4 = function () {
    // Base elements
    var _wizardEl;
    var _formEl;
    var _wizard;
    var _validations = [];

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        _wizard = new KTWizard(_wizardEl, {
            startStep: 1, // initial active step number
            clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        _wizard.on('beforeNext', function (wizard) {
            _validations[wizard.getStep() - 1].validate().then(function (status) {
                if (status == 'Valid') {
                    _wizard.goNext();
                    KTUtil.scrollTop();
                } else {
                    // Swal.fire({
                    // 	text: "Sorry, looks like there are some errors detected, please try again.",
                    // 	icon: "error",
                    // 	buttonsStyling: false,
                    // 	confirmButtonText: "Ok, got it!",
                    // 	customClass: {
                    // 		confirmButton: "btn font-weight-bold btn-light"
                    // 	}
                    // }).then(function () {
                    // 	KTUtil.scrollTop();
                    // });
                }
            });

            _wizard.stop();  // Don't go to the next step
        });

        // Change event
        _wizard.on('change', function (wizard) {
            KTUtil.scrollTop();
        });
    }

    var initValidation = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // Step 1
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Başlık Boş Olamaz'
                            }
                        }
                    },
                    date_range: {
                        validators: {
                            notEmpty: {
                                message: 'Tarih Aralığı Boş Olamaz'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                }
            }
        ));

        // Step 2
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    'evaluators[]': {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Değerlendirme Yapacak En Az 1 Yönetici Seçilmelidir'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 3
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    'employees[]': {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Değerlendirilecek En Az 1 Çalışan Seçilmelidir'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 4
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    tags: {
                        validators: {
                            notEmpty: {
                                message: 'En Az 1 Parametre Girilmelidir'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    declarative: new FormValidation.plugins.Declarative({
                        html5Input: true,
                        message: 'En Az 1 Parametre Girilmelidir'
                    }),
                }
            }
        ));
    }

    return {
        // public functions
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard_v4');
            _formEl = KTUtil.getById('kt_form');

            initWizard();
            initValidation();
        }
    };
}();

jQuery(document).ready(function () {
    KTWizard4.init();
});
