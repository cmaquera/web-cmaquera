@extends('layouts.app')

@section('content')

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
              <h1>Proyectos</h1>
              <div>
                <button type="button" class="btn btn-primary add-project" data-toggle="modal" data-target="#projectCreateForm"><i class="icon ion-android-add-circle"></i> Agregar proyecto</button>
              </div>
              <h2>Lista de proyectos</h2>
              <div class="table-responsive">
                <table id="datatable-projects" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Proyecto</th>
                        <th>Url_project</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                </table>
              </div>
              <div>               
                <!-- Create Modal -->
                <div class="modal fade bd-example-modal-lg" id="projectCreateForm" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar proyecto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">                        
                          <form id="store-projects" action="/dashboard/projects" method="POST" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}  {{ method_field('POST') }}
                            @include('layouts._fproject')
                          </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary store-cancel" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary store-submit">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>                
                <!-- Edit Modal -->
                <div class="modal fade bd-example-modal-lg" id="projectEditForm" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar proyecto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">                        
                          <form id="update-projects" action="" method="PUT" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }} {{ method_field('PATCH') }}
                            <input type="hidden" name="id"/>
                            @include('layouts._fproject')
                          </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary update-cancel" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary update-submit">Actualizar</button>
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
        table = $('#datatable-projects').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/projects/data",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'url_project', name: 'url_project'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ] 
        });
    });
    
    $("#url_screenshot").change(function(){ readURL(this) });
    
    $(".add-project").click( function() { $('#store-projects')[0].reset(); $('.img_preview').removeAttr('src'); });
    
    $(".store-submit").click(function(){ $("#store-projects").submit(); });
    $(".store-cancel").click(function(){ $('#store-projects')[0].reset(); $('.img_preview').removeAttr('src'); });
    
    $("#store-projects").validate({
      rules: {
        name: { required: true },
        description: { required: true },
        url_project: { required:  true },
        url_screenshot: { required: true }
      },
      messages: {
        name: "Debe introducir el nombre del proyecto",
        description: "Debe introducir una descripcion del proyecto",
        url_project: "Debe introducir el url del proyecto",
        url_screenshot: "Debe intrducir la imagen del proyecto"
      }, 
      submitHandler: function() {
        var form_action = $("#store-projects").attr("action");
        $.ajax({
          dataType: 'json',
          type:'POST',
          url: form_action,
          data: new FormData($('#store-projects')[0]),  //$('#store-projects').serialize(),
          contentType: false,
          processData: false,
        }).done(function(data){
          $('#store-projects')[0].reset();
          $('.img_preview').removeAttr('src');
          $("#projectCreateForm").modal('hide');
          table.ajax.reload();
          swal(
            data['name'],
            data['message'],
            'success'
          )
        });
      }
    });
    
    $(".update-submit").click(function(){ $("#update-projects").submit(); });
    $(".update-cancel").click(function(){ $('#update-projects')[0].reset(); $('.img_preview').removeAttr('src'); });
    
    $("#update-projects").validate({
      rules: {
        name: { required: true },
        description: { required: true },
        url_project: { required:  true }
      },
      messages: {
        name: "Debe introducir el nombre del proyecto",
        description: "Debe introducir una descripcion del proyecto",
        url_project: "Debe introducir el url del proyecto"
      }, 
      submitHandler: function() {
        var form_action = $("#update-projects").attr("action");
        $.ajax({
          dataType: 'json',
          type:'POST',
          url: form_action,
          data: new FormData($('#update-projects')[0]),/*new FormData($('#update-projects')[0]),*/  //$('#update-projects').serialize(),
          contentType: false,
          processData: false,
        }).done(function(data){
          $('#update-projects')[0].reset();
          $('.img_preview').removeAttr('src');
          $("#projectEditForm").modal('hide');
          table.ajax.reload();
          swal(
            data['name'],
            data['message'],
            'success'
          )
        });
      }
    });
    
    function getProject(id){
      $.ajax({
        ataType: 'json',
        type:'GET',
        url: "/dashboard/projects/"+id+"/edit",
      }).done(function(data){
        $("#update-projects").attr("action", "/dashboard/projects/"+id);
        $("input[name='id']").val(data['id']);
        $("input[name='name']").val(data['name']);
        $("input[name='description']").val(data['description']);
        $("input[name='url_project']").val(data['url_project']);
        //$("input[name='url_screenshot']").val(data['url_screenshot']);
        $('.img_preview').attr('src', data['url_screenshot']);
      });
    }
    
    function deleteProject(id){
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
            url: "/dashboard/projects/"+id,
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
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.img_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection