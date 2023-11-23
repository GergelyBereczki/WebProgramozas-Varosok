function mo_megyek() {
    $.post(
        "../includes/kiolvas.inc.php",
        {"op" : "momegyek"},
        function(data) {
            $("<option>").val("0").text("Válasszon ...").appendTo("#meselect");

            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                $("<option>").val(lista[i].id).text(lista[i].nev).appendTo("#meselect");
        
        },
        "json"                                                    
    );
};

// JÓ!

function mo_varosok() {
    $("#vkselect").html("");
    $("#evselect").html("");
    $(".adat").html("");
    var megyeid = $("#meselect").val();

    if (megyeid != 0) {
        $.post(
            "../includes/kiolvas.inc.php",
            {"op" : "varos", "id" : megyeid},
            function(data) {

                $("#vkselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#vkselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
            },
            "json"                                                    
        );
    }
}

//jó!!!

function evek() {
    $("#evselect").html("");
    $(".adat").html("");
    var varosid = $("#vkselect").val();
    if (varosid != 0) {
        $.post(
            "../includes/kiolvas.inc.php",
            {"op" : "lelekszam", "id" : varosid},
            function(data) {
                $("#evselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#evselect").append('<option value="'+lista[i].id+'">'+lista[i].ev+'</option>');
            },
            "json"                                                    
        );
    }
}

function ev() {
    $(".adat").html("");
    var ev = $("#evselect").val();
    
    if (ev != 0) {
        $.post(
            "../includes/kiolvas.inc.php",
            {"op" : "info", "id" : ev},
            function(data) {
                $("#ev").text(data.ev);
                $("#no").text(data.no);
                $("#osszesen").text(data.osszesen);
            },
            "json"                                                    
        );
    }
}


$(document).ready(function() {
   mo_megyek();
   
   $("#meselect").change(mo_varosok);
   $("#vkselect").change(evek);
   $("#evselect").change(ev);
   
   $(".adat").hover(function() {
        $(this).css({"color" : "white", "background-color" : "black"});
    }, function() {
        $(this).css({"color" : "black", "background-color" : "white"});
    });
});
