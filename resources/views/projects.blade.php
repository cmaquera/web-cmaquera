@extends('layouts.app')

@section('content')

        <section>        	
        	<div class="jumbotron text-center">
                <h1 class="display-3">Proyectos</h1>
                <p class="lead">Proyectos Realizados</p>
                <p class="lead">
                    <a class="btn btn-dark btn-lg" href="#" role="button">GitHub <i class="icon ion-social-github"></i></a>
                </p>
            </div>            
      		<hr>
      	</section>
      	<section>
          	<div id="projects">
        		<div class="container projects">
        			<div class="row">
        			</div>
        		</div>
        	</div>
      	</section>
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
            url: "/projects/data",
        }).done(function(data){
            jQuery.each(data["data"], function(i, val) {
                $(".row").append('\
                            <div id="project" class="col-md-6 m-b-lg">\
                        		<div class="panel panel-default panel-profile m-b-0">\
                        			<div class="panel-heading" style="background-image: url('+ val.url_screenshot +');"></div>\
                        		</div>\
                        		<div class="panel-body text-center">\
                        			<img class="panel-profile-img" src="//cdn.shopify.com/s/files/1/0691/5403/t/141/assets/avatar-fat.jpg?3166923016212737268">\
                        			<h5 class="panel-title"><b>'+ val.name +'</b></h5>\
                        			<p class="m-b">\
                        				'+ val.description +'\
                        			</p>\
                        			<a class="btn btn-outline-dark" href="'+ val.url_project +'" role="button">Ver</a>\
                        		</div>\
                        	</div>\
                ');
                
                console.log(i + "  -  " + val.name);
            });
        });
    });
</script>

@endsection