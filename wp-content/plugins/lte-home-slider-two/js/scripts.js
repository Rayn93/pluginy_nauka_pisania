(function($){

    $(document).ready(function(){


        $('#lte-hs-position').keyup(function () {

            var $this = $(this);
            $('#post-info').text('Trwa zmiana pozycji');

            var post_data = {
                position: $this.val(),
                action: 'checkValidPosition'
            };

            $.post(ajaxurl, post_data, function (result) {
                $('#post-info').text(result);
            });
        });

        $('#get-last-pos').click(function () {

            $('#post-info').text('Trwa pobieranie pozycji...');

            var get_data = {
                action: 'getLastFreePosition'
            };
            
            $.get(ajaxurl, get_data, function(result) {
                $('#lte-hs-position').val(result);
                $('#post-info').text('Pozycja została pobrana.');
            });

        });



        window.send_to_editor = function(html){

            var img_url = $('img', html).attr('src');

            $('#lte-hs-slide-url').val(img_url);
            tb_remove();


            var $prevImg = $('<img>').attr('src', img_url);
            $('#slide-preview').empty().append($prevImg);

        }

        $('#select-slide-btn').click(function(){

            var url = 'media-upload.php?TB_iframe=true&type=image';

            tb_show('Wybierz slajd', url, false);

            return false;
        });

    });

})(jQuery);