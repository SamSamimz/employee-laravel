<div>
    <h4 class="">State List</h4>
    <div class="ibox">
        <div class="ibox-head">
            <div>
                <select wire:model.live='filterState' class="form-control">
                    <option value="" selected>Filter by Country</option>
                    @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input wire:model.live='search' type="text" class="form-control" placeholder="Search here...">
            </div>
            <div>
                <a wire:click='openModal()' class="btn btn-primary">Add State</a>
            </div>

        </div>
    <div class="ibox-body">
        <div class="table-responsive">
            <table class="table" wire:loading.remove>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Country Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($states as $index => $state)
                    <tr>
                        <td>{{++$index}}</td>
                        <td class="{{strtolower($this->search) == strtolower($state->name) ? 'bg-warning text-white' : null}}">{{$state->name}}</td>
                        <td>{{$state->country->name}}</td>
                        <td>
                            <button wire:click='editState({{$state}})' class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                            <button wire:click='deleteState({{$state}})' class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{$states->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">{{$stateId ? 'Edit' : 'Create'}} State</h5>
          <button type="button" wire:click='closeModal' class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent='addState()'>
            <div class="ibox-body">
                <div class="form-group">
                      <label>State Name</label>
                      <input wire:model='name' class="form-control" type="text" placeholder="State Name">
                      @error('name')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label for="country">Country</label>
                      <select wire:model='country_id' name="country_id" class="form-control" id="country">
                        <option value="" selected>Select Country</option>
                        @foreach ($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                      </select>
                      @error('country_id')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click='closeModal'>Close</button>
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
  </div>
  @push('scripts')
  <script>
      document.addEventListener('livewire:initialized', function () {
          Livewire.on('openModal', function () {
              $('#modal').modal({
                  backdrop: 'static',
                  keyboard: false
              });
              $('#modal').modal('show');
          });
          Livewire.on('closeModal', function () {
          $('#modal').modal('hide');
      });
  });
  </script>
  @endpush
</div>