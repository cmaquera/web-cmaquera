@extends('layouts.app')

@section('content')

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
              <h1>Posts</h1>
              <div>
                <button type="button" class="btn btn-primary add-post" data-toggle="modal" data-target="#postCreateForm"><i class="icon ion-android-add-circle"></i> Crear post</button>
                <button type="button" class="btn btn-primary add-tag" data-toggle="modal" data-target="#tagCreateForm"><i class="icon ion-android-add-circle"></i> Crear tag</button>
              </div>
              <h2>Publicaciones</h2>
              <div class="table-responsive">
                <table id="datatable-posts" class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Titulo</th>
                      <th>Url</th>
                      <th>Estado</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div>                
                <!-- Create Modal -->
                <div class="modal fade bd-example-modal-lg" id="tagCreateForm" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="store-tags" action="/dashboard/tags" method="POST" role="form">
                            {{ csrf_field() }}  {{ method_field('POST') }}
                            @include('layouts._ftag')
                          </form>                         
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary store-submit-tag">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>                
                <!-- Create Modal -->
                <div class="modal fade bd-example-modal-lg" id="postCreateForm" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="store-posts" action="/dashboard/posts" method="POST" role="form">
                            {{ csrf_field() }}  {{ method_field('POST') }}
                            @include('layouts._fpost', ['editable' => 'store-editable'])
                          </form>                         
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary store-submit">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>                
                <!-- Edit Modal -->
                <div class="modal fade bd-example-modal-lg" id="postEditForm" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="update-posts" method="POST" role="form">
                            {{ csrf_field() }}  {{ method_field('PATCH') }}
                            <input type="hidden" name="id"/>
                            @include('layouts._fpost', ['editable' => 'update-editable'])
                          </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary update-submit">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </main>            

@endsection

@section('script')

<script type="text/javascript">
  var table;
    $(document).ready(function() {
        table = $('#datatable-posts').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/posts/data",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'url', name: 'url'},
                {data: 'published', name: 'published'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ] 
        });
        
    });
  
            var editor1 = new MediumEditor('.store-editable', {
                elementsContainer: document.getElementById('postCreateForm'),
                placeholder: false,
                toolbar: {
                    buttons: [
                        {
                            name: 'h3',
                            action: 'append-h4',
                            aria: 'header type 3',
                            tagNames: ['h4'],
                            contentDefault: '<b>H3</b>',
                            classList: ['custom-class-h3'],
                            attrs: {
                                'data-custom-attr': 'attr-value-h2'
                            }
                        },
                        'bold',
                        'italic',
                        'underline',
                        'anchor',
                        'quote',
                        'pre',
                        'orderedlist',
                        'unorderedlist',
                        'justifyLeft',
                        'justifyCenter',
                        'justifyRight',
                        'justifyFull'
                    ]
                }
            });
            var editor2 = new MediumEditor('.update-editable', {
                elementsContainer: document.getElementById('postEditForm'),
                placeholder: false,
                toolbar: {
                    buttons: [
                        {
                            name: 'h3',
                            action: 'append-h4',
                            aria: 'header type 3',
                            tagNames: ['h4'],
                            contentDefault: '<b>H3</b>',
                            classList: ['custom-class-h3'],
                            attrs: {
                                'data-custom-attr': 'attr-value-h2'
                            }
                        },
                        'bold',
                        'italic',
                        'underline',
                        'anchor',
                        'quote',
                        'pre',
                        'orderedlist',
                        'unorderedlist',
                        'justifyLeft',
                        'justifyCenter',
                        'justifyRight',
                        'justifyFull'
                    ]
                }
            });
            
    $(".add-tag").click( function() { $('#store-tags')[0].reset(); });
    
    $(".store-submit-tag").click(function(){ $("#store-tags").submit(); });
    
    $("#store-tags").validate({
      rules: {
        name: { required: true }
      },
      messages: {
        name: "Debe introducir el nombre del tag"
      }, 
      submitHandler: function() {
        var form_action = $("#store-tags").attr("action");
        $.ajax({
          dataType: 'json',
          type:'POST',
          url: form_action,
          data: new FormData($('#store-tags')[0]),  //$('#store-projects').serialize(),
          contentType: false,
          processData: false,
        }).done(function(data){
          $('#store-tags')[0].reset();
          $("#tagCreateForm").modal('hide');
          swal(
            data['name'],
            data['message'],
            'success'
          )
        });
      }
    });
    
    
    $(".add-post").click( function() { 
        $('#store-posts')[0].reset(); 
        $("select[name='tag_id']").empty();        
        $(".store-editable").empty();   
        getTags();
    });
    
    $(".store-submit").click(function(){ $("input[name='content']").val($('.store-editable').html()); $("#store-posts").submit(); });
    
    $("#store-posts").validate({
      ignore: [],
      rules: {
        title: {required: true},
        content: {required: true},
        tag_id: {required: true},
      },
      messages: {
        title: "Debe introducir el titulo del post",
        content: "Debe introducir el contenido del post",
        tag_id: "Debe introducir el tag del post",
      }, 
      submitHandler: function() {
        var form_action = $("#store-posts").attr("action");
        var form_data = new FormData($('#store-posts')[0]);
        //form_data.append('content', $('#content').html());
        if($("#store-posts input[name='published']").is(':checked')) form_data.append('published', '1');
        else form_data.append('published', '0'); 
        
        $.ajax({
          dataType: 'json',
          type:'POST',
          url: form_action,
          data: form_data,
          contentType: false,
          processData: false,
        }).done(function(data){
          $('#store-posts')[0].reset();
          $("#postCreateForm").modal('hide');
          table.ajax.reload();
          swal(
            data['name'],
            data['message'],
            'success'
          )
        });
      }
    });
    
    
    $(".update-submit").click(function(){ $("input[name='content']").val($('.update-editable').html()); $("#update-posts").submit(); });
    //$(".update-cancel").click(function(){ $('#update-posts')[0].reset(); $('.img_preview').removeAttr('src'); });
    
    $("#update-posts").validate({
      ignore: [],
      rules: {
        title: {required: true},
        content: {required: true},
        tag_id: {required: true},
      },
      messages: {
        title: "Debe introducir el titulo del post",
        content: "Debe introducir el contenido del post",
        tag_id: "Debe introducir el tag del post",
      }, 
      submitHandler: function() {
        var form_action = $("#update-posts").attr("action");
        var form_data = new FormData($('#update-posts')[0]);
        if($("#update-posts input[name='published']").is(':checked')) form_data.append('published', '1');
        else form_data.append('published', '0');
        $.ajax({
          dataType: 'json',
          type:'POST',
          url: form_action,
          data: form_data,/*new FormData($('#update-projects')[0]),*/  //$('#update-projects').serialize(),
          contentType: false,
          processData: false,
        }).done(function(data){
          $('#update-posts')[0].reset();
          $("#postEditForm").modal('hide');
          table.ajax.reload();
          swal(
            data['name'],
            data['message'],
            'success'
          )
        });
      }
    });
    
    
    function getPost(id){
      $.ajax({
        ataType: 'json',
        type:'GET',
        url: "/dashboard/posts/"+id+"/edit",
      }).done(function(data){
        $("#update-posts").attr("action", "/dashboard/posts/"+id);
        $("input[name='id']").val(data['id']);
        $("input[name='title']").val(data['title']);
        //$("textarea[name='content']").val(data['description']);
        $(".update-editable").html(data['content']); //$('<div />').html(data['content']).text() );
        getTags();
        //$("input[name='published']").prop("checked", data['published']);
        $( "input[type='checkbox']" ).prop({ checked: data['published'] });
      });
    }
    
    function getTags(){
        $.ajax({
            dataType: 'json',
            type:'GET',
            url: "/tags/data",
        }).done(function(data){
            jQuery.each(data["data"], function(i, val) {
                $("select[name='tag_id']").append('<option value="'+ val.id +'">'+ val.name +'</option>');
                //$( "input[type='checkbox']" ).prop({ checked: 1 });
                //console.log($("select[name='tag_id'] option:selected").val());
            });
        });
    }
    
    function deletePost(id){
      swal({
        title: '¿Estas seguro?',
        text: "Tu no podras revertir los cambios!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            ataType: 'json',
            type:'DELETE',
            url: "/dashboard/posts/"+id,
            data: {'_method' : 'DELETE', '_token' : csrf_token},
          }).done(function(data){
            table.ajax.reload();
            swal(
              data['name'],
              data['message'],
              'success'
            )
          });
        }
      })
    }
    
</script>

@endsection