@extends('layouts.app')

@section('content')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <h1>Suscriptores</h1>
        <h2>Lista de suscriptores</h2>
        <div class="table-responsive">
            <table id="datatable-subscribers" class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                </tr>
                </thead>
            </table>
        </div>   
    </main>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        oTable = $('#datatable-subscribers').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/subscribers/data",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'}
            ]
        });
    });
</script>
@endsection