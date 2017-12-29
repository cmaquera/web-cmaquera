@extends('layouts.app')

@section('content')
        <section>
          <div id="blog">
                <div id="post">
            		<div class="container">
            			<div class="post">			
            					
            			</div>
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
        //alert("")
        $.ajax({
            ataType: 'json',
            type:'GET',
            url: "/dashboard/posts/" + ((window.location.href).split("/")).pop(),
            //url: window.location.href,
        }).done(function(data){
                $(".post").html('\
                            				<div class="header text-center">\
                            					<h3><b>'+ data['title'] +'</b></h3>\
                            					<p>'+ getDate(data['created_at']) +'</p>\
                            				</div>\
                            				<div class="content"><p>'+ data['content'] +'</p></div>\
                            				<div class="footer">\
                            				<p>Comentarios 1<i class="icon ion-chatbubble"></i>| Compartidos '+ data['shared'] +'<i class="icon ion-heart"></i></p>\
                            				</div>\
                            				<div class="comments">\
                            				<h2><b>Comentarios</b></h2>\
                            				<div id="disqus_thread"></div>\
                            				</div>\
                ');
        });
    });

function getDate(date) {
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var fecha = new Date(date);    
    return fecha.getDay() + ' de ' + meses[fecha.getMonth()] + ' del ' + fecha.getFullYear();
}

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://cmaquera-1.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
@endsection