'use strict';

$(function () {
    $(document)
        .on('click', '.horoscope .item', function (e) {
            e.preventDefault();
            var _this = $(this),
                name = _this.data('name'),
                modal = new Custombox.modal({
                    content: {
                        effect: 'fadein',
                        target: '/horoscope/ajax/' + name + '/today'
                    }
                });

            modal.open();
        })
        .on('click', '.horoscope-popup .plan', function (e) {
            e.preventDefault();
            var _this = $(this),
                name = _this.data('name'),
                sort = _this.data('sort');

            $.ajax({
                method: "POST",
                url: '/horoscope/ajax/' + name + '/' + sort,
                dataType:'json',
                data: {
                    is_sort: 1
                }
            })
                .done(function (response) {
                    $('#horoscope-popup').html(response.html);
                });
        });
});
