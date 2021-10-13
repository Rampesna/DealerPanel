var HOST_URL = "https://keenthemes.com/metronic/tools/preview";
var KTAppSettings = {
    "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200},
    "colors": {
        "theme": {
            "base": {
                "white": "#ffffff",
                "primary": "#3699FF",
                "secondary": "#E5EAEE",
                "success": "#1BC5BD",
                "info": "#8950FC",
                "warning": "#FFA800",
                "danger": "#F64E60",
                "light": "#F3F6F9",
                "dark": "#212121"
            },
            "light": {
                "white": "#ffffff",
                "primary": "#E1F0FF",
                "secondary": "#ECF0F3",
                "success": "#C9F7F5",
                "info": "#EEE5FF",
                "warning": "#FFF4DE",
                "danger": "#FFE2E5",
                "light": "#F3F6F9",
                "dark": "#D6D6E0"
            },
            "inverse": {
                "white": "#ffffff",
                "primary": "#ffffff",
                "secondary": "#212121",
                "success": "#ffffff",
                "info": "#ffffff",
                "warning": "#ffffff",
                "danger": "#ffffff",
                "light": "#464E5F",
                "dark": "#ffffff"
            }
        },
        "gray": {
            "gray-100": "#F3F6F9",
            "gray-200": "#ECF0F3",
            "gray-300": "#E5EAEE",
            "gray-400": "#D6D6E0",
            "gray-500": "#B5B5C3",
            "gray-600": "#80808F",
            "gray-700": "#464E5F",
            "gray-800": "#1B283F",
            "gray-900": "#212121"
        }
    },
    "font-family": "Poppins"
};

const months = [
    'Ocak',
    'Şubat',
    'Mart',
    'Nisan',
    'Mayıs',
    'Haziran',
    'Temmuz',
    'Ağustos',
    'Eylül',
    'Ekim',
    'Kasım',
    'Aralık',
];

function reformatDatetimeForHuman(date) {
    var formattedDate = new Date(date);
    return String(formattedDate.getDate()).padStart(2, '0') + ' ' +
        months[formattedDate.getMonth()] + ' ' +
        formattedDate.getFullYear() + ', ' +
        String(formattedDate.getHours()).padStart(2, '0') + ':' +
        String(formattedDate.getMinutes()).padStart(2, '0') + ' ';
}

function reformatDatetime(date) {
    var formattedDate = new Date(date);
    return String(formattedDate.getDate()).padStart(2, '0') + '.' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '.' +
        formattedDate.getFullYear() + ', ' +
        String(formattedDate.getHours()).padStart(2, '0') + ':' +
        String(formattedDate.getMinutes()).padStart(2, '0') + ' ';
}

function reformatDateForHuman(date) {
    var formattedDate = new Date(date);
    return String(formattedDate.getDate()).padStart(2, '0') + ' ' +
        months[formattedDate.getMonth()] + ' ' +
        formattedDate.getFullYear();
}

function reformatDate(date) {
    var formattedDate = new Date(date);
    return String(formattedDate.getDate()).padStart(2, '0') + '.' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '.' +
        formattedDate.getFullYear();
}

function reformatDatetimeForInput(date) {
    var formattedDate = new Date(date);
    return formattedDate.getFullYear() + '-' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '-' +
        String(formattedDate.getDate()).padStart(2, '0') + 'T' +
        String(formattedDate.getHours()).padStart(2, '0') + ':' +
        String(formattedDate.getMinutes()).padStart(2, '0');
}

function reformatDateForInput(date) {
    var formattedDate = new Date(date);
    return formattedDate.getFullYear() + '-' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '-' +
        String(formattedDate.getDate()).padStart(2, '0');
}

$('.decimal').on("copy cut paste drop", function () {
    return false;
}).keyup(function () {
    var val = $(this).val();
    if (isNaN(val)) {
        val = val.replace(/[^0-9\.]/g, '');
        if (val.split('.').length > 2)
            val = val.replace(/\.+$/, "");
    }
    $(this).val(val);
});

$(".onlyNumber").keypress(function (e) {
    if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

$('.gsmMask').inputmask('(999) 999-99-99', {placeholder: '(___) ___-__-__'});

$(".emailMask").inputmask({
    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
    greedy: false,
    onBeforePaste: function (pastedValue, opts) {
        pastedValue = pastedValue.toLowerCase();
        return pastedValue.replace("mailto:", "");
    },
    definitions: {
        '*': {
            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
            cardinality: 1,
            casing: "lower"
        }
    }
});

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$(window).on('load', function () {
    $("#loader").fadeOut(250);
});

function detectMobile() {
    if (navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)
    ) {
        return true;
    } else {
        return false;
    }
}

if (detectMobile()) {
    $("#navbarControl").css({'margin-top': '20px'});
    $("#isMobile").show();
    $('.mobile').removeClass('col-6').addClass('col-12');
} else {
    $("#isMobile").hide();
    $("#navbarControl").css({'margin-top': '-50px'});
}
