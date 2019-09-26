/*start function*/
jQuery(document).ready(function ($) {

    /*click event*/
    $('.cbx_setting_file_wrap').on('click', '.cbx_setting_file_btn', function (e) {
        e.preventDefault();

        var $this = $(this); //which has been clicked
        var $parent = $this.closest('.cbx_setting_file_wrap'); //parent wrapper of clicked item

        //take instance of wp.media
        var mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false
        });

        //set event what will happen on select of image
        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            //console.log(attachment);

            /*parent data*/
            $parent.find('.cbx_setting_file_input').val(attachment.title);

            //console.log($parent.find('.cbx_setting_file_input'));
            //console.log(attachment.url);


            //$('.settingsoption_custom-settingsoption_image, .settingsoption_custom-settingsoption_image2').val(attachment.url);

        });

        //this will open the window
        mediaUploader.open();
    });//end click event

});//end function
