$( document ).ready(function() {

$('.sous-categorie-block').on('mouseover',function(e){
    e.preventDefault();
    $(this).find(".sous-categorie").first().slideDown();
});

$('.sous-categorie-block').on('mouseleave',function(e){
    e.preventDefault();
    $(this).find(".sous-categorie").first().slideUp();
});

});


