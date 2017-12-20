/**
 * Created by Admin on 6/8/16.
 */


// .modal-backdrop classes

$(".modal-transparent").on('show.bs.modal', function () {
    setTimeout( function() {
        $(".modal-backdrop").addClass("modal-backdrop-transparent");
    }, 0);
});
$(".modal-transparent").on('hidden.bs.modal', function () {
    $(".modal-backdrop").addClass("modal-backdrop-transparent");
});

$(".modal-fullscreen").on('show.bs.modal', function () {
    setTimeout( function() {
        $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
    }, 0);
});
$(".modal-fullscreen").on('hidden.bs.modal', function () {
    $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
});


$(function(){
    $("[name='active'], [name='published']").bootstrapSwitch();
});