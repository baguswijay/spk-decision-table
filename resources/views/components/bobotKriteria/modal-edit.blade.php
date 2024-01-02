<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT KRITERIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="kriteria_id">

                <div class="form-group">
                    <label for="name" class="control-label">Kriteria</label>
                    <input type="text" class="form-control" id="kriteria-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kriteria-edit"></div>
                </div>


                <div class="form-group">
                    <label class="control-label">Bobot</label>
                    <input type="number" class="form-control" id="bobot-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-bobot-edit"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').on('click', '#btn-edit-kri', function() {

        let kriteria_id = $(this).data('id');

        $.ajax({
            url: `kriteria/${kriteria_id}`,
            type: "GET",
            cache: false,
            success: function(response){

                $('#kriteria_id').val(response.data.id);
                $('#kriteria-edit').val(response.data.kriteria);
                $('#bobot-edit').val(response.data.bobot);

                $('#modal-edit').modal('show');
            }
        });
    });

    $('#update').click(function(e){
        e.preventDefault();

        let kriteria_id   = $('#kriteria_id').val();
        let kriteria = $('#kriteria-edit').val();
        let bobot      = $('#bobot-edit').val();
        let token       = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `kriteria/${kriteria_id}`,
            type: 'PUT',
            cache: false,
            data: {
                "kriteria": kriteria,
                "bobot": bobot,
                "_token": token
            },
            success: function(response){

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
                        <td>${response.data.bobot}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-gejala" data-id="${response.data.id}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="javascript:void(0)" id="btn-delete-gejala" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;

                $(`#index_${response.data.id}`).replaceWith(kriteria);

                $('#modal-edit').modal('hide');
            },
            error:function(error){

                if(error.responseJSON.kriteria) {
                    $('#alert-kriteria-edit').removeClass('d-none');
                    $('#alert-kriteria-edit').addClass('d-block');

                    //add message to alert
                    $('#alert-kriteria-edit').html(error.responseJSON.kriteria);
                }

                if(error.responseJSON.bobot) {

                    //show alert
                    $('#alert-bobot-edit').addClass('d-block');
                    $('#alert-bobot-edit').removeClass('d-none');

                    //add message to alert
                    $('#alert-bobot-edit').html(error.responseJSON.bobot);
                }
            }
        });
    });
</script>
