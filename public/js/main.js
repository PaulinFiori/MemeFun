$(document).ready(function() {
    var esconderRota = 0;

    $(".perfilRodape").on("click", function() {
        if(esconderRota == 0) {
            $(this).children(".fa-solid.fa-chevron-down").hide();
            $(this).children(".fa-solid.fa-chevron-right").show();
            $(".rotaPerfil").hide();
            esconderRota = 1;
        } else if(esconderRota == 1) {
            $(this).children(".fa-solid.fa-chevron-down").show();
            $(this).children(".fa-solid.fa-chevron-right").hide();
            $(".rotaPerfil").show();
            esconderRota = 0;
        }
    });
});