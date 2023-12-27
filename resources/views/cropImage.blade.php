<!DOCTYPE html>
<html lang="es">

<head>
    <title>Recorte</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
</head>
<style type="text/css">
    .centered-image {
        display: block;
        margin-left: auto;
        margin-right: auto; /* Centrar verticalmente */

        }
    h1{
        font-weight: bold;
        font-size:23px;
    }
    img {
        display: block;
        max-width: 100%;
    }
    .preview {
        text-align: center;
        overflow: hidden;
        width: 160px;inf
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }
    input{
        margin-top:40px;
    }
    .section{
        margin-top:10px;
        background:#fff;
        padding:20px 30px;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
    #logo-image {
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding: 20px;
    }
    .bg-red-900 {
    background-color: #7f1d1d;
}
</style>
<body>
    <div class="block bg-red-900 text-white">
        <!-- Encabezado -->
        <div class="container mb-4">
            <div class="row justify-content-between align-items-center py-2">
                <div class="col-md-6 text-center text-md-left">
                    <img src="img/logob_m_EPG.png" alt="Logo epg" class="img-fluid" style="max-width: 180px; height: auto;">
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <h1 class="mb-0">Recorte de Fotografía</h1>
                </div>
            </div>
        </div>


    </div>

    <div class="container mb-4 dark:bg-zinc-800" style="box-shadow: 0 -2px 4px rgba(0.1, 0.1, 0.1, 0.1);">
        <div class="row">
            <div class="col-md-8 mx-auto section text-center mt-4" id="vent-recortar">
                <h1 id="text-fotografia">Subir Fotografia para recortar</h1>
                <input id="upload-button" type="file" name="image" class="image">
                <img src="{{ asset('img/foto_carnet.jpg') }}" alt="Logo" id="logo-image" class="img-fluid">
                <a href="#" id="download-button" class="btn btn-primary d-sm-none mt-3">Descargar</a>
            </div>
        </div>
        <p class="text-center"><strong>*Nota: Una vez termine de recortar, descargue la imagen y regrese al formulario para cargar la imagen recortada</strong></p>
<br>
    </div>

    <footer class="bg-white text-sm font-medium shadow-sm text-gray-700 fixed-bottom">
        <div class="mx-auto flex flex-col items-center justify-center py-2" style="box-shadow: 0 -2px 4px rgba(0.1, 0.1, 0.1, 0.1);">
            <p class="text-center">Oficina de Tecnologías de Información-2023 UNA</p>
        </div>
    </footer>


    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Recortar Fotografia tamaño carnet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="crop">Recortar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function(e){
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                var base64data = reader.result;
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: "crop-image-upload-ajax",
                    data: {
                    '_token': $('meta[name="_token"]').attr('content'),
                    'image': base64data
                    },
                    success: function(data) {
                    console.log(data);
                    $modal.modal('hide');

                    // Ocultar el botón de subir archivos
                    //$("#upload-button").hide();

                    // Remover la imagen del logotipo existente
                    //$('#logo-image').remove();
                    //$('#text-fotografia').remove();

                    // Agregar el título "Imagen recortada"
                    /*var title = document.createElement('h2');
                    title.textContent = 'Imagen recortada';*/

                    // Crear la nueva imagen recortada con el mismo tamaño del logotipo
                    /*var croppedImage = document.createElement('img');
                    croppedImage.src = base64data;
                    croppedImage.alt = 'Imagen recortada';
                    croppedImage.classList.add('w-120px', 'h-98px');
                    croppedImage.classList.add('centered-image');*/

                    // Agregar el enlace de descarga
                    var downloadLink = document.createElement('a');
                    downloadLink.href = base64data;
                    downloadLink.download = 'imagen_recortada.jpg';
                    //downloadLink.textContent = 'Download';

                    // Agregar la nueva imagen recortada y el enlace de descarga al contenedor
                    //$('.section').append(title);
                    //$('.section').append(croppedImage);
                    //$('.section').append(downloadLink);

                    // Cambiar el src de la imagen con el id "logo-image"
                    $('#logo-image').attr('src', base64data);

                    // Mostrar el botón de descarga
                    $('#download-button').show();
                    alert("Se recortó la imagen exitosamente!");
                    //window.location.href = '{{ route('formulario') }}';
                    downloadLink.click();
                    }
                });
                }
            });
        });

    </script>
    <script>

        // Obtén el enlace de descarga y la imagen
        var downloadButton = document.getElementById('download-button');
        var logoImage = document.getElementById('logo-image');

        // Agrega un evento de clic al enlace de descarga
        downloadButton.addEventListener('click', function() {
        // Crea un elemento de enlace temporal
        var tempLink = document.createElement('a');
        tempLink.href = logoImage.src;
        tempLink.download = 'imagen_recortada.jpg';

        // Simula un clic en el enlace temporal para iniciar la descarga
        document.body.appendChild(tempLink);
        tempLink.click();
        document.body.removeChild(tempLink);
        });
  </script>
</body>

</html>
