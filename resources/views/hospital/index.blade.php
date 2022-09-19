@extends('layouts.master')
@section('title')
  Rumah Sakit
@endsection
@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endpush

@section('main-content')
  <div class="main-content">

    <div class="content-wrapper">
      <div class="row same-height">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header mt-2">
              <h4>Data Rumah Sakit</h4>
            </div>
            <div class="card-body">

              <button type="button" class="mb-3 btn btn-sm btn-primary btn-add">
                <i class="ti-plus"> Tambah Rumah Sakit</i>
              </button>
              {{ $dataTable->table() }}

            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- modalAction --}}
    <div class="modal fade" id="modalAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
      <div class="modal-dialog">
      </div>
    </div>
    {{-- end modalAction --}}

  </div>
@endsection

@push('js')
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{ asset('') }}vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
  {{ $dataTable->scripts() }}

  <script>
    const modalAction = new bootstrap.Modal($('#modalAction'))

    // btn add
    $('.btn-add').on('click', function() {
      $.ajax({
        method: 'get',
        url: `{{ url('hospitals/create') }}`,
        success: function(res) {
          // console.log(res)
          $('#modalAction').find('.modal-dialog').html(res)
          modalAction.show()
          $('#modalActionLabel').text('Tambah Data Rumah Sakit')
          $('#modalAction').find('.btn-primary').text('Tambah')
          store()
        }
      })
    })
    // end btn add

    // btn edit & delete
    $('#hospital-table').on('click', '.action', function() {
      let data = $(this).data()
      let id = data.id
      let type = data.type
      // console.log(data)

      if (type == 'delete') {
        Swal.fire({
          title: 'Yakin hapus data?',
          text: "Data akan terhapus permanen!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              method: 'delete',
              url: `{{ url('hospitals/') }}/${id}`,
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(res) {
                window.LaravelDataTables["hospital-table"].ajax.reload()
                Swal.fire(
                  'Terhapus!',
                  res.message
                )
              }
            })
          }
        })
        return
      }

      $.ajax({
        method: 'get',
        url: `{{ url('hospitals/') }}/${id}/edit`,
        success: function(res) {
          $('#modalAction').find('.modal-dialog').html(res)
          modalAction.show()
          $('#modalActionLabel').text('Edit Data Rumah Sakit')
          $('#modalAction').find('.btn-primary').text('Update')
          store()
        }
      })
    })
    // end btn edit & delete

    function store() {
      $('#formAction').on('submit', function(e) {
        e.preventDefault()
        // console.log(this)
        const _form = this
        const formData = new FormData(_form)
        const url = this.getAttribute('action')
        // console.log(url)

        $.ajax({
          method: 'post',
          url: url,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: formData,
          processData: false,
          contentType: false,
          success: function(res) {
            window.LaravelDataTables["hospital-table"].ajax.reload()
            modalAction.hide()
          },
          error: function(res) {
            let errors = res.responseJSON?.errors
            $(_form).find('.text-danger').remove()
            if (errors) {
              for (const [key, value] of Object.entries(errors)) {
                $(`[name="${key}"]`).parent().append(
                  `<span class="text-danger text-small">${value}</span>`)
              }
            }
          }
        })
      })
    }
  </script>
@endpush
