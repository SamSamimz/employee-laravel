<div>
    <h4 class="">Country List</h4>
    <div class="ibox">
        <div class="ibox-head">
            <div>
                <select name="" id="" class="form-control">
                    <option value="" selected disabled>Filter</option>
                </select>
            </div>
            <div>
                <input wire:model.live='search' type="text" class="form-control" placeholder="Search here...">
            </div>
            <div>
                <a wire:click='openModal' class="btn btn-primary">Add Country</a>
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
                    @forelse ($countries as $index => $country)
                    <tr>
                        <td>{{++$index}}</td>
                        <td class="{{$this->search == $country->name ? 'bg-warning text-white' : null}}">{{$country->name}}</td>
                        <td>
                            <button wire:click='editCountry({{$country}})' class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                            <button wire:click='deleteCountry({{$country}})' class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{$countries->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">{{$countryId ? 'Edit' : 'Create'}} Country</h5>
        <button type="button" wire:click='closeModal' class="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form wire:submit.prevent='addCountry()'>
      <div class="modal-body">
          <div class="ibox-body">
              <div class="form-group">
                    <label>Country Code</label>
                    <input wire:model='country_code' class="form-control" type="text" placeholder="Country Code">
                    @error('country_code')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
              <div class="form-group">
                    <label>Country Name</label>
                    <input wire:model='name' class="form-control" type="text" placeholder="Country Name">
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