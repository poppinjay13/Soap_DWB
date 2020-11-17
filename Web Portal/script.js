$('.next-button').hover(
    function() {
        $(this).css('cursor', 'pointer');
    }
);

$('.name').on("change keyup paste",
    function() {
        if ($(this).val()) {
            $('.icon-paper-plane').addClass("next");
        } else {
            $('.icon-paper-plane').removeClass("next");
        }
    }
);

$('.next-button.name').click(
    function() {
        console.log("Something");
        $('.name-section').addClass("fold-up");
        $('.email-section').removeClass("folded");
    }
);

$('.email').on("change keyup paste",
    function() {
        if ($(this).val()) {
            $('.icon-paper-plane').addClass("next");
        } else {
            $('.icon-paper-plane').removeClass("next");
        }
    }
);

$('.next-button.email').click(
    function() {
        console.log("Something");
        $('.email-section').addClass("fold-up");
        $('.phone-section').removeClass("folded");
    }
);

$('.phone').on("change keyup paste",
    function() {
        if ($(this).val()) {
            $('.icon-paper-plane').addClass("next");
        } else {
            $('.icon-paper-plane').removeClass("next");
        }
    }
);

$('.next-button.phone').click(
    function() {
        console.log("Something");
        $('.phone-section').addClass("fold-up");
        $('.address').removeClass("folded");
    }
);

$('.address').on("change keyup paste",
    function() {
        if ($(this).val()) {
            $('.icon-repeat-lock').addClass("next");
        } else {
            $('.icon-repeat-lock').removeClass("next");
        }
    }
);

$('.next-button.address').click(
    function() {
        console.log("Something");
        $('.address-section').addClass("fold-up");
        $('.success').css("marginTop", 0);
        document.dataForm.submit();
    }
);