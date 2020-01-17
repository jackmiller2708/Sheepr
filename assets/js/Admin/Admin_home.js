import '../../css/Admin/Admin_home.scss';
import $ from 'jquery';

$(document).ready(function () {
    $('.delete-post').click(function (e) {
        e.preventDefault();
        let link = e.target.getAttribute('href');

        fetch(link, {
            method: 'DELETE'
        }).then(res => window.location.reload());
    })
});