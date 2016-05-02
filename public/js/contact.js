
$(function () {
    /* BOOTSNIPP FULLSCREEN FIX */
    if (window.location == window.parent.location) {
        $('#back-to-bootsnipp').removeClass('hide');
    }

    $('#updateform').submit(function(e){
        e.preventDefault();
    })


    $('[data-toggle="tooltip"]').tooltip();

    $('#fullscreen').on('click', function(event) {
        event.preventDefault();
        window.parent.location = "http://bootsnipp.com/iframe/4l0k2";
    });


    $('[data-command="toggle-search"]').on('click', function(event) {
        event.preventDefault();
        $(this).toggleClass('hide-search');

        if ($(this).hasClass('hide-search')) {
            $('.c-search').closest('.row').slideUp(100);
        }else{
            $('.c-search').closest('.row').slideDown(100);
        }
    })

    $('#contact-list').searchable({
        searchField: '#contact-list-search',
        selector: 'li',
        childSelector: '.col-xs-12',
        show: function( elem ) {
            elem.slideDown(100);
        },
        hide: function( elem ) {
            elem.slideUp( 100 );
        }
    })

});
function AddUser(x,id)
{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#'+x).fadeOut(1000,'linear',function(){
        $('#'+x).remove();

    });

    $().toastmessage('showSuccessToast', x+" ajoute avec succes");


    // AJAX GET
    /*
    $.get('getRequest',function(data){
        console.log(data);
        $('#testy').append(data);
    })*/
    $.post('addUser', { id:id} , function(data){
        console.log(data);
        $('#testy').append(data);
    });


}

function DelUser(x,id)
{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#'+x).fadeOut(1000,'linear',function(){
        $('#'+x).remove();

    });

    $().toastmessage('showErrorToast', x+" supprim� avec succes");


    // AJAX GET
    /*
     $.get('getRequest',function(data){
     console.log(data);
     $('#testy').append(data);
     })*/
    $.post('delUser', { id:id} , function(data){
        console.log(data);
        $('#testy').append(data);
    });


}

function AddWorkout(id){

    var i = 1;
    var liste_name = new Array();
    var liste_serie = new Array();
    var liste_repetition = new Array();
    var liste_repos = new Array();
    var strWorkout ="";
    while(document.getElementById("serie"+i) != null){
        var serie = document.getElementById("serie"+i);
        var value_serie= serie.options[serie.selectedIndex].value;

        var exo = document.getElementById("exo"+i);
        var  value_exo= exo.options[exo.selectedIndex].value;

        var repet = document.getElementById("repet"+i);
        var  value_repet= repet.options[repet.selectedIndex].value;

        var minute = document.getElementById("minute"+i);
        var value_minute = minute.options[minute.selectedIndex].value;
        console.log(value_exo+" "+value_serie);
        strWorkout += value_exo + " Serie:"+value_serie + " Repet:"+value_repet +" Repos:"+value_minute+'\n' ;

        liste_name.push(value_exo);
        liste_serie.push(value_serie);
        liste_repetition.push(value_repet);
        liste_repos.push(value_minute);

        i++;

    }
    $().toastmessage('showSuccessToast', "Nouveau workout ajoute avec succes");
    $.post('addWorkout',
        {
            _token: $('meta[name=csrf-token]').attr('content'),
            id: id,
            serie:liste_serie,
            repetition:liste_repetition,
            repos:liste_repos,
            name :liste_name,
            number : i-1

        })



}

function AddLine(name){

    var i=1;
    while(document.getElementById("serie"+i) != null){
        i++;
    }
    var e = document.getElementById(name);
    var serie = serie+i;
    var newworkout =  "<select id=exo"+i+"> " +
        "<option value='Curl barre'>Curl Barre</option>" +
        "<option value='Curl incline'>Curl incline</option>" +
        "<option value='Tractions'>Tractions</option> " +
        "<option value='Rowing buste penche'>Rowing buste penche</option>" +
        "<option value='Traction supination'>Traction supination</option>" +
        "<option value='Souleve de terre'>Souleve de terre</option>" +
        "<option value='Clean & press'>Clean & press</option> " +
        "<option value='Elevations laterales'>Elevations laterales</option>" +
        "<option value='Squat frontal'>Squat frontal</option>" +
        "<option value='Fentes'>Fentes</option>" +
        "<option value='Developpe incline haltere'>Developpe incline haltere</option> " +
        "<option value='Developpe couche'>Developpe couche</option>" +
        "<option value='Pull over'>Pull over</option>" +
        "<option value='Dips sur banc'>Dips sur banc</option>" +
        "<option value='Dips lestes'>Dips lestes</option> " +
        "<option value='Skull Crusher'>Skull Crusher</option>" +


    "</select> " +
    "<select id=serie"+i+"> " +
    "<option value='1'>1 Serie</option> " +
    "<option value='2'>2 Serie</option> " +
    "<option value='3'>3 Serie</option> " +
    "<option value='4'>4 Serie</option> " +
    "</select> " +
    "<select id=repet"+i+"> " +
    "<option value='1'>1 repet</option>" +
    "<option value='2'>2</option> " +
    "<option value='3'>3</option> " +
    "<option value='4'>4</option> " +
    "</select> " +
    "<select id=minute"+i+"> " +
    "<option value='1'>1 min de repos</option> " +
    "<option value='2'>2</option> " +
    "<option value='3'>3</option> " +
    "<option value='4'>4</option> " +
    "</select>"+"<br>"
    e.innerHTML += newworkout;

}

function AddLine_update(name){

    var i=1;
    while(document.getElementById("serieUpdate"+i) != null){
        i++;
    }
    var e = document.getElementById(name);
    var serie = serie+i;
    var newworkout =  "<select id=exoUpdate"+i+"> " +
        "<option value='Curl barre'>Curl Barre</option>" +
        "<option value='Curl incline'>Curl incline</option>" +
        "<option value='Tractions'>Tractions</option> " +
        "<option value='Rowing buste penche'>Rowing buste penche</option>" +
        "<option value='Traction supination'>Traction supination</option>" +
        "<option value='Souleve de terre'>Souleve de terre</option>" +
        "<option value='Clean & press'>Clean & press</option> " +
        "<option value='Elevations laterales'>Elevations laterales</option>" +
        "<option value='Squat frontal'>Squat frontal</option>" +
        "<option value='Fentes'>Fentes</option>" +
        "<option value='Developpe incline haltere'>Developpe incline haltere</option> " +
        "<option value='Developpe couche'>Developpe couche</option>" +
        "<option value='Pull over'>Pull over</option>" +
        "<option value='Dips sur banc'>Dips sur banc</option>" +
        "<option value='Dips lestes'>Dips lestes</option> " +
        "<option value='Skull Crusher'>Skull Crusher</option>" +
        "</select> " +
        "<select id=serieUpdate"+i+"> " +
        "<option value='1'>1 Serie</option> " +
        "<option value='2'>2 Serie</option> " +
        "<option value='3'>3 Serie</option> " +
        "<option value='4'>4 Serie</option> " +
        "</select> " +
        "<select id=repetUpdate"+i+"> " +
        "<option value='1'>1 repet</option>" +
        "<option value='2'>2</option> " +
        "<option value='3'>3</option> " +
        "<option value='4'>4</option> " +
        "</select> " +
        "<select id=minuteUpdate"+i+"> " +
        "<option value='1'>1 min de repos</option> " +
        "<option value='2'>2</option> " +
        "<option value='3'>3</option> " +
        "<option value='4'>4</option> " +
        "</select>"+"<br>"
    e.innerHTML += newworkout;

}


function UpdateWorkout(id_workout,id){

    var i = 1;
    var id_workout = id_workout;
    var liste_name = new Array();
    var liste_serie = new Array();
    var liste_repetition = new Array();
    var liste_repos = new Array();
    var strWorkout ="";
    while(document.getElementById("serieUpdate"+i) != null){
        var serie = document.getElementById("serieUpdate"+i);
        var value_serie= serie.options[serie.selectedIndex].value;

        var exo = document.getElementById("exoUpdate"+i);
        var  value_exo= exo.options[exo.selectedIndex].value;

        var repet = document.getElementById("repetUpdate"+i);
        var  value_repet= repet.options[repet.selectedIndex].value;

        var minute = document.getElementById("minuteUpdate"+i);
        var value_minute = minute.options[minute.selectedIndex].value;
        console.log(value_exo+" "+value_serie);
        strWorkout += value_exo + " Serie:"+value_serie + " Repet:"+value_repet +" Repos:"+value_minute+'\n' ;

        liste_name.push(value_exo);
        liste_serie.push(value_serie);
        liste_repetition.push(value_repet);
        liste_repos.push(value_minute);

        i++;

    }
    $().toastmessage('showSuccessToast', "Modification effectue avec succes");


    $.ajax({
        cache: true,
        type: "POST",
        dataType: 'json',
        url: '/user/updateWorkout',
        data: {
            _token: $('meta[name=csrf-token]').attr('content'),
            serie:liste_serie,
            repetition:liste_repetition,
            repos:liste_repos,
            name :liste_name,
            number : i-1,
            id_workout: id_workout,
            id : id
        },
        
        error: function() {
            console.log("Data didn't get sent!!");
        }


    });





}

function DeleteWorkout(id_workout,id)
{

    if (confirm("Voulez-vous vraiment supprimer ce workout ? ") == true) {
        $.post('deleteWorkout',
            {
                _token: $('meta[name=csrf-token]').attr('content'),
                id_workout: id_workout,
                id : id,

            })
    }

}

function RemoveLine_update(name){

    var i = 1;
    while(document.getElementById("serieUpdate"+i) != null){
        i++;
    }
    i = i-1;
    document.getElementById("divUpdate"+i).remove();

}

