(function($){

    $(document).ready(function(){

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