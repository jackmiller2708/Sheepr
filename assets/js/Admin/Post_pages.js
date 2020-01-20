import '../../css/Admin/Post_pages.scss';

import $ from 'jquery';
import 'bootstrap';

$(document).ready(function () {
    CKEDITOR.replace( 'post_content', {
        customConfig: 'ckeditor_config.js',
        uiColor: '#ffffff',
        height: 1423,
        filebrowserBrowseUrl: '../otherJS/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl: '../otherJS/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : '../otherJS/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700',
        extraPlugins: 'youtube',
    });

    CKEDITOR.replace( 'post_installation', {
        customConfig: 'ckeditor_config.js',
        uiColor: '#ffffff',
        filebrowserBrowseUrl: '../otherJS/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl: '../otherJS/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : '../otherJS/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700',
    });
    //===================================================

    $('#post_posterFile').change(function () {
        let the_return = document.querySelector("#uploaded-poster-name");
        if (this.value !== ""){
            the_return.innerHTML = this.value.substring(12);
            $('#poster-input-trigger').html('Selected');
            $('#uploaded-poster-name').css('display', 'block');
        }
        else{
            $('#poster-input-trigger').html('Choose a poster image...');
            $('#uploaded-poster-name').css('display', 'none');
        }
    });
});