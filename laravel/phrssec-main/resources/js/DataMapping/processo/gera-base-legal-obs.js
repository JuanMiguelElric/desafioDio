$("#edit_base_legal").change(function() {
    let valorSelecionado = $(this).val()
    if (valorSelecionado == "Interesse Legítimo do Controlador/Terceiro") {
        $("#base-legal-obs-input").append(
            `<x-adminlte-input name="edit_base_legal_obs" placeholder="Observação da Base Legal" value="{{ $processo->base_legal_obs }}"/>`
        );
    } else {
        $("#edit_base_legal_obs").parent().parent().remove()

    }
});