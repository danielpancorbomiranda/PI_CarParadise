$(document).ready(function() {

    $("div.cabeceraHistorial").click(acordeonMiHistorial);

    $('#iniciaSesionUsuario').click(logueoClienteIndex);

    $("div#marcasDeVehiculos div").mouseover(animacionOver);

    $("div#marcasDeVehiculos div").mouseout(animacionOut);

    $("#FechaInicio, #FechaFin").change(calculaPrecio);

    $(".verTelefonoEmail").click(verTelefonoEmail);

    $(".conectando").click(conectando);

    $(".botonVerVideo").click(permutaImagenVideo);

    $("#liAreaPersonal a").click(mostrarAreaPersonal);

    $("#Dni").keyup(valida);

	$("div#ContenidoResultados").hide();

	$(".owl-carousel").owlCarousel ({
		loop:true,
		margin:5,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: false,
		nav:true,
		responsive: {
			0:{
				items:1

			},
			600:{
				items:3,
			},
			1000:{
				items:5
			}
		}

	});
	
    $("span.FechaInicio").fadeOut(4000).fadeIn(2000).fadeOut(4000).fadeIn(2000);
    $("div.cajaCarParadise").fadeOut(4000).fadeIn(2000).fadeOut(4000).fadeIn(2000); // para q aparezca mas tarde
    $("span.x").click (cerrarVentanaEmergente);
    $("span.xBanner").click (cerrarVentanaEmergenteBanner);
    $("div.cajaSesion a span").mouseover(function () {
        $("div.cajaSesion h4").css("opacity", "0.3");
    });
    $("div.cajaSesion a span").mouseout(function () {
        $("div.cajaSesion h4").css("opacity", "1");
    });
    $("div.cajaSesion a span").click (function (e){
        $(this).attr("class", "glyphicon glyphicon-check");
    });

    $("#botonFiltrar").click(function(e){
        e.preventDefault();
        // var marcaV = $('#Marca').val(); // estas variables se enviaran por ajax
        // var modeloV = $('#Modelo').val();
        // var combustibleV = $('#Combustible').val();
        // var kmV = $('#Km').val();
        // var categoriaV = $('#Categoria').val();
        // var baseV = $('#Base').val();
        // console.log(marcaV, modeloV, combustibleV, kmV, categoriaV, baseV);
        var datosFormulario=$("#formBuscar").serialize(); // obtener los valores, 
        console.log(datosFormulario);
        $.ajax({
            // data: {Marca:marcaV, Modelo:modeloV, Combustible:combustibleV, Km:kmV, Categoria:categoriaV, Base:baseV},
            data: datosFormulario,
            type:"POST",
            // dataType:"json", 
            url:"http://carparadise.dpm/application/_ajax/BuscaTuVehiculo/_ajaxBuscaTuVehiculo.php",
            beforeSend:function() 
            { // una vez q se envia se ejecutara lo de los corchetes
                $('#botonFiltrar').val("Filtrando ..."); // valor de un mensaje para comprobar q el boton funciona
            },
            success: function (data) 
            {
                $("div#noEncontrado").slideUp('slow'); 
                $('#botonFiltrar').val("Filtrar");
                if (data != 'sin datos regresados')
                {
                    $("div#ContenidoResultados").show();
                    $("#inner-header2").slideUp('slow'); 
                    $("#seccion").css("margin-top", "9.2em");
                    $("#Tbody").contents().remove();    
                }
                else 
                {                   
                    $("div#noEncontrado").slideDown('slow'); 
                }
            }
        }).done(function (data)
        {
            console.log(data);
            if (data != 'sin datos regresados')
            {
                var parseado2 = $.parseJSON(data); 
                $("section#seccion h3").html ("Búsqueda con filtro: "+parseado2.length+" vehículo(s) encontrado(s)")
                for (var i in parseado2)
                {   
                    ruta="http://carparadise.dpm/index.php/cOtrasPaginas/fReserva/";
                    if (parseado2[i].Estado == 'Disponible')
                    {
                        ruta=ruta+parseado2[i].Matricula;
                        enlace="<a href='"+ruta+"'><span class='glyphicon glyphicon-road'></span></a>";
                    }
                    else 
                    {
                        enlace="<span class='glyphicon glyphicon-minus-sign'></span>";
                    }
                    $("#Tbody").append("<tr class='success'><td style='background-color:"+parseado2[i].Color+"'></td><td>"+parseado2[i].NombreCategoria+"</td><td><b>"+parseado2[i].Matricula+"</b></td><td>"+parseado2[i].Marca+"</td><td>"+parseado2[i].Modelo+"</td><td>"+parseado2[i].Km+"</td><td>"+parseado2[i].Combustible+"</td><td>"+parseado2[i].NombreBase+"</td><td>"+parseado2[i].Localidad+"</td><td>"+parseado2[i].Estado+"</td><td class='danger'>"+enlace+"</td></tr>"); // para que habra un append en el padre, es decir un td nuevo 
                }
            }
        });
    });



});

function cerrarVentanaEmergente () {
    $(this).parent().slideUp('slow');
}
function cerrarVentanaEmergenteBanner () {
    $(this).parent().parent().slideUp('slow');    
    $(this).parent().parent().parent().next().css("margin-top", "9.2em");
    // $("div#principal").css("margin-top", "9em");
    // $("section#seccion").css("margin-top", "9em");
}
function cerrarVentanaEmergenteBannerCuandoReservo () {
    $("#inner-header2").slideUp('slow');    
    $("div#principal").css("margin-top", "9.2em");
}
function quitaBotonReservarPorInfo () { // no e.preventDefault() porque sí quiero que haga eso
    // e.preventDefault();
    var matricula=$("#matriculaEnLi").text();
    var dni=$("#Dni").val();
    $("#botonReservar").parent().html("<div style='font-size:150%;' class='alert alert-success'>Reserva realizada con éxito para el vehículo <b>"+matricula+"</b> con referencia <b>"+dni+"</b>.</div>");
    // return false;
    cerrarVentanaEmergenteBannerCuandoReservo();
}

function valida(){	
	switch(this.id) {
		case "Dni":
		var numero;
  		var letr;
  		var letra;
		var expresion_regular_dni;
		expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

		if(expresion_regular_dni.test (this.value) == true){
    		numero = this.value.substr(0,this.value.length-1);
     		letr = this.value.substr(this.value.length-1,1);
     		numero = numero % 23;
     		letra='TRWAGMYFPDXBNJZSQVHLCKET';
     		letra=letra.substring(numero,numero+1);
			if ((letra!=letr.toUpperCase())) {
				$(this).css({borderColor: "darkred", color: "darkred"});
                // $("#FechaInicio, #FechaFin").removeAttr("readonly");
                $("#PrecioAlquiler").val("");
                $("#PrecioBase").val("");
                $("#botonReservar").parent().slideUp('slow');

				return false;
			}
			else
			{
				$(this).css({borderColor: "darkgreen", color: "darkgreen"});
                // $("#FechaInicio, #FechaFin").attr("readonly", "readonly");
                $("#botonReservar").parent().slideDown('slow');
                calculaPrecio();
				return true;
			}
		}
		else
		{
            $(this).css({borderColor: "orangered", color: "orangered"});
            $("#PrecioAlquiler").val("");
            $("#PrecioBase").val("");
            // $("#FechaInicio, #FechaFin").removeAttr("readonly");
            $("#botonReservar").parent().slideUp('slow');
			return false;
		}
			break;
		default:		
	}
}
function calculaPrecio () {
    var fechaI=Date.parse($("#FechaInicio").val());
    var fechaF=Date.parse($("#FechaFin").val());
    var diasReservados= Math.floor ( ( fechaF - fechaI ) / 86400000);
    if (diasReservados <= 1 && diasReservados >= 0)
    {
        var precioFinal=39;
        $("#PrecioBase").val("");
    }
    else
    {   
        var rebajaKms=$("#KmsEnLi").val()*0.005;
        precioBase=(diasReservados*45)-rebajaKms; // 45 he pensado el precio por dia
        $("#PrecioBase").val(precioBase);
        var porcentaje=$("#IdBono").val()/100;
        var precioFinal=precioBase-(precioBase*(porcentaje));
    }
    if (precioFinal > 0)
    {
        $("#PrecioAlquiler").val(precioFinal);
    }
    else
    {
        $("#PrecioAlquiler").val("");
        $("#PrecioBase").val("");
    }
}
function conectando() {
    $(this).val("Conectando . . .");
    var divModal=$("<div class='divModal'></div>").css({"position":"fixed","width":"100%",
                                                    "height":"100%","background-color":"darkred",
                                                    "z-index":"55","top":"0px",
                                                    "left":"0px","opacity":"0.7"});	
    var gifCargando="<div class='divGif'><img class='divGif' alt='no ruta' src='./../application/_imagenesCSS/cargando/cargando.gif' /></div>";
    divModal.append(gifCargando);
    divModal.appendTo($("body"));
    // $("div.divModal div.divGif").css({"margin-top": "16%", "width":"100%", "text-align":"center"});	
    $("div.divModal div.divGif").css({"justify-content":"center","display": "flex", "align-items": "center", "height":"100%", "width":"100%"});	
}
function permutaImagenVideo(e) {
    e.preventDefault()
    if ( $(this).text() == "Ver video" )
    {
        $(this).text('Ver imágen');
    }
    else 
    {
        $(this).text('Ver video');
    }
    $("div.datosVehiculo img").slideToggle();
    $("div.datosVehiculo video").slideToggle();
}
function verTelefonoEmail (e) {
  e.preventDefault();
  $(this).children().toggle();
}
function mostrarAreaPersonal() {
    $(".cajaLogoGif").toggle();
    $(".cajaAreaPersonal").toggle();
    return false;
}
function animacionOut() {
    // $("div#marcasDeVehiculos div").animate({opacity:1},1);
    $("div#marcasDeVehiculos div").css({opacity:1});
}
function animacionOver() {
    // $("div#marcasDeVehiculos div").animate({opacity:0.5},1); // 1 -> son milisegundos
    // $(this).animate({opacity:1},1);
    $("div#marcasDeVehiculos div").css({opacity:0.5});
    $(this).css({opacity:1});
}
function logueoClienteIndex (){
    var dniV = $('#cajaDniUsuario').val(); // estas variables se enviaran por ajax
    var contrasenaV = $('#cajaContrasenaUsuario').val();
    
    if($.trim(dniV).length > 0 && $.trim(contrasenaV).length > 0)
    { // comprobar q se haya ingresada algo en los campos, sino no hará nada, si si, el ajasx enviara a otro php
        $.ajax({ 
            url:"http://carparadise.dpm/application/_ajax/LoguinIndex/ajaxLoguinCliente.php", // url q validara el login
            method:"POST",
            data:{dniPasar:dniV, contrasenaPasar:contrasenaV}, // lo que vamos a enviar. POST y VARIABLES
            cache:"false",
            beforeSend:function() { // una vez q se envia se ejecutara lo de los corchetes
                $('#iniciaSesionUsuario').val("Verificando ..."); // valor de un mensaje para comprobar q el boton funciona
            },
            success:function(data) 
            {
                //console.log(data);
                $('#iniciaSesionUsuario').val("Iniciar sesión"); // valor por defecto del boton
                if (data == "Usuario no encontrado.") 
                { 
                    alert("No encontrado el usuario con DNI '"+dniV+"' y contraseña '"+contrasenaV+"'. Compruebe sus datos. Le doy consentimiento para probar con esta: 77345252R y dpm.")
                    // $("#result").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>No coincide:</strong> indroduzca bien los campos.</div>");
                }
                else if (data == "No existe POST.")
                {
                    alert('Error al enviar los datos de los campos.');
                }
                else
                {
                    // console.log(data);
                    // var parseado = $.parseJSON(data);
                    // console.log(parseado);
                    // $("div.cajaAreaPersonal div").eq(0).html("<span>"+parseado.NombreCliente+" "+parseado.Apellido1Cliente+" "+parseado.Apellido2Cliente+"</span>"); //.load('pantallaChat.php'); // aqui donde y html()
                    // $("div.cajaAreaPersonal div").eq(1).html("<span>"+parseado.Dni+"</span>");
                    // $("div.cajaAreaPersonal div").eq(2).html("<input class='botonesIndex' name='Desconecta' type='button' value='Desconexión'/>");

                    // NOTA: me quedé con las ganas de deprobar y regresar un return del array al ajaxLoguinCliente.php
                    
                    $("div.cajaAreaPersonal").html(data);
                } 
            }
        });
    }
    else
    {
        alert('Por favor, rellene ambos campos para iniciar sesión. Le doy consentimiento para probar con esta: 77345252R y dpm.');
    }
}
function acordeonMiHistorial() {
    if ($(this).children().eq(2).hasClass("glyphicon-chevron-right"))
    {
        $(this).children().eq(2).removeClass("glyphicon-chevron-right");
        $(this).children().eq(2).addClass("glyphicon-chevron-down").css("color", "white");
        
    }
    else
    {
        $(this).children().eq(2).removeClass("glyphicon-chevron-down");
        $(this).children().eq(2).addClass("glyphicon-chevron-right").css("color", "darkred");
    }
    $(this).next().slideToggle();
}