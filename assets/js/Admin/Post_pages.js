import '../../css/Admin/Post_pages.scss';

import $ from 'jquery';
import 'bootstrap';

$(document).ready(function () {
    CKEDITOR.replace( 'post_content', {
        language: 'en',
        customConfig: 'ckeditor_config.js',
        uiColor: '#ffffff',
        height: 500,
        filebrowserBrowseUrl: '../otherJS/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl: '../otherJS/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : '../otherJS/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700',
        extraPlugins: 'youtube',
    });
    //===================================================

    $('#poster-input-trigger').click(function () {
        document.querySelector('#post_form_posterFile').focus();
    });

    $('#post_posterFile').change(function () {
        let the_return = document.querySelector("#uploaded-poster-name");
        the_return.innerHTML = this.value.substring(12);
    });

    $('#uploaded-poster-name').on('DOMSubtreeModified', function () {
        $(this).css('display', 'block');
        $('#poster-input-trigger').html('Selected');
    });
});