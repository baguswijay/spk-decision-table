<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH KRITERIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="control-label">Kriteria</label>
                    <input type="text" class="form-control" id="kriteria">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kriteria"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Bobot</label>
                    <input type="number" class="form-control" id="bobot">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-bobot"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').on('click', '#btn-create-kriteria', function () {

        //open modal
        $('#modal-create').modal('show');
    });

    $('#store').click(function (e) {
        e.preventDefault();

        let kriteria     = $('#kriteria').val();
        let bobot         = $('#bobot').val();
        let token           = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/kriteria`,
            type: "POST",
            cache: false,
            data: {
                "kriteria": kriteria,
                "bobot": bobot,
                "_token": token
            },
            success: function(response) {

                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                let kriteria = `
                <tr id="index_${response.data.id}">
                    <td>${response.data.kriteria}</td>
                    <td>${response.data.bobot * 100} %</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" id="btn-edit-kriteria" data-id="${response.data.id}" class="btn btn-primary btn-sm">Edit <i class="bi bi-pencil-square"></i></a>
                        <a href="javascript:void(0)" id="btn-delete-kriteria" data-id="${response.data.id}" class="btn btn-danger btn-sm">Delete <i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                `;

                $('#table-kriteria').prepend(kriteria);

                $('#kriteria').val('');
                $('#bobot').val('');

                $('#modal-create').modal('hide');
            },
            error:function (error) {

                if(error.responseJSON.kriteria) {

                    //show alert
                    $('#alert-kriteria').addClass('d-block');
                    $('#alert-kriteria').removeClass('d-none');

                    //add message to alert
                    $('#alert-kriteria').html(error.responseJSON.kriteria);
                }

                if(error.responseJSON.bobot) {

                    //show alert
                    $('#alert-bobot').removeClass('d-none');
                    $('#alert-bobot').addClass('d-block');

                    //add message to alert
                    $('#alert-bobot').html(error.responseJSON.bobot);
                }
            }
        });
    });
</script>
