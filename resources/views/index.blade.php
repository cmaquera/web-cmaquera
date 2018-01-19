@extends('layouts.app')

@section('content')
        
        <section>
            <!--<input class="typeahead form-control" style="margin:0px auto;width:300px;" type="text">-->
        </section>
        <section>        	
        	<div class="jumbotron text-center">
                <h1 class="display-3">CMaquera</h1>
                <p class="lead">It's more than code</p>
                <p>console.log('Una linea mas...')</p>
                <p class="lead">
                    <a class="btn btn-dark btn-lg" href="#" role="button">GitHub <i class="icon ion-social-github"></i></a>
                </p>
            </div>            
      		<hr>
      	</section>
        <section>
      	    <div id="blog">
                <div id="post">
            		<div class="container">
            			<div class="post">			
            				<div class="header text-center">
            					<h3><b>Titulo de la publicacion</b></h3>
            					<p>10 de febrero dell 2017</p>
            					<img src="images/post-image.png">
            				</div>
            				<div class="content">
            					<p>To the editors of Cosmopolitan,
            
            					I was in middle school the first time I was congratulated for being sick. I had the flu and spent several days unable to keep food down, dizzy from my own emptiness. My mother, ever an optimist, looked for the bright side. “Maybe you’ll take off a few pounds! Couldn’t hurt not to be able to eat for a few days.”
            
            					I was 11 years old.
            
            					This was a prelude to a lifetime of kudos for my own sickness. Head colds, I was told, would dull my appetite. The flu bore all the benefits of bulimia with none of the disorder. Like so many fat children, I was primed to pray for sickness, and encouraged to long for disordered eating.
            
            					    Like so many fat children, I was primed to pray for sickness.
            
            					Ten years later, I lost my grandfather to stage four lymphoma. I remember getting the call on my college campus while I walked home from the dining hall. I remember collapsing on the dirty sidewalk beneath a street lamp, 3,000 miles from the rest of my grieving family. I remember the feeling that the whole world had been torn apart, left in ragged shreds at my feet. I remember feeling certain that my life would never be the same. It wasn’t.</p>
            				</div>
            				<div class="footer">
            					<div class="read-more text-center">
            					    <a class="btn btn-outline-dark" href="#" role="button">Leer más</a>
            					</div>
            					<div class="social">
            						<p>Comentarios 1<i class="icon ion-chatbubble"></i>| Compartidos 2<i class="icon ion-heart"></i></p>
            					</div>
            				</div>	
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
    var path = "{{ route('search.posts') }}";
    $('input.typeahead').typeahead({
        display: 'posts',
        minLength: 3, 
        source: function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data['data']);
            });
        },
        displayText: function (item) {
        return item.title ;
        },
        highlighter: function(item) {
            var query = this.query;
            if(!query) {
                return '<div> ' + item + '</div>';
            }
    
            var reEscQuery = query.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
            var reQuery = new RegExp('(' + reEscQuery + ')', "gi");
    
            var jElem = $('<div></div>').html(item);
            var textNodes = $(jElem.find('*')).add(jElem).contents().filter(function () { return this.nodeType === 3; });
            textNodes.replaceWith(function() {
                return $(this).text().replace(reQuery, '<strong>$1</strong>')
            });
    
            return jElem.html();
        },
        afterSelect: function(item){
            console.log(item);
        }
    });
</script>
@endsection