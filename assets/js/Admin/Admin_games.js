import '../../css/Admin/Admin_games.scss';
import $ from 'jquery';
// import Chart  from 'chart.js';

$(document).ready(function () {
    $('.delete-post').click(function (e) {
        e.preventDefault();
        let link = e.target.getAttribute('href');

        fetch(link, {
            method: 'DELETE'
        }).then(res => window.location.reload());
    });

});

// var getDaysInMonth = function(month,year) {
//     // Here January is 1 based
//     //Day 0 is the last day in the previous month
//     return new Date(year, month, 0).getDate();
// // Here January is 0 based
// // return new Date(year, month+1, 0).getDate();
// };