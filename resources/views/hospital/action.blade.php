<div class="modal-content">
  <form id="formAction" action="{{ $hospital->id ? route('hospitals.update', $hospital->id) : route('hospitals.store') }}" method="POST">
    @csrf
    @if ($hospital->id)
      @method('put')
    @endif

    <div class="modal-header">
      <h5 class="modal-title" id="modalActionLabel"></h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">

      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" placeholder="Input Here" class="form-control" id="name" name="name"
          value="{{ $hospital->name }}">
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Alamat</label>
        <textarea  placeholder="Input Here" class="form-control" id="address" name="address">{{ $hospital->address }}</textarea>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" placeholder="Input Here" class="form-control" id="email" name="email"
          value="{{ $hospital->email }}">
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Telepon</label>
        <input type="number" placeholder="Input Here" class="form-control" id="phone" name="phone"
          value="{{ $hospital->phone }}">
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary"></button>
    </div>

  </form>
</div>
