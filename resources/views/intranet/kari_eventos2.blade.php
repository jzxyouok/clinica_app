<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Eventos</title>

    <meta name="description" content="with draggable and editable events" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.min.css" />
    <link rel="stylesheet" href="assets/css/chosen.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="assets/css/daterangepicker.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-colorpicker.min.css" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="no-skin">
<?php  echo view('intranet/menu'); ?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="index">Home</a>
                </li>
                <li class="active">Eventos</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Calendario de eventos
                </h1>
                <div>
                    <button id="botonNuevo" type="button" class="btn btn-primary" style="float: right;margin-top: -30px;" onclick="click_botonNuevo()">Nuevo +</button>
                </div>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="space"></div>

                            <div id="calendar"></div>
                        </div>

                        <div class="col-sm-3">
                            <div class="widget-box transparent">
                                <div class="widget-header">
                                    <h4>Buscar evento</h4>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-11">
                                                <input type="hidden" name="id"/>
                                                <input type="text" class="form-control" id="buscador" placeholder="Palabra clave.."/>
                                                <button type="button" class="btn btn-success btn-sm" id="btn-buscar">Buscar</button></td>
                                            </div>
                                        </div>
                                        &nbsp; &nbsp;
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-11" >
                                                <div id="tabla-busqueda" style='float:left;overflow-y: auto; width:250px; height: 500px;'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<?php  echo view('intranet/footer'); ?>


<!-- Popup :  Agregar -->
<form class="form-horizontal" role="form" style="padding-left: 66px;" id="form_evento">
    <div align="center">
        <div class="modal fade" id="modal_evento" role="dialog">
            <div class="modal-dialog" style="width: 500px;">
                <div class="modal-content">
                    <div class="page-header">
                        <!-- /.page-header -->
                        <button type="button" class="close" data-dismiss="modal" style="margin-right: 8px;">&times;</button>
                        <div class="space-10"></div>
                        <h1> Evento </h1>
                    </div>
                    <div class="row">
                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-3 control-label no-padding-right" for="form-field-3"> Título </label>
                            <div class="col-sm-8 col-xs-8">
                                <input id="titulo" type="text" class="form-control" placeholder="*obligatorio" required/>
                            </div>
                        </div>

                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-3 control-label no-padding-right" for="form-field-3"> Descripción </label>
                            <div class="col-sm-8 col-xs-8">
                                <textarea class="form-control" rows="10" style="resize: vertical;overflow: auto;" id="descripcion" placeholder="*obligatorio" required autocomplete="off"></textarea>
                            </div>
                        </div>

                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-3 control-label no-padding-right" for="form-field-5">Fechas y horas</label>
                            <div class="col-sm-8 col-xs-8">
                                <input class="form-control" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-xs-3 control-label no-padding-right" for="form-field-5"> Imagen </label>
                            <div class="col-sm-6 col-xs-6">
                                <input type="file" id="imagen" value="" />
                            </div>
                        </div>

                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-3 control-label no-padding-right" for="form-field-5"> Link </label>
                            <div class="col-sm-8 col-xs-8">
                                <input id="link" type="text" class="form-control" placeholder="*obligatorio" required/>
                            </div>
                        </div>

                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-3 control-label no-padding-right" for="form-field-5"> ¿En web? </label>
                            <div class="col-sm-1 col-xs-1">
                                <input id="enWeb" type="checkbox" class="form-control" checked/>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div align="center">
                            <button type="submit" id="botonSubmit" class="btn btn-primary"></button>                            &nbsp; &nbsp;
                            <button type="button" id="botonDanger" class="btn btn-primary btn-danger remove" data-dismiss="modal"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/fullcalendar.min.js"></script>
<script src="assets/js/bootbox.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->

<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/spinbox.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/daterangepicker.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/jquery.knob.min.js"></script>
<script src="assets/js/autosize.min.js"></script>
<script src="assets/js/jquery.inputlimiter.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/bootstrap-tag.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    var action;
    var action_calendar;
    jQuery('#ligestor').addClass('active open');
    jQuery('#lieventos').addClass('active');
    jQuery(function($) {

        /* initialize the external events
         -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });




        /* initialize the calendar
         -----------------------------------------------------------------*/

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();



        var calendar = $('#calendar').fullCalendar({
            //isRTL: true,
            //firstDay: 1,// >> change first day of week
            timeFormat: 'h(:mm)t',
            buttonHtml: {
                prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                next: '<i class="ace-icon fa fa-chevron-right"></i>'
            },

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: {
                url: 'service_evento',//'php-includes/events.json',
                error:function(){
                    alert("Error al cargar la agenda");
                }
            },nowIndicator:true, /*[
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    className: 'label-important'
                },
                {
                    title: 'Long Event',
                    start: moment().subtract(5, 'days').format('YYYY-MM-DD'),
                    end: moment().subtract(1, 'days').format('YYYY-MM-DD'),
                    className: 'label-success'
                },
                {
                    title: 'Some Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false,
                    className: 'label-info'
                }
            ]
            ,*/

            eventResize: function(event, revertFunc) {
                if (!confirm("La fecha de fin del evento " + event.title + " cambiará a " + moment(event._end).format('DD/MM/YYYY h:mm A') + " ¿Está seguro?")) {
                    revertFunc();
                }else{ //update date TODO
                    action = "UPDATE";
                    action_calendar = "YES";
                    click_botonSubmit(event.id,0,event._end.format("YYYY-MM-DD H:mm"));
                }
                calendar.fullCalendar('unselect');
		}, eventDrop: function(event,revertFunc) {
                if (!confirm("El evento " + event.title + " cambiará su fecha de inicio a " + moment(event._start).format('DD/MM/YYYY h:mm A') +  " y su fecha de fin a " + moment(event._end).format('DD/MM/YYYY h:mm A') + " ¿Está seguro?")) {
                    revertFunc();
                }else{
                    action = "UPDATE";
                    action_calendar = "YES";
                    click_botonSubmit(event.id,event._start.format("YYYY-MM-DD H:mm"),event._end.format("YYYY-MM-DD H:mm"));
                }
            },
            editable: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                action = "ADD"
                document.getElementById("botonSubmit").innerHTML = 'Registrar';
                document.getElementById("botonDanger").innerHTML = 'Cancelar';
                $("#modal_evento").find('input, textarea').val('').end();
                $('#imagen').ace_file_input('reset_input');
                document.getElementById("enWeb").checked=true;
                $("#modal_evento").modal();

                $('input[name=date-range-picker]').daterangepicker({ //Date range picker
                    'applyClass' : 'btn-sm btn-success',
                    'cancelClass' : 'btn-sm btn-default',
                    timePicker: true,
                    timePickerIncrement: 1,
                    locale: {
                        applyLabel: 'Apply',
                        cancelLabel: 'Cancel',
                        format: 'DD/MM/YYYY h:mm A'
                    },
                    "opens": "left",
                    "drops": "up",
                    "startDate": moment(start).format('DD/MM/YYYY h:mm A'),
                    "endDate": moment(end).format('DD/MM/YYYY h:mm A')
                }).prev().on(ace.click_event, function(){
                    $(this).next().focus();
                });

                //document.getElementById("#botonDanger").innerHTML = 'Cancelar';

             /*bootbox.prompt("New Event Title:", function(title) {
             if (title !== null) {
             calendar.fullCalendar('renderEvent',
             {
             title: title,
             start: start,
             end: end,
             allDay: allDay,
             className: 'label-info'
             },
             true // make the event "stick"
             );
             }
             });*/


             calendar.fullCalendar('unselect');
            },
            eventClick: function(calEvent, jsEvent, view) {
                action = "UPDATE";
                //$("#botonNuevo").click(action);
                document.getElementById("botonSubmit").innerHTML = 'Actualizar';
                document.getElementById("botonDanger").innerHTML = 'Eliminar';
                $("#modal_evento").modal();
                viewEvent(calEvent._start, calEvent._end, calEvent.title, calEvent.description);
             /*//display a modal
             var modal =
             '<div class="modal fade">\
             <div class="modal-dialog">\
             <div class="modal-content">\
             <div class="modal-body">\
             <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
             <form class="no-margin">\
             <label>Change event name &nbsp;</label>\
             <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
             <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
             </form>\
             </div>\
             <div class="modal-footer">\
             <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
             <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
             </div>\
             </div>\
             </div>\
             </div>';


             var modal = $(modal).appendTo('body');
             modal.find('form').on('submit', function(ev){
             ev.preventDefault();

             calEvent.title = $(this).find("input[type=text]").val();
             calendar.fullCalendar('updateEvent', calEvent);
             modal.modal("hide");
             });
             modal.find('button[data-action=delete]').on('click', function() {
             calendar.fullCalendar('removeEvents' , function(ev){
             return (ev._id == calEvent._id);
             })
             modal.modal("hide");
             });

             modal.modal('show').on('hidden', function(){
             modal.remove();
             });


             //console.log(calEvent.id);
             //console.log(jsEvent);
             //console.log(view);

             // change the border color just for fun
             //$(this).css('border-color', 'red');*/

             }

        });

        $('#id-input-file-1 , #id-input-file-2, #imagen').ace_file_input({
            no_file:'',
            btn_choose:'Selecciona',
            btn_change:'Cambia',
            droppable:false,
            onchange:null,
            thumbnail: 'small', //| large
            'allowExt': ['jpg', 'jpeg', 'png', 'img']
            //whitelist:'gif|png|jpg|jpeg',
            //blacklist:'exe|php'
            //onchange:''
            //
        });

        $('#imagen').ace_file_input('enable_reset', true);

        $('input[name=date-range-picker]').daterangepicker({ //Date range picker
            'applyClass' : 'btn-sm btn-success',
            'cancelClass' : 'btn-sm btn-default',
            timePicker: true,
            timePickerIncrement: 1,
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                format: 'DD/MM/YYYY h:mm A'
            },
            "opens": "left",
            "drops": "up"
        })
                .prev().on(ace.click_event, function(){
            $(this).next().focus();
        });
        if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
            //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-arrows ',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
        $(document).one('ajaxloadstart.page', function(e) {
            autosize.destroy('textarea[class*=autosize]')

            $('.limiterBox,.autosizejs').remove();
            $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });

        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            disableFocus: true,
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down'
            }
        }).on('focus', function() {
            $('#timepicker1').timepicker('showWidget');
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
        $('#timepicker2').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            disableFocus: true,
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down'
            }
        }).on('focus', function() {
            $('#timepicker2').timepicker('showWidget');
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

    });

    //New functions

    function click_botonSubmit(id, start, end){ //Para agregar o actualizar un evento
        if(action=="ADD"){
            alert("Add a new event");
            var fecha_ini = $("#id-date-range-picker-1").data('daterangepicker').startDate.format("YYYY-MM-DD H:mm:ss").toString();
            var fecha_fin = $("#id-date-range-picker-1").data('daterangepicker').endDate.format("YYYY-MM-DD H:mm:ss").toString();
            var file = document.getElementById('imagen').files;
            var imagen=null;
            if(file != null){
                imagen = file[0];
            }
            var act=-1;
            if( document.getElementById("enWeb").checked == true){
                act = 1;
            }else act=0;

            var form_data = new FormData();
            form_data.append('eve_titulo', $("#titulo").val());
            form_data.append('eve_fechaIn', fecha_ini);
            form_data.append('eve_fechaFin', fecha_fin);
            form_data.append('eve_descr', $("#descripcion").val() );
            form_data.append('file', imagen);
            form_data.append('eve_activo', act);
            form_data.append('eve_link', $("#link").val());

            $.ajax({
                enctype: "multipart/form-data",
                type: "POST",
                url: 'service_evento',
                beforeSend: function(xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(Response) {
                    alert(Response);
                },
                error: function(xhr) {
                    alert("Error al agregar un evento");
                }
            });
            $('#modal_evento').modal('toggle');
        }else if(action=="UPDATE"){
            alert("Edit an event");
            //Del calendario
            if(action_calendar=="YES") {
                alert(id);
                alert(start);
                alert(end);
                action_calendar = "NO";
            }else{
                alert("For modal Edit");
                $('#modal_evento').modal('toggle');
            }
        }

    }

    $("#form_evento").submit(function(event) {
        click_botonSubmit(0, 0, 0);
        event.preventDefault();
    });

    function click_botonNuevo(){//$("#botonNuevo").on("click",function(action){
        action = "ADD";
        document.getElementById("botonSubmit").innerHTML = 'Registrar';
        document.getElementById("botonDanger").innerHTML = 'Cancelar';
        $("#modal_evento").find('input, textarea').val('').end();
        document.getElementById("enWeb").checked = true;
        $('#imagen').ace_file_input('reset_input');
        $("#modal_evento").modal();
    };

    $('#btn-buscar').on("click", function() { //BUSQUEDA
        var buscar_palabra=$("#buscador").val().toString().toUpperCase();
        $('#eventos_encontrados').remove();
        $("#tabla-busqueda").append("<ol id='eventos_encontrados'><strong>Eventos encontrados:</strong></ol>");
        $('#calendar').fullCalendar('clientEvents', function(event){ //para cada evento se busca su titulo
            var titulo = event.title;
            var evento_titulo = titulo.toUpperCase();
            var descrip = event.description;
            var descrip_show = descrip.substring(0, 100); //para mostrar un limite de palabras en la descripcion de labusqueda
            var fecha_ini = moment(event._start).format('DD/MM/YYYY');
            var fecha_fin = moment(event._end).format('DD/MM/YYYY');
            var evento_descrip = descrip.toUpperCase();
            if(evento_titulo.indexOf(buscar_palabra)!==-1 || evento_descrip.indexOf(buscar_palabra)!==-1 ||
                    fecha_ini.indexOf(buscar_palabra)!==-1 || fecha_fin.indexOf(buscar_palabra)!==-1){ //buscar palabra en titulo y/o descripcion
                var goCalendar = "$(#'calendar').fullCalendar( 'gotoDate',";
                $("#eventos_encontrados").append("<li>"+
                        "<ul style='list-style-type:none'>" +
                        "<li>Título: "+titulo+"</li>" +
                        "<li>Descripción: "+descrip_show+"</li>" +
                        "<li>Fecha inicio: "+fecha_ini+"</li>" +
                        "<li>Fecha fin: "+fecha_fin+"</li>" +
                        "<li><a href='javascript:" + '$("#calendar").fullCalendar("gotoDate",' +event._start + ");'>Ver en calendario</a></li>" +
                        "<li>&nbsp;</li>"+
                        "</ul>" +
                        "</li>");
            }
        });
    });

    function viewEvent(start, end, title, descrip) { //Falta agregar link, imagen, hora fin, horaini, fechas
        //end.setDate(end.getDate()-1);
        $("#titulo").val(title);
        $("#descripcion").val(descrip);
        $('input[name=date-range-picker]').daterangepicker({ //Date range picker
            'applyClass' : 'btn-sm btn-success',
            'cancelClass' : 'btn-sm btn-default',
            timePicker: true,
            timePickerIncrement: 1,
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                format: 'DD/MM/YYYY h:mm A'
            },
            "opens": "right",
            "drops": "up",
            "startDate": moment(start).format('DD/MM/YYYY h:mm A'),
            "endDate": moment(end).format('DD/MM/YYYY h:mm A')
        }).prev().on(ace.click_event, function() {
            $(this).next().focus();
        });
    };
</script>

<script>

    $(document).ready(function() {
        $.ajax({ //Para llenar la tabla
            type: "GET",
            url: 'service_evento',
            success: function(result) {
                jQuery.parseJSON(result);
            }
        });
    });



</script>

</body>
</html>
