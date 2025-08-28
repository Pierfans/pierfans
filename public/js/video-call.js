/**
 * Video Call Functionality
 * This script ensures the video call button works correctly
 */

$(document).ready(function() {
    // Garantir que o botão de videochamada funcione corretamente
    $(document).on('click', '.requestLivePrivateModal', function() {
        $(this).blur();
        $('#modalLivePrivateRequest').modal('show');
    });

    // Inicializar tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
