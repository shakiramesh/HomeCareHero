$(document).ready(function(){
    // ... (Your existing JavaScript code remains unchanged) ...
    $('.star').click(function(){
        var forval = parseInt($(this).attr('for')) + 1;
        $('#rating').val(forval);
        $('.star').each(function(index){
            if ((index+1) < forval){
                $(this).removeClass('fa-star-o').addClass('fa-star');
            } else{
                $(this).removeClass('fa-star').addClass('fa-star-o');
            }
        });
    });
});
