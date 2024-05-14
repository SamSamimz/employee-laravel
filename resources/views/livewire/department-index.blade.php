<div>
    <h4>Department List</h4>
    <div class="ibox">
        <div class="ibox-head">
            <div>
                <select class="form-control">
                    <option value="" selected disabled>Filter by Category</option>
                    <option value="">A</option>
                </select>
            </div>
            <div>
                <input wire:model.live='search' type="text" class="form-control" placeholder="Search here...">
            </div>
            <div>
                <a wire:click='openModal()' class="btn btn-primary">Add Department</a>
            </div>

        </div>
    <div class="ibox-body">
        <div class="table-responsive">
            <table class="table" wire:loading.remove>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $index => $department)
                    <tr>
                        <td>{{++$index}}</td>
                        <td class="{{strtolower($this->search) == strtolower($department->name) ? 'bg-warning text-white' : null}}">{{$department->name}}</td>
                        <td>
                            <button wire:click='editDepartment({{$department}})' class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                            <button wire:click='deleteDepartment({{$department}})' class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{$departments->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">{{$departmentId ? 'Edit' : 'Create'}} Country</h5>
          <button type="button" wire:click='closeModal' class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='addDepartment()'>
        <div class="modal-body">
            <div class="ibox-body">
                <div class="form-group">
                      <label>Department Name</label>
                      <input wire:model='name' class="form-control" type="text" placeholder="Department Name">
                      @error('name')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
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