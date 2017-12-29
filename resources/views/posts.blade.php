@extends('layouts.app')

@section('content')

        <section>        	
        	  <div class="jumbotron text-center">
                <h1 class="display-3">Posts</h1>
                <p class="lead">Una publicación cada semana</p>
                <p class="lead">
                    <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#subscriberCreateForm">Suscribirse <i class="icon ion-android-notifications"></i></button>
                </p>
            </div>
            <div class="modal fade bd-example-modal-lg" id="subscriberCreateForm" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Suscribirse</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">                        
                          <form id="store-subscribers" action="/dashboard/subscribers" method="POST" role="form">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            
                            <div class="form-group">
                              <label>Nombre</label>
                              <input class="form-control" type="text" placeholder="Nombre..." name="name">
                            </div>
                            <div class="form-group">
                              <label>Correo</label>
                              <input class="form-control" type="email" placeholder="Email..." name="email">
                            </div>
                            
                          </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary store-cancel" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary store-submit">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
            <hr>
        </section>
        <section>
          <div class="posts">
          </div>
        </section>
        <div class="con" style="display: none;"></div>
        <section>
      	    <div class="creditos">
      	        <footer class="footer">
                <div class="container text-center">
                    <span class="text-muted">Todo los derechos reservados <a href="#"><b>Cesar Maquera</b></a></span>
                </div>
            </footer>
      	    </div>
      	</section>

@endsection

@section('script')

<script type="text/javascript">

$(document).ready(function() {
        $.ajax({
            ataType: 'json',
            type:'GET',
            url: "/posts/data",
        }).done(function(data){
            jQuery.each(data["data"], function(i, val) {
                $(".posts").append('\
                            <div id="blog">\
                              <div id="post">\
                            		<div class="container">\
                            			<div class="post">\
                            				<div class="header text-center">\
                            					<h3><b>'+ val.title +'</b></h3>\
                            					<p>'+ getDate(val.created_at) +'</p>\
                            				</div>\
                            				<div class="content"><p>'+ $($('.con').html($.parseHTML(($('<div />').html( val.content ).text())))).find('p:first').text() +'</p></div>\
                            				<div class="footer">\
                            					<div class="read-more text-center">\
                            					    <a class="btn btn-outline-dark" href="/posts/'+ val.id +'" role="button">Leer más</a>\
                            					</div>\
                            					<div class="social">\
                            						<p>Comentarios 1<i class="icon ion-chatbubble"></i>| Compartidos '+ val.shared +'<i class="icon ion-heart"></i></p>\
                            					</div>\
                            				</div>\
                            			</div>\
                            		</div>\
                              </div>\
                            </div>\
                ');
            });
        });
    });

$(".store-submit").click(function(){ $("#store-subscribers").submit(); })
$(".store-cancel").click(function(){ $('#store-subscribers')[0].reset(); });

$("#store-subscribers").validate({
  rules: {
    name: { required: true },
    email: { required: true, email: true }
  },
  messages: {
    name: "Debe introducir su nombre",
    email: {
      required: "Debe introducir su correo",
      email: "Ingrese un email valido"
    }
  }, 
  submitHandler: function() {
    var form_action = $("#store-subscribers").attr("action");
    $.ajax({
      ataType: 'json',
      type:'POST',
      url: form_action,
      data: $('#store-subscribers').serialize(),
    }).done(function(data){
      $('#store-subscribers')[0].reset();      
      $("#subscriberCreateForm").modal('hide');
      swal({
        type: 'success',
        title: data['name'],
        html: data['message'],
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Sigueme!'
      }).then((results) => {
        if(results.value){
          
        }
      })
    });
  }
});

function getDate(date) {
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var fecha = new Date(date);    
    return fecha.getDay() + ' de ' + meses[fecha.getMonth()] + ' del ' + fecha.getFullYear();
}
</script>

@endsection