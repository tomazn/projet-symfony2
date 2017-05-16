$( document ).ready(function() {

$('.sous-categorie-block').on('mouseover',function(){
    $(this).find(".sous-categorie").first().stop().slideDown();
    $(".modal-navbar-backdrop").css("display","block");
});

$('.sous-categorie-block').on('mouseleave',function(){
    $(this).find(".sous-categorie").first().stop().slideUp();
    $(".modal-navbar-backdrop").css("display","none");
});

});


