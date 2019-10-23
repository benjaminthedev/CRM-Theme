/**
 * Created by benjaminthdev on 06/07/2017.
 */

/**
 * Menu BTN
 */

$('.menu_btn').click(function () {

    $(this).toggleClass('active');

    $('#main_nav').slideToggle();

});

/**
 * Flex Slider Inits
 * 1. Hero Slider
 * 2. Product Slider
 */

$('.hero_slider').flexslider({

    controlNav: false,

    prevText: '',

    nextText: '',

});

$('.product_slider').flexslider({

    controlNav: false,

    directionNav: false

});

/**
 * Flex Control
 */


$('.flex_control').click(function (e) {

    e.preventDefault();

    let control = $(this).data('control');

    let target = $(this).data('target');

    $('#' + target).flexslider(control);

});


/**
 * Client Logos
 */


$('.client_logos').webTicker({

    height: '70px',

    duplicate: true,

    rssfrequency: 0,

    startEmpty: false,

    hoverpause: true,

});


/**
 * Contact Form 7
 */

$('.wpcf7-form').submit(function () {

    setTimeout(function () {

        $('div.wpcf7-response-output').slideUp();

    }, 5000);

});

/**
 * FAQ Block
 */

$('.faq_block').click(function () {

    $(this).find('.answer').slideToggle();

});


/**
 * Select 2 Init
 */

$('.select2').select2();

/**
 * Register Form Validation
 */

$.validate({
    form: '#register_form',
    modules: 'security',
    // showErrorDialogs: false
});

let form = $('#register_form');

form.find('input[type="submit"]').on('click', function (e) {

    e.preventDefault();

    if (form.isValid())

        if (grecaptcha.getResponse())

            $.ajax({

                url: urls.ajax,

                type: 'post',

                dataType: 'json',

                cache: false,

                data: {

                    action: 'request_register',

                    form: form.serialize()

                },

                success: function (response) {

                    if (response.success) {

                        window.location.href = response.data;

                    } else

                        $('.form_response_output').html(response.data).slideDown(function () {

                            setTimeout(function () {

                                $('.form_response_output').slideUp();

                            }, 5000);
                        });

                }
            });
        else

            $('.form_response_output').html('Recaptcha has failed').slideDown(function () {

                setTimeout(function () {

                    $('.form_response_output').slideUp();

                }, 5000);

            });

    else
        $('.form_response_output').html('One or more fields have an error. Please check and try again.').slideDown(function () {

            setTimeout(function () {

                $('.form_response_output').slideUp();

            }, 5000);

        });

});

/**
 * Product Filter
 */

jQuery.fn.outerHTML = function () {

    return jQuery('<div />').append(this.eq(0).clone()).html();

};

$.product_feed_loader = function (element) {

    this.element = (element instanceof $) ? element : $(element);

    this.product_row = $('#product_row');

    this.pagination = $('#pagination');

    this.categories = $('#product_cat_filter');

    this.load_from_vars = this.has_vars();

    this.data = this.element.data();

    this.original_data = $.extend([], this.data);

};

$.product_feed_loader.prototype = {

    init_events: function () {

        let $this = this;

        $this.init_clicks();

        $this.init_categories();

        if ($this.load_from_vars) $this.run_loader();

        $this.pop_state();

    },

    init_clicks: function () {

        let $this = this;

        $this.pagination.find('a').click(function (e) {

            e.preventDefault();

            let page = $(this).data('page');

            $this.data.page = parseInt(page);

            $this.run_loader();

        });

        $('.per_page a').click(function (e) {

            e.preventDefault();

            let per_page = $(this).data('per_page');

            $this.data.page = 1;

            $this.data.per_page = parseInt(per_page);

            $this.run_loader();

        });

    },

    init_categories: function () {

        let $this = this;

        $this.categories.select2().on('change', function () {

            $this.data.cat = $(this).val();

            $this.data.page = 1;

            $this.data.per_page = 18;

            if ($this.data.cat)

                $this.run_loader();

        });

    },

    has_vars: function () {

        $.each(document.location.search.substr(1).split('&'), function (c, q) {

            let i = q.split('=') ? q.split('=') : false;

            if (i[0]) return true;

        });

        return false;

    },

    pop_state: function () {

        let $this = this;

        $(window).on("popstate", function (e) {

            let state = e.originalEvent.state;

            if (state) $this.data = state.data;

            else
                $.each($this.data, function (i, e) {

                    $this.data[i] = $this.original_data[i];

                });


            $this.load_from_vars = true;

            $this.run_loader();

        });

    },

    run_loader: function () {

        let $this = this;

        $("html, body").animate({scrollTop: $this.element.offset().top}, "slow");

        $this.element.addClass('loading');

        $.ajax({

            url: urls.ajax,

            type: 'post',

            dataType: 'json',

            cache: false,

            data: {

                action: 'product_load',

                data: $this.data

            },

            success: function (response) {

                $this.element.removeClass('loading');

                if (response.success) {

                    $this.product_row.html(response.data.content);

                    $this.pagination.html(response.data.pagination);

                    $('.per_page').each(function () {

                        $(this).html(response.data.per_page);

                    });

                    $this.init_clicks();

                    if (!$this.load_from_vars) {

                        $this.current_state = {

                            html: $this.element.html(),

                            data: $this.data

                        };

                        history.pushState($this.current_state, null, response.data.url);

                    } else {

                        $this.original_state = $this.element.html();

                        $this.load_from_vars = false;

                    }

                }

            }

        });

    }

};

let product_feed = $('#product_feed_loader');

if (product_feed.length) {

    product_feed = new $.product_feed_loader(product_feed);

    product_feed.init_events();

}

/**
 * Product Filter
 */

$('#process_order').click(function (e) {

    e.preventDefault();

    // $('.basket_wrapper').addClass('loading');

    $.ajax({

            url: urls.ajax,

            type: 'post',

            dataType: 'json',

            cache: false,

            data: {

                action: 'place_order_post'

            },

            success: function (response) {

                if (response.success) {

                    window.location.href = response.data;

                } else {

                    alert('There was an issue with the basket please contact support');

                    $('.basket_wrapper').removeClass('loading');

                }

            }
        }
    );

});