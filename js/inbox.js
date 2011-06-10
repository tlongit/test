$(document).ready(function(){
    $('.clickShowMail').click(function(){
        $(this).parent().parent().find('div.mailContent').toggle('fast');
    });
});