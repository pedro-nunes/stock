(function($) {
  "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Ao cerregar a pagina, verifica o tamanho da tela do dispositivo e ocula todo menu
    $(document).ready(function() {
        if ($(window).width() < 768) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        }
        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

     /**
     * Seta o CSRF para envio de formulário por ajax
     */
     $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') }
    });

    /**
     * Envia o formulario por ajax
     */
    $('form.send-ajax').on('submit', function (e) {
        var data = $(this),
            btnLoad = data.find('.btn-load').not('#images'),
            target = data.data('target'),
            formData = new FormData(this);
        $.ajax({
            url: data.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                $('.' + target).html("<div class='progress progress-bar-info w-100'></div>");
                //btnLoad.attr('disabled', 'disabled');
                if($('.alert').length > 0) {
                    $('.alert').remove();
                }
            },
            success: function (result, textStatus, jqXHR) {
                setReturn(result, btnLoad);
                if (result.reload == true) {
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
        e.stopPropagation();
    });

    /**
     * Deletar um item
     */
    $('html').on('click', 'button.delete-confirm', function (e) {
        var url = $(this).data('url');
        $.ajax({
            url: url,
            type: 'DELETE',
            beforeSend: function (xhr) {
                $('.btn-load').attr('disabled', 'disabled');
            },
            success: function (data, textStatus, jqXHR) {
                if (data.trigger) {
                    trigger(data.trigger);
                    //$('.modal').modal('hide');
                }
                if (data.result && data.result === true) {
                    window.location.reload();
                }
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            },
        });
        e.preventDefault();
    });

    /**
     * Carrega a pré-visualização das imagens
     */
    $('input.load-image').on('change', function () {
        console.log($(this))
        var input = $(this), target = $('.' + input.attr('name'));
        if (target.find('img').length) {
            target.find('img').remove();
        }
        if (this.files) {
            var imagesCount = this.files.length;
            for (var i = 0; i < imagesCount; i++) {
                if (!this.files[i].type.match('image/*')) {
                    trigger([
                        {
                            msg: '<b>Atenção!</b> O arquivo <b>' + this.files[i].name + '</b> não é válido! Selecione uma imagem JPG, PNG ou SVG!',
                            status: 'warning',
                            icon: 'fa-exclamation-triangle',
                            redirect: false,
                            timer: 4000,
                        }
                    ]);
                    target.fadeOut('fast', function () {
                        $('.load-image-src').fadeOut('fast');
                    });
                    input.val('');
                    return false;
                }
                var reader = new FileReader();
                reader.onload = function (e) {
                    target.fadeIn('fast', function () {
                        $($.parseHTML('<img class="img-thumbnail m-1 img-fluid">'))
                            .attr('src', e.target.result).appendTo(target);
                    });
                };
                reader.readAsDataURL(this.files[i]);
            }
        }
    });

    /**
     * Busca o enredeço baseado no cep digitado e preenche os campos
     */
    $("#zip").on('blur', function () {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                $("#address").val("...");
                $("#district").val("...");
                $("#city").val("...");
                $("#state").val("...");
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (data) {
                    if (!("erro" in data)) {
                        $("#address").val(data.logradouro);
                        $("#district").val(data.bairro);
                        $("#city").val(data.localidade);
                        $("#state").val(data.uf);
                    } else {
                        clearZipForm();
                        trigger([
                            {
                                msg: '<b>Atenção!</b> CEP não encontrado',
                                status: 'warning',
                                icon: 'fa-exclamation-triangle',
                                redirect: false,
                                timer: 4000,
                            }
                        ]);
                    }
                });
            } else {
                clearZipForm();
                trigger([
                    {
                        msg: '<b>Atenção!</b> Formato do CEP inválido',
                        status: 'warning',
                        icon: 'fa-exclamation-triangle',
                        redirect: false,
                        timer: 4000,
                    }
                ]);
            }
        } else {
            clearZipForm();
        }
    });

})(jQuery); // End of use strict

function clearZipForm() {
    $("#address").val("");
    $("#district").val("");
    $("#city").val("");
    $("#state").val("");
}

function setReturn(data, btnLoad = null) {
    /** Dispara uma mensagem */
    if (data.trigger) {
        trigger(data.trigger);
    }
    /** Recebe a URL e o tempo para o redirecionamento */
    if (data.trigger && data.trigger.redirect) {
        window.setTimeout(function () {
            window.location.href = data.trigger.redirect;
        }, data.trigger.timer || 5000);
    }
    /** Habilita os botões caso o retorno não venha com redirecionamento */
    if (data.trigger && !data.trigger.redirect) {
        btnLoad.removeAttr('disabled');
    }
}

/**
 * Verifica se existe mais de 1 mensagem
 */
function trigger(data) {
    if (data[0]) {
        $.each(data, function (key) {
            triggerAlert(data[key]);
        });
    } else {
        triggerAlert(data);
    }
}

/**
 * Monta a div com a mensagem de retorno
 */
function triggerAlert(data) {
    var msgContent = `<div class="alert alert-${data.status} mt-2" role="alert">
                        <i class="fas fa-fw ${data.icon}"></i> ${data.msg}
                        <span class="alert-time"></span>
                    </div>`;
    $([document.documentElement, document.body]).animate({ scrollTop: $('.ajax-alert').offset().top });
    $('.ajax-alert').prepend(msgContent);
    $('.alert:first').stop().animate({ 'opacity': '1' }, 500, function () {
        if (data.timer) {
            $(this).find('.alert-time').animate({ 'width': '100%' }, data.timer || 5000, 'linear', function () {
                $(this).parent('.alert').animate({ 'opacity': '0' }, 500, function () {
                    $(this).remove();
                });
            });
        }
    });
    /** Remove a Mensagem ao clicar em qualquer parte dela */
    $('body').on('click', '.alert', function () {
        $(this).animate({ 'left': '100%', 'opacity': '0' }, 500, function () {
            $(this).remove();
        });
    });
}
