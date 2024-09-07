<div>
    <h4 class="">Employee List</h4>
    <div class="ibox">
        <div class="ibox-head">
            <div>
                <select wire:model.live='filterEmployee' class="form-control">
                    <option value="" selected>Filter by Department</option>
                   @forelse ($departments as $dp)
                       <option value="{{$dp->id}}">{{$dp->name}}</option>
                   @empty

                   @endforelse
                </select>
            </div>
            <div>
                <input wire:model.live='search' type="text" class="form-control" placeholder="Search here...">
            </div>
            <div>
                <a wire:click='openModal()' class="btn btn-primary">Add Employee</a>
            </div>

        </div>
    <div class="ibox-body">
        <div class="table-responsive" style="overflow-x: auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Address</th>
                        <th>Zip Code</th>
                        <th>Phone</th>
                        <th>Birthdate</th>
                        <th>Hired_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $index => $employee)
                    <tr>
                        <td>{{++$index}}</td>
                        <td>{{$employee->first_name. ' ' . $employee->last_name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->department->name}}</td>
                        <td>{{$employee->city->name . ', ' . $employee->state->name . ', ' . $employee->country->name}}</td>
                        <td>{{$employee->zip_code}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->birthdate}}</td>
                        <td>{{$employee->hired_date}}</td>
                        <td class="d-flex">
                            <button wire:click='editEmployee({{$employee}})' class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                            <button wire:click='deleteEmployee({{$employee}})' wire:confirm='Are you sure want to delete?' class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{$employees->links()}}
        </div>
    </div>
</div>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">{{$employeeId ? 'Edit' : 'Create'}} Employee</h5>
          <button type="button" wire:click='closeModal' class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='addEmployee()'>
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
                      <label>Email</label>
                      <input wire:model='email' class="form-control" type="text" placeholder="Email Address">
                      @error('email')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label>Department</label>
                      <select wire:model='department_id' class="form-control" name="department_id" wire:model='department_id'>
                        <option value="" selected>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                      </select>
                      @error('department_id')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label>Country</label>
                      <select class="form-control" name="country_id" wire:model='country_id'>
                        <option value="" selected>Select Country</option>
                        @foreach ($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                      </select>
                      @error('country_id')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label>State</label>
                      <select class="form-control" name="state_id" wire:model='state_id'>
                        <option value="" selected>Select State</option>
                        @foreach ($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                      </select>
                      @error('state_id')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label>City</label>
                      <select class="form-control" name="city_id" wire:model='city_id'>
                        <option value="" selected>Select City</option>
                        @foreach ($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                      </select>
                      @error('city_id')
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
                <div class="form-group">
                      <label>Zip Code</label>
                      <input wire:model='zip_code' class="form-control" type="text" placeholder="Zip Code">
                      @error('zip_code')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label>Birth Date</label>
                      <input wire:model='birthdate' id="date" class="form-control" type="date">
                      @error('birthdate')
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                  </div>
                <div class="form-group">
                      <label>Hired Date</label>
                      <input wire:model='hired_date' class="form-control" type="date">
                      @error('hired_date')
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