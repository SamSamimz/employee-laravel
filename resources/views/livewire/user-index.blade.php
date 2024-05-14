<div>
    <h4 class="">User List</h4>
    <div class="ibox">
        <div class="ibox-head">
            <div>
                <select name="" id="" class="form-control">
                    <option value="" selected>Filter by Category</option>
                    <option value="">A</option>
                    <option value="">A</option>
                </select>
            </div>
            <div>
                <input wire:model.live='search' type="text" class="form-control" placeholder="Search here...">
            </div>
            <div>
                <a wire:click='openModal()' class="btn btn-primary">Add User</a>
            </div>


        </div>
    <div class="ibox-body">
        <div class="table-responsive">
            {{-- <div wire:loading>Loading...</div> --}}
            <table class="table" wire:loading.remove>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                    <tr>
                        <td>{{++$index}}</td>
                        <td class="{{strtolower($this->search) == strtolower($user->first_name) ? 'bg-warning text-white' : (strtolower($this->search) == strtolower($user->last_name) ? 'bg-warning text-white' : null)}}">{{$user->first_name . ' ' . $user->last_name}}</td>
                        <td class="{{strtolower($this->search) == strtolower($user->username) ? 'bg-warning text-white' : null}}">{{$user->username}}</td>
                        <td class="{{strtolower($this->search) == strtolower($user->email) ? 'bg-warning text-white' : null}}">{{$user->email}}</td>
                        <td class="{{strtolower($this->search) == strtolower($user->address) ? 'bg-warning text-white' : null}}">{{$user->address}}</td>
                        <td class="{{strtolower($this->search) == $user->phone ? 'bg-warning text-white' : null}}">{{$user->phone}}</td>
                        <td>
                            <button wire:click='editUser({{$user}})'  class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                            <button wire:click='deleteUser({{$user}})' class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                        </td>
                    </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{$users->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">{{$userId ? 'Edit' : 'Create'}} User</h5>
          <button type="button" wire:click='closeModal' class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='addUser()'>
        <div class="modal-body">
            <div class="ibox-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <label>First Name</label>
                        <input wire:model='first_name' class="form-control" type="text" placeholder="First Name">
                        @error('first_name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label>Last Name</label>
                        <input wire:model='last_name' class="form-control" type="text" placeholder="Last Name">
                        @error('last_name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input wire:model='username' class="form-control" type="text" placeholder="username">
                    @error('username')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                      <label>Email</label>
                      <input wire:model='email' class="form-control" type="text" placeholder="Email Address">
                      @error('email')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label>Address</label>
                      <input wire:model='address' class="form-control" type="text" placeholder="Address">
                      @error('address')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label>Phone</label>
                      <input wire:model='phone' class="form-control" type="text" placeholder="Phone">
                      @error('phone')
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