<?php

class scripspaceimg {

    public function __construct() {
        
    }

    public function JSrefreshalista($path, $id) {
        ?>
        <script>
            setTimeout(function() {
                $("#loadcontent").fadeOut("fast");
                $.post("load.php", {'path': "<?php echo $path; ?>", 'id': "<?php echo $id; ?>"}, function(data) {
                    $("#loadcontent").fadeIn("fast");
                    $("#loadcontent").html(data);
                });
            }, 2000);</script>
        <?php
    }

    public function managecreadirjs($path, $id) {
        ?>
        <script>
            // OVERLAY CREAZIONE FORM PER NUOVA DIRECTORY 
            $(".apri").click(function() {
                $('#overlay').fadeIn('fast');
                $('#box').fadeIn('slow');
            });

            $(".chiudi").click(
                    function() {
                        $('#overlay').fadeOut('fast');
                        $('#box').hide();
                    });
            $("#overlay").click(function() {
                $(this).fadeOut('fast');
                $('#box').hide();
            });

            $(".creadirjs").click(function() {
                $.post("load.php", $('#frmcreadir').serialize(), function(data) {

                    $('#overlay').append(data);

                    setTimeout(function() {

                        $('#overlay').fadeOut("slow");
                        $('#box').fadeOut("slow");

                        $("#loadcontent").fadeOut("slow");
                        $.post("load.php", {'path': "<?php echo $path; ?>", 'id': "<?php echo $id; ?>"}, function(data) {
                            $("#loadcontent").fadeIn("fast");
                            $("#loadcontent").html(data);
                        });
                    }, 2000);

                });
            });

        </script>
        <?php
    }

    public function imgdefault() {
        ?>
        <script>

            $("table").tablesorter();


            $(".tablesorter tr").hover(function() {
                $(this).find('td').addClass("ui-widget-content");
            });

            $(".tablesorter tr").mouseleave(function() {
                $(this).find('td').removeClass("ui-widget-content");
            });

            /*
             function prova(){
             $.blockUI({message:"<H1><A>ATTENDERE...</a><br>Trasferimento in corso .... </H1>"});
             }
             */

            $('#reporthumb li ul').css({display: "none", left: "auto"});
            $('#tablethumb tr').hover(function() {
                $('#tablethumb tr').css('background-color', '#EE178C');
                $(this).find('#reporthumb ul').stop(true, true).slideDown('fast');
            }, function() {
                $(this).find('#reporthumb ul').stop(true, true).fadeOut('fast');
            });
            $('#reporthumb li img').hover(function() {
                $('#reporthumb li ul').css({display: "none", left: "auto"});
            });

            // SELEZIONE PER ROW IMMAGINI 
            $('#tablethumb').find(".trfileimg").click(function() {
                var obtr = $(this).find('td');
                var obj = $(this).find('input:checkbox');
                if (obj.attr("checked") === "checked") {
                    obtr.removeClass("ui-state-highlight");
                    obj.removeAttr("checked");
                } else {
                    obj.attr("checked", "checked");
                    obtr.addClass("ui-state-highlight");
                }
            });

            function checkAll(myForm, myCheck)
            {
                for (i = 0; i < myForm.elements.length; i++) {
                    myField = myForm.elements[i];
                    if (myField.name === myCheck)
                        myField.checked = true;
                }
            }

            function uncheckAll(field) {
                for (i = 0; i < field.length; i++)
                    field[i].checked = false;
            }



            $("#vedilo").hide();
            $("#showformdelete").hide();

            // FORM DELETA DIRECTORY 
            function showformdelete(r, passata, trhider) {
                $("#showformdelete").show();
                $("#pview").html(r);
                var risp = $("#risposta");
                $("#risposta").keyup(controlloform);
                var input = $("<input>").attr("type", "button").attr("name", "deletapath").val("ELIMINA LA CARTELLA").addClass("ui-state-error").css({'padding':'7px'});


                // CONTROLLO PER ELIMINAZIONE 
                function controlloform() {
                    if (r === risp.val()) {
                        $("#risposta").css({'border': '3px solid green'});

                        $("#prispinfo").html("Confermare per Eliminare completamente la Cartella .Questa operazione è irreversibile. ");
                        $("#prisp").html($(input));

                        $(input).click(function() {
                $.post("load.php", {eliminadirectory: passata ,nomedirdelete:r }).done(function(data) {
                                $("#prispres").html(data);
                               // $("#showformdelete").hide();

                                $(trhider).addClass('ui-state-higlight').fadeOut(10000);
                            });
                        });
                    } else {
                        $("#risposta").css({'border': '3px solid red'});
                        $("#prisp").html(risp.val());
                    }
                }

                $("#showformdelete span").click(function() {
                    $("#prispinfo").html('');
                    $("#prisp").html('');
                    $("#showformdelete").hide();
                     $(risp).val("");

                });


            }


            function showallimg() {

                $('#reporthumb li ul img').css({'width': '60px', 'position': 'absolute', 'float': 'left'});
                $('#reporthumb li ul').show();

            }


            function deletesingolaimg(path, idrows) {
                $.post("load.php", {'deletedalladir': path, "idrows": idrows}, function(data) {
                    $("#loadcontent").append(data);
                });
            }



            //var mychek= new Array();

            //$('#list:checkbox:checked').each(function(){mychek.push($(this).val()); });
            //console.log(print(mychek));
            // FORM SELECT PORTA TUTTI GLI INPUT E CHECKBOX DELLA LISTA 
            function selectcomandi() {
                // $.post("load.php" ,{'sceltaoperaione': $("#sceltaoperazione").val() ,'l':$('#listimg').serialize() } 
                $.post("load.php", $('#formselect').serialize()
                        , function(data) {
                    $("#loadmessage").html(data);

                });
            }


        // FUNCTION USATA PER DOWNLOAD INTERNO TRAMITE SFOGLIA RISORSE
            // $("#loadmessage").html(data);






            function uploadimginternal(data) {
        //var data = new FormData($('input[name^="uploadfile"]'),$('input[name^="nomesubdir"]'));     

                var data = new FormData($('input[name^="uploadfile"]'));

                jQuery.each($('input[name^="uploadfile"]')[0].files, function(i, file) {
                    data.append(i, file);
                });
                $.ajax({
                    type: 'POST',
                    data: data,
                    url: "load.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(datp) {
                        //alert(datp);
                        $("#loadmessage").html(datp);

                    }
                });



            }


        // function per upoloadda ext 
       // s == SELECTORE IN QUESTO CASO LA UTILIZZA ID DEL FORM
            function upext(s) {
            
            if ($('#openfileimgdaext').val() == "" ){ return ; }
                    
        $(s).append($('.miniloadiv').fadeIn()) ;
       $.post("load.php", s.serialize(), function(data) {
                    $("#loadmessage").html(data);
                                                            });
     
        
}; 



            




        </script>
        <?php
    }

}
