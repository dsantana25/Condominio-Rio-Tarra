<div id="modalAlquiler{{$id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Datos del alquiler</h4>
            </div>
            <div class="modal-body">
              <table class="table">
                <thead>
                  <th>Apto.</th>
                  <th>Familia</th>
                  <th>Inicio de alquiler</th>
                  <th>Fin de alquiler</th>
                </thead>
                <tbody>
                  @foreach ($apartments as $apartment)
                    @if ($apartment->id == $id)
                      <td>{{$apartment->name}}</td>
                      @foreach ($apartment->rents() as $rent)
                        <td>{{$rent->family->name}}</td>
                        <td>{{$rent->start_date}}</td>
                        @if(isset($rent->end_date))
                          <td>{{$rent->end_date}}</td>
                        @else
                          <td>No ha finalizado</td>
                        @endif
                      @endforeach
                    @endif
                  @endforeach
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
