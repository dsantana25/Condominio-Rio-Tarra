<div id="modalPersonas{{$id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Lista de inquilinos</h4>
            </div>
            <div class="modal-body">
              <table class="table">
                <thead>
                  <th>Nombre</th>
                  <th>Cedula</th>
                  <th>Fecha de Nacimiento</th>
                  <th>Teléfono fijo</th>
                  <th>Teléfono móvil</th>
                  <th>Arrendatario</th>
                  <th>Opciones</th>
                </thead>
                <tbody>
                  {{--@foreach ($apartments as $apartment)
                    @if ($apartment->id == $id)
                      @foreach($apartment->families()->owners() as $owner)
                        <tr>
                          <td>{{$owner->first_name}}</td>
                          @if(isset($owner->identity))
                            <td>{{$owner->identity}}</td>
                          @else
                            <td>-</td>
                          @endif
                          <td>{{$owner->birth_date}}</td>
                          @if(isset($owner->phone))
                            <td>{{$owner->phone}}</td>
                          @else
                            <td>-</td>
                          @endif
                          @if(isset($owner->cellphone))
                            <td>{{$owner->cellphone}}</td>
                          @else
                            <td>-</td>
                          @endif
                          <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['persona.destroy', $owner->id]]) !!}
                            <button type="submit" class="text-danger"><i class="material-icons">delete_forever</i></button>
                            {!! Form::close() !!}
                          </td>
                        </tr>
                        @endforeach
                    @endif
                  @endforeach--}}
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
