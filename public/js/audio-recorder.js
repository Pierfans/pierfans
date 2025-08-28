/**
 * Audio Recorder for Messages
 * This script handles audio recording functionality for messages
 */

$(document).ready(function() {
    // Variáveis para gravação de áudio
    let mediaRecorder;
    let audioChunks = [];
    let isRecording = false;
    let audioBlob;
    let audioFile;

    // Botões de gravação
    const recordButton = $('#recordAudio');
    const stopButton = $('#stopAudio');
    
    // Iniciar gravação de áudio
    recordButton.on('click', function() {
        // Verificar suporte à API MediaRecorder
        if (!navigator.mediaDevices || !window.MediaRecorder) {
            alert('Seu navegador não suporta gravação de áudio.');
            return;
        }

        // Solicitar permissão para acessar o microfone
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(stream => {
                // Exibir botão de parar gravação
                recordButton.addClass('display-none');
                stopButton.removeClass('display-none');
                
                // Iniciar gravação
                mediaRecorder = new MediaRecorder(stream);
                audioChunks = [];
                isRecording = true;
                
                // Coletar dados de áudio
                mediaRecorder.ondataavailable = function(e) {
                    if (e.data.size > 0) {
                        audioChunks.push(e.data);
                    }
                };
                
                // Quando a gravação terminar
                mediaRecorder.onstop = function() {
                    // Criar blob de áudio
                    audioBlob = new Blob(audioChunks, { type: 'audio/mp3' });
                    
                    // Criar arquivo de áudio para envio
                    const fileName = `audio_${Date.now()}.mp3`;
                    audioFile = new File([audioBlob], fileName, { type: 'audio/mp3' });
                    
                    // Adicionar áudio ao formulário
                    addAudioToForm(audioFile);
                    
                    // Fechar todas as faixas de áudio
                    stream.getTracks().forEach(track => track.stop());
                };
                
                // Iniciar gravação
                mediaRecorder.start();
                
                // Mostrar feedback visual de gravação
                showRecordingFeedback();
            })
            .catch(error => {
                console.error('Erro ao acessar o microfone:', error);
                alert('Não foi possível acessar o microfone. Verifique as permissões do navegador.');
            });
    });
    
    // Parar gravação de áudio
    stopButton.on('click', function() {
        if (mediaRecorder && isRecording) {
            mediaRecorder.stop();
            isRecording = false;
            
            // Ocultar botão de parar e mostrar botão de gravar
            stopButton.addClass('display-none');
            recordButton.removeClass('display-none');
            
            // Remover feedback visual
            hideRecordingFeedback();
        }
    });
    
    // Adicionar áudio ao formulário para envio
    function addAudioToForm(audioFile) {
        // Criar preview do áudio
        const audioPreview = `
            <div class="d-flex align-items-center py-2 preview-audio">
                <div class="flex-shrink-0 me-2">
                    <i class="bi-music-note-beamed text-primary"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <audio controls class="audio-preview">
                        <source src="${URL.createObjectURL(audioBlob)}" type="audio/mp3">
                        Seu navegador não suporta o elemento de áudio.
                    </audio>
                </div>
                <div class="flex-shrink-0 ms-2">
                    <button type="button" class="btn btn-sm btn-danger remove-audio">
                        <i class="bi-x"></i>
                    </button>
                </div>
            </div>
        `;
        
        // Adicionar preview ao formulário
        $('#previewImage').append(audioPreview);
        
        // Adicionar arquivo ao input de mídia
        const dataTransfer = new DataTransfer();
        
        // Obter arquivos existentes do input
        const fileInput = document.getElementById('file');
        if (fileInput.files.length > 0) {
            Array.from(fileInput.files).forEach(file => {
                dataTransfer.items.add(file);
            });
        }
        
        // Adicionar novo arquivo de áudio
        dataTransfer.items.add(audioFile);
        
        // Atualizar input de arquivo
        fileInput.files = dataTransfer.files;
        
        // Habilitar botão de envio
        $('#button-reply-msg').prop('disabled', false);
        
        // Adicionar evento para remover áudio
        $('.remove-audio').on('click', function() {
            $(this).closest('.preview-audio').remove();
            
            // Remover arquivo do input
            const newDataTransfer = new DataTransfer();
            Array.from(fileInput.files)
                .filter(file => file.name !== audioFile.name)
                .forEach(file => {
                    newDataTransfer.items.add(file);
                });
            
            fileInput.files = newDataTransfer.files;
            
            // Verificar se ainda há conteúdo para enviar
            checkFormContent();
        });
    }
    
    // Mostrar feedback visual de gravação
    function showRecordingFeedback() {
        // Adicionar indicador de gravação
        $('body').append('<div id="recordingIndicator" class="position-fixed bottom-0 start-0 m-3 p-2 bg-danger text-white rounded-pill"><i class="bi-record-fill me-2"></i>Gravando áudio...</div>');
        
        // Animar indicador
        animateRecordingIndicator();
    }
    
    // Ocultar feedback visual de gravação
    function hideRecordingFeedback() {
        $('#recordingIndicator').remove();
    }
    
    // Animar indicador de gravação
    function animateRecordingIndicator() {
        let opacity = 1;
        const indicator = $('#recordingIndicator');
        
        const animation = setInterval(() => {
            if (!isRecording) {
                clearInterval(animation);
                return;
            }
            
            opacity = opacity === 1 ? 0.5 : 1;
            indicator.css('opacity', opacity);
        }, 500);
    }
    
    // Verificar se há conteúdo para enviar
    function checkFormContent() {
        const hasText = $('#message').val().trim().length > 0;
        const hasFiles = document.getElementById('file').files.length > 0;
        
        if (hasText || hasFiles) {
            $('#button-reply-msg').prop('disabled', false);
        } else {
            $('#button-reply-msg').prop('disabled', true);
        }
    }
});
