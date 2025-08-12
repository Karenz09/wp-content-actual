<style>
    input[name="traduccion_search"] {
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 6px;
    width: 100%;
    max-width: 400px;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: border 0.2s ease-in-out;
}

input[name="traduccion_search"]:focus {
    border-color: #0073aa;
    outline: none;
}

/* Contenedor de resultados (autocomplete) */
ul.autocomplete-results {
    position: absolute;
    top: 45px;
    left: 0;
    width: 100%;
    max-width: 400px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top: none;
    z-index: 999;
    list-style: none;
    padding: 0;
    margin: 0;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    border-radius: 0 0 6px 6px;
    overflow: hidden;
}

/* Ítems individuales */
ul.autocomplete-results li {
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
    font-size: 15px;
}

ul.autocomplete-results li:hover {
    background-color: #f1f1f1;
}


.lds-dual-ring {
  display: inline-block;
  width: 20px;
  height: 20px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 16px;
  height: 16px;
  margin: 2px;
  border-radius: 50%;
  border: 2px solid #0073aa;
  border-color: #0073aa transparent #0073aa transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);

  /* Centrado con Flexbox */
    display: none;
    align-items: center;
    justify-content: center;
    }

   .modal-content {
    background-color: #fefefe;
  padding: 20px;
  border-radius: 5px;
  width: 80%;
  max-width: 400px;
  text-align: center;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);

  /* Elimina el margin que descentraba */
  margin: 0;
  }

    .spinner-loading {
      border: 5px solid #f3f3f3;
      border-top: 5px solid #3498db;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
      margin: 0 auto 1rem auto;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .success {
      color: black;
      font-weight: bold;
    }
.required {
  color: red;
  font-weight: bold;
}

</style>

<?php
/* Template Name: LSVR Event Form */

// Verifica si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $wpdb;

    // Validar la clave
    $clave_ingresada = sanitize_text_field($_POST['clave']);
    $clave_correcta = 'eventosR3d4lyc24';

if ($clave_ingresada !== $clave_correcta) {
    $error_message = "Clave de seguridad incorrecta. No se puede crear el evento.";
    get_header();
    ?>
    <div class="container" style="margin: 50px auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 800px; text-align: center;">
    
    <!-- Mensaje de error -->
    <p style="color: red; font-size: 16px; margin-bottom: 30px; display: block;">
        <?php echo esc_html($error_message); ?>
    </p>

    <!-- Botón centrado -->
    <div style="width: 100%; display: flex; justify-content: center;">
        <button 
            onclick="window.location.href='/index.php/formulario-para-eventos/';"
            style="padding: 10px 20px; background-color: #0073aa; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
            ← Regresar
        </button>
    </div>

</div>


    <?php
    get_footer();
    exit;
}
    // Procesar la imagen destacada
    if (!empty($_FILES['event_thumbnail']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $uploaded_file = $_FILES['event_thumbnail'];
        $upload_overrides = ['test_form' => false];
        $uploaded = wp_handle_upload($uploaded_file, $upload_overrides);

        if (isset($uploaded['file'])) {
            // Crear el attachment en la biblioteca de medios
            $file_type = wp_check_filetype(basename($uploaded['file']), null);
            $attachment = [
                'guid'           => $uploaded['url'],
                'post_mime_type' => $file_type['type'],
                'post_title'     => sanitize_file_name($uploaded['file']),
                'post_content'   => '',
                'post_status'    => 'inherit',
            ];

            $thumbnail_id = wp_insert_attachment($attachment, $uploaded['file']);
            $attachment_data = wp_generate_attachment_metadata($thumbnail_id, $uploaded['file']);
            wp_update_attachment_metadata($thumbnail_id, $attachment_data);
        } else {
            $error_message = "Error al subir la imagen: " . $uploaded['error'];
        }
    }

    // Escapa y valida los datos recibidos
    $event_title = sanitize_text_field($_POST['event_title']);
    $event_description = wp_kses_post($_POST['event_description']);
    $cont_incrustado = sanitize_text_field($_POST['cont_incrustado']);
    $link_incrustado = esc_url($_POST['link_incrustado']);
    $start_date = sanitize_text_field($_POST['start_date']);
    $end_date = sanitize_text_field($_POST['end_date']);
    $idioma = sanitize_text_field($_POST['idioma']);
    $traduccion = sanitize_text_field($_POST['traduccion']);
    $lsvr_event_location = '';
    $lsvr_event_allday = 'false';
    $lsvr_event_repeat = 'false';
    $update_last = '23';
    $post_author = '23';
    $lsvr_event_end_time_enable = 'true'; 
    $icons = [
        'facebook' => '<i class="fa-brands fa-facebook-f" style="color: #000000; font-size: 32px;"></i>',
        'instagram' => '<i class="fa-brands fa-instagram" style="color: #000000; font-size: 32px;"></i>',
        'twitter' => '<i class="fa-brands fa-x-twitter" style="color: #000000; font-size: 32px;"></i>',
        'youtube' => '<i class="fa-brands fa-youtube" style="color: #000000; font-size: 32px;"></i>',
        'pagweb' => '<i class="fa-solid fa-earth-americas" style="color: #000000; font-size: 32px;"></i>',
    ];
    
    $icon_html = isset($icons[$cont_incrustado]) ? $icons[$cont_incrustado] : '';

    if (!empty($_POST['cont_incrustado']) && !empty($_POST['link_incrustado'])) {
        $cont_incrustado = $_POST['cont_incrustado'];
        $link_incrustado = $_POST['link_incrustado'];
    
        $event_description .= '<div style="display: flex; gap: 10px; margin-top: 10px;">';
        foreach ($cont_incrustado as $index => $icon_key) {
            $icon_html = isset($icons[$icon_key]) ? $icons[$icon_key] : '';
            $link_url = esc_url($link_incrustado[$index]);
    
            if ($icon_html && $link_url) {
                $event_description .= '<a href="' . $link_url . '" target="_blank">' . $icon_html . '</a>';
            }
        }
        $event_description .= '</div>';
    }
    // Validación básica
    if (!$event_title || !$start_date || !$end_date || !isset($thumbnail_id)) {
        $error_message = "Por favor completa todos los campos requeridos.";
    } else {
        // Inserta el evento como un nuevo post en WordPress
        $event_id = wp_insert_post([
            'post_title'   => $event_title,
            'post_content' => $event_description,
            'post_status'  => 'publish',
            'post_type'    => 'lsvr_event', // Asegúrate de que sea el tipo de post correcto
            'post_author'  => $post_author,
        ]);

        $lsvr_event_start_date_utc = get_gmt_from_date($start_date);
        $lsvr_event_end_date_utc = get_gmt_from_date($end_date);

        if ($event_id) {
            // Asignar la imagen destacada
            set_post_thumbnail($event_id, $thumbnail_id);
        
            // Inserta los metadatos del evento
            update_post_meta($event_id, 'lsvr_event_location', $lsvr_event_location);
            update_post_meta($event_id, 'lsvr_event_start_date_utc', $lsvr_event_start_date_utc);
            update_post_meta($event_id, 'lsvr_event_end_date_utc', $lsvr_event_end_date_utc);
            update_post_meta($event_id, 'lsvr_event_allday', $lsvr_event_allday);
            update_post_meta($event_id, 'lsvr_event_repeat', $lsvr_event_repeat);
            update_post_meta($event_id, 'update_last', $update_last);
            update_post_meta($event_id, 'lsvr_event_end_time_enable', $lsvr_event_end_time_enable);
            update_post_meta($event_id, 'lsvr_event_translation', $traduccion); // Si quieres guardar traducción como texto adicional
        
            // ✅ Asignar idioma con Polylang
            pll_set_post_language($event_id, $idioma);

            
    // Asociar traducciones si existen
if (!empty($_POST['traduccion']) && !empty($_POST['idioma-traduccion'])) {
    $traducciones = array_map('sanitize_text_field', $_POST['traduccion']);
    $idiomas_trad = array_map('sanitize_text_field', $_POST['idioma-traduccion']);

    // Mapa que incluirá el idioma principal y sus traducciones
    $mapa = [];

    // Aseguramos que el evento recién creado se incluya
    $mapa[$idioma] = $event_id;

    foreach ($traducciones as $i => $id_trad) {
        $id_trad = intval($id_trad);
        $idioma_trad = $idiomas_trad[$i] ?? '';

        // Validamos que el ID existe y es del tipo de post correcto
        if ($id_trad && get_post_type($id_trad) === 'lsvr_event' && in_array($idioma_trad, ['es', 'en', 'pt'])) {
            $mapa[$idioma_trad] = $id_trad;
        }
    }

    // Si hay al menos dos idiomas válidos, vinculamos las traducciones
    if (count($mapa) >= 2) {
        pll_save_post_translations($mapa);
    }
}
        }else {
            $error_message = "Hubo un error al guardar el evento.";
        }
    }
}

get_header();

?>

<div class="container" style="margin: 50px auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 800px; height: auto;">
    <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px; width:765px;" id="formEvento">
        <h1>Crear evento</h1>

        <label for="clave" style="font-weight: bold; color: #555;">Clave de Seguridad: <span class="required">*</span></label>
        <input type="password" id="clave" name="clave" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" required>

    <div class="idioma">
    <div class="link-item">
        <label for="idioma" style="font-weight: bold; color: #555;">Idioma del Evento <span class="required">*</span></label>
        <select name="idioma" id="idioma" required style="width:200px;">
            <option value="" disabled selected>Selecciona un Idioma</option>
            <option value="es">Español</option>
            <option value="en">Inglés</option>
            <option value="pt">Portugués</option>
        </select>
    </div>
</div>

    <div class="traduccion-container" style="display: none;">
    <div class="translate-item">
        <label for="Idioma_traduccion" style="font-weight: bold; color: #555;">Idioma de la traducción:</label>
        <select name="idioma-traduccion[]" style="width:200px;">
            <option value="es">Español</option>
            <option value="en">Inglés</option>
            <option value="pt">Portugués</option>
        </select>

        <div class="autocomplete-wrapper" style="position: relative; display: inline-block;">
            <input type="search" name="traduccion_search" placeholder="Buscar evento"
                style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; width: 300px;">
            <div class="spinner" style="display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                <div class="lds-dual-ring"></div>
            </div>
            <input type="hidden" name="traduccion[]" class="traduccion-id">
        </div>
    </div>
    <div id="traduccion-container"></div>
</div>
<!-- Botón oculto por defecto -->
<button type="button" id="add-translate" style="background-color: #5dade2; color: white; font-size: 16px; padding: 10px; border: 2px solid #5dade2; border-radius: 5px; cursor: pointer; margin-top: 10px; width: 200px; display: none;">
    Añadir otra traducción
</button>

        <label for="event_thumbnail" style="font-weight: bold; color: #555;">Imagen destacada: <span class="required">*</span></label>
        <input type="file" id="event_thumbnail" name="event_thumbnail" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" accept="image/*" required>

        <label for="event_title" style="font-weight: bold; color: #555;">Título del Evento: <span class="required">*</span></label>
        <input type="text" id="event_title" name="event_title" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" required>

        <label for="event_description" style="font-weight: bold; color: #555;">Descripción del Evento:</label>
        <textarea id="event_description" name="event_description" rows="5" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; width: 100%;"></textarea>

        <label for="start_date" style="font-weight: bold; color: #555;">Fecha de Inicio: <span class="required">*</span></label>
        <input type="datetime-local" id="start_date" name="start_date" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" required>

        <label for="end_date" style="font-weight: bold; color: #555;">Fecha de Fin: <span class="required">*</span></label>
        <input type="datetime-local" id="end_date" name="end_date"  style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" required>
        
        <div id="link-container">
            <div class="link-item">
                <select name="cont_incrustado[]" style="width:200px;">
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="twitter">Twitter</option>
                    <option value="youtube">YouTube</option>
                    <option value="pagweb">Página Web</option>
                </select>

                <input type="text" name="link_incrustado[]" placeholder="Link a incrustar" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
        </div>
        <button type="button" id="add-link" style="background-color: #d63638; color: white; font-size: 16px; padding: 10px; border: 2px solid #d63638; border-radius: 5px; cursor: pointer; margin-top: 10px; width: 200px;">
            Añadir otro enlace
        </button>
        <button type="submit" style="background-color: #1b9280; color: white; font-size: 16px; padding: 10px; border: 2px solid #1b9280; border-radius: 5px; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
            Crear Evento
        </button>
    </form>
</div>
 <!-- Modal de carga -->
  <div id="modalLoading" class="modal">
    <div class="modal-content">
      <div class="spinner-loading"></div>
      <p>Creando evento...</p>
    </div>
  </div>

  <!-- Modal de éxito -->
  <div id="modalExito" class="modal">
    <div class="modal-content">
        <p><i class="fa fa-check" aria-hidden="true" style="color:green; font-size: 64px;"></i></p>
        <p class="success">Evento creado con éxito. </p>
    </div>
  </div>

 <!-- Modal de error -->
<div id="modalError" class="modal">
  <div class="modal-content">
    <p id="errorMessage" class="error" style="color: red; font-weight: bold;"></p>
    <button id="closeErrorModal" style="margin-top: 15px; padding: 8px 12px; background-color: #d9534f; color: white; border: none; border-radius: 4px; cursor: pointer;">Cerrar</button>
  </div>
</div>



<script src="https://cdn.tiny.cloud/1/ii32hzm4nqa0zssxf9jocw5a2mfhwkypp0tojzrmxal0hfsw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
    selector: '#event_description',
    menubar: false,
    plugins: 'link image table',
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | link image | bullist numlist',
    relative_urls: false,
    remove_script_host: false,
    document_base_url: '<?php echo get_site_url(); ?>/',
    });
</script>
<script>
    document.getElementById('add-link').addEventListener('click', function () {
        const container = document.getElementById('link-container');
        const newLinkItem = document.createElement('div');
        newLinkItem.classList.add('link-item');
        newLinkItem.innerHTML = `
            <select name="cont_incrustado[]" style="width:200px;">
                <option value="facebook">Facebook</option>
                <option value="instagram">Instagram</option>
                <option value="twitter">Twitter</option>
                <option value="youtube">YouTube</option>
                <option value="pagweb">Página Web</option>
            </select>

            <input type="text" name="link_incrustado[]" placeholder="Link a incrustar" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
            <button type="button" class="remove-link" style="background-color: red; color: white; font-size: 12px; margin-left: 5px; padding: 5px; border: none; border-radius: 3px; cursor: pointer;">
                Eliminar
            </button>
        `;
        container.appendChild(newLinkItem);
        newLinkItem.querySelector('.remove-link').addEventListener('click', function () {
            container.removeChild(newLinkItem);
        });
    });
</script>

<script>
    // Retorna el idioma principal seleccionado
    function getSelectedIdiomaPrincipal() {
        return document.getElementById('idioma').value;
    }

    // Actualiza las opciones del select de traducción excluyendo el idioma principal
function updateIdiomaTraduccionOptions(selectElement) {
    const idiomaPrincipal = getSelectedIdiomaPrincipal();
    const opciones = {
        es: "Español",
        en: "Inglés",
        pt: "Portugués"
    };

    const selects = Array.from(document.querySelectorAll('select[name="idioma-traduccion[]"]'));

    const idiomasUsados = selects
        .filter(sel => sel !== selectElement) // Excluimos el select actual
        .map(sel => sel.value);

    const valorSeleccionado = selectElement.value;
    let opcionValidaSigueExistiendo = false;

    selectElement.innerHTML = '';

    for (const [valor, texto] of Object.entries(opciones)) {
        if (valor !== idiomaPrincipal && !idiomasUsados.includes(valor)) {
            const option = document.createElement('option');
            option.value = valor;
            option.textContent = texto;
            selectElement.appendChild(option);

            if (valor === valorSeleccionado) {
                opcionValidaSigueExistiendo = true;
            }
        }
    }

    if (opcionValidaSigueExistiendo) {
        selectElement.value = valorSeleccionado;
    } else if (selectElement.options.length > 0) {
        selectElement.selectedIndex = 0;
    }
}

    const addTranslateBtn = document.getElementById('add-translate');
    // Añadir campo de traducción (máximo 1 traducción adicional)
    addTranslateBtn.addEventListener('click', function () {
    const container = document.getElementById('traduccion-container');
    const currentItems = container.querySelectorAll('.translate-item');
    if (currentItems.length >= 1) {
        addTranslateBtn.style.display = 'none';
        return;
    }
    const newItem = document.createElement('div');
    newItem.classList.add('translate-item');
    newItem.style.marginTop = "10px";
    newItem.innerHTML = `
        <select name="idioma-traduccion[]" style="width:200px;" class="second-translation">
        
        </select>
        <div class="autocomplete-wrapper" style="position: relative; display: inline-block;">
                <input type="search" name="traduccion_search" placeholder="Buscar evento"
                style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; width: 300px;">
                <div class="spinner" style="display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                <div class="lds-dual-ring"></div>
                </div>
                <input type="hidden" name="traduccion[]" class="traduccion-id">
        </div>
        <button type="button" class="remove-translate" style="background-color: red; color: white; font-size: 12px; margin-left: 5px; padding: 5px; border: none; border-radius: 3px; cursor: pointer;">
            Eliminar
        </button>
    `;
    container.appendChild(newItem);
    actualizarSecondTranslation();


    const select = newItem.querySelector('select');
    updateIdiomaTraduccionOptions(select);
    attachIdiomaChangeClearSearch(select);

    addTranslateBtn.style.display = 'none';

    newItem.querySelector('.remove-translate').addEventListener('click', () => {
    newItem.remove();
    addTranslateBtn.style.display = 'inline-block';

    // Actualiza todos los selects de traducción disponibles
    document.addEventListener('change', function (e) {
    if (e.target && e.target.name === 'idioma-traduccion[]') {
        const selects = document.querySelectorAll('select[name="idioma-traduccion[]"]');
        selects.forEach(updateIdiomaTraduccionOptions);
    }
    });
    });
    // ✅ ACTIVAR el autocomplete para el nuevo input
    const searchInput = newItem.querySelector('input[name="traduccion_search"]');
    setupSearchAutocomplete(searchInput);

        // Oculta el botón después de agregar la traducción
        addTranslateBtn.style.display = 'none';

        // Eliminar traducción
        newItem.querySelector('.remove-translate').addEventListener('click', function () {
            container.removeChild(newTranslateItem);
            // Vuelve a mostrar el botón si se eliminó la traducción
            addTranslateBtn.style.display = 'inline-block';
        });
});

    // 👉Actualiza las traducciones si cambia el idioma principal
    document.getElementById('idioma').addEventListener('change', function () {
        const selects = document.querySelectorAll('select[name="idioma-traduccion[]"]');
        selects.forEach(select => {
            updateIdiomaTraduccionOptions(select);
        });
         // ✅ Elimina la traducción actual si existe
        const traduccionContainer = document.getElementById('traduccion-container');
        const secondTranslation = traduccionContainer.querySelector('.translate-item');
        if (secondTranslation) {
        secondTranslation.remove();
        document.getElementById('add-translate').style.display = 'inline-block';
        }
    });
    // 👉 Validación antes de enviar el formulario
    document.querySelector('form').addEventListener('submit', function (e) {
        const idiomaPrincipal = document.getElementById('idioma').value;
        const traducciones = Array.from(document.querySelectorAll('select[name="idioma-traduccion[]"]'))
            .map(select => select.value);
        if (traducciones.includes(idiomaPrincipal)) {
            e.preventDefault();
            alert("El idioma principal no puede estar también en las traducciones.");
        }
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const idiomaPrincipalSelect = document.getElementById('idioma');

    const idiomas = {
        es: "Español",
        en: "Inglés",
        pt: "Portugués"
    };

    function getIdiomasUsados() {
        return Array.from(document.querySelectorAll('select[name="idioma-traduccion[]"]'))
            .map(sel => sel.value);
    }

    function updateSecondTranslationSelects() {
        const idiomaPrincipal = idiomaPrincipalSelect.value;
        const idiomasUsados = getIdiomasUsados();

        const idiomaDisponible = Object.entries(idiomas).filter(([clave]) =>
            clave !== idiomaPrincipal && !idiomasUsados.includes(clave)
        );

        document.querySelectorAll('select.second-translation').forEach(select => {
            const valorAnterior = select.value;
            select.innerHTML = '';

            idiomaDisponible.forEach(([clave, texto]) => {
                const option = document.createElement('option');
                option.value = clave;
                option.textContent = texto;
                select.appendChild(option);
            });

            // Restaura la selección anterior si sigue disponible
            if (idiomaDisponible.some(([clave]) => clave === valorAnterior)) {
                select.value = valorAnterior;
            } else if (select.options.length > 0) {
                select.selectedIndex = 0;
            }
        });
    }

    // Escuchar cambios en idioma principal y selects de traducción
    idiomaPrincipalSelect.addEventListener('change', updateSecondTranslationSelects);

    document.addEventListener('change', function (e) {
        if (e.target && e.target.name === 'idioma-traduccion[]') {
            updateSecondTranslationSelects();
        }
    });

    // Si agregas un nuevo bloque dinámicamente, llama esto:
    window.actualizarSecondTranslation = updateSecondTranslationSelects;

    // Ejecutar al cargar
    updateSecondTranslationSelects();
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const addTranslateButton = document.getElementById("add-translate");
    const idiomaSelect = document.getElementById("idioma");

    function updateIdiomaTraduccionOptions(selectElement) {
    const idiomaPrincipal = getSelectedIdiomaPrincipal();
    const opciones = {
        es: "Español",
        en: "Inglés",
        pt: "Portugués"
    };

    const selects = Array.from(document.querySelectorAll('select[name="idioma-traduccion[]"]'));
    const idiomasUsados = selects
        .filter(sel => sel !== selectElement)
        .map(sel => sel.value);

    // Guardamos el valor actual seleccionado antes de vaciar
const valorSeleccionado = selectElement.value;

// Limpia las opciones
selectElement.innerHTML = '';

let opcionValidaSigueExistiendo = false;

for (const [valor, texto] of Object.entries(opciones)) {
    if (valor !== idiomaPrincipal && !idiomasUsados.includes(valor)) {
        const option = document.createElement('option');
        option.value = valor;
        option.textContent = texto;

        // Verificamos si el valor anterior aún puede usarse
        if (valor === valorSeleccionado) {
            opcionValidaSigueExistiendo = true;
        }

        selectElement.appendChild(option);
    }
}

// Si el valor anterior todavía es válido, lo seleccionamos de nuevo
if (opcionValidaSigueExistiendo) {
    selectElement.value = valorSeleccionado;
} else if (selectElement.options.length > 0) {
    // Si no, seleccionamos la primera opción disponible
    selectElement.selectedIndex = 0;
}

}

    function actualizarVisibilidadBotonTraduccion() {
        const idiomaPrincipal = idiomaSelect.value;
        const idiomasUsados = Array.from(document.querySelectorAll('select[name="idioma-traduccion[]"]')).map(sel => sel.value);
        const todosIdiomas = ['es', 'en', 'pt'];
        const idiomasDisponibles = todosIdiomas.filter(id => id !== idiomaPrincipal && !idiomasUsados.includes(id));

        if (idiomasDisponibles.length === 0) {
            addTranslateButton.style.display = "none";
        } else {
            addTranslateButton.style.display = "inline-block";
        }
    }

    idiomaSelect.addEventListener("change", function () {
        const selectedValue = this.value;
        const translationContainer = document.querySelector(".traduccion-container");

        if (selectedValue) {
            translationContainer.style.display = "block";
        } else {
            translationContainer.style.display = "none";
            addTranslateButton.style.display = "none";
            return;
        }

        actualizarVisibilidadBotonTraduccion();
    });

    addTranslateButton.addEventListener("click", function () {
        const container = document.createElement("div");
        container.classList.add("traduccion-item");

        const idiomaTraduccionSelect = document.createElement("select");
        idiomaTraduccionSelect.name = "idioma-traduccion[]";

        updateIdiomaTraduccionOptions(idiomaTraduccionSelect);

        const tituloInput = document.createElement("input");
        tituloInput.type = "text";
        tituloInput.name = "titulo-traduccion[]";
        tituloInput.placeholder = "Título traducido";

        const removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.textContent = "Eliminar";
        removeButton.classList.add("remove-translate");

        removeButton.addEventListener("click", function () {
            container.remove();
            actualizarVisibilidadBotonTraduccion();
        });

        container.appendChild(idiomaTraduccionSelect);
        container.appendChild(tituloInput);
        container.appendChild(removeButton);

        document.getElementById("traducciones").appendChild(container);

        updateIdiomaTraduccionOptions(idiomaTraduccionSelect);
        actualizarVisibilidadBotonTraduccion();
    });
});
</script>
<script>
    function attachIdiomaChangeClearSearch(selectElement) {
    selectElement.addEventListener('change', function () {
        const wrapper = selectElement.closest('.translate-item') || selectElement.closest('.autocomplete-wrapper');
        if (!wrapper) return;

        const inputSearch = wrapper.querySelector('input[name="traduccion_search"]');
        const hiddenId = wrapper.querySelector('input.traduccion-id');
        if (inputSearch) inputSearch.value = '';
        if (hiddenId) hiddenId.value = '';
    });
}
</script>

<script>
function setupSearchAutocomplete(input) {
    if (input.dataset.autocompleteAttached === "true") return;
    input.dataset.autocompleteAttached = "true";

    const parent = input.closest('.autocomplete-wrapper');
    const spinner = parent.querySelector('.spinner');
    const hiddenIdInput = parent.querySelector('.traduccion-id');

    function debounce(func, delay) {
        let timer;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    let validSelection = false; // Para saber si se eligió un resultado válido
    let searchCounter = 0;

input.addEventListener("input", debounce(function () {
    const searchTerm = input.value.trim();
    validSelection = false;

    const currentSearch = ++searchCounter;

    const existingResults = parent.querySelectorAll('.autocomplete-results');
    existingResults.forEach(el => el.remove());

    if (searchTerm.length < 3) return;
    spinner.style.display = 'inline-block';

    const resultsBox = document.createElement('ul');
    resultsBox.classList.add('autocomplete-results');

    fetch(`<?php echo admin_url("admin-ajax.php"); ?>?action=buscar_eventos_ajax&term=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(results => {
            if (currentSearch !== searchCounter) return;

            spinner.style.display = 'none';

            if (!results.length) {
                const li = document.createElement('li');
                li.textContent = 'Sin resultados';
                resultsBox.appendChild(li);
            } else {
                results.forEach(post => {
                    const li = document.createElement('li');
                    li.textContent = post.title;
                    li.addEventListener('click', () => {
                        input.value = post.title;
                        if (hiddenIdInput) hiddenIdInput.value = post.id;
                        validSelection = true;
                        resultsBox.remove();
                    });
                    resultsBox.appendChild(li);
                });
            }

            parent.appendChild(resultsBox);
        })
        .catch(error => {
            spinner.style.display = 'none';
            console.error('Error al obtener los resultados:', error);
        });
}, 300));


    document.addEventListener('click', function (e) {
        // Si el clic es fuera del área del buscador
        if (!parent.contains(e.target)) {
            const resultsBox = parent.querySelector('.autocomplete-results');
            if (resultsBox) resultsBox.remove();

            // Si no se seleccionó un resultado válido, limpiar input y ID
            if (!validSelection) {
                input.value = '';
                if (hiddenIdInput) hiddenIdInput.value = '';
            }
        }
    });
}
document.addEventListener("DOMContentLoaded", function () {
    // Activar autocomplete para el primer campo
    const input = document.querySelector('input[name="traduccion_search"]');
    if (input) setupSearchAutocomplete(input);
    //limpia el input de búsqueda al cambiar el idioma
    const select = document.querySelector('select[name="idioma-traduccion[]"]');
    if (select) attachIdiomaChangeClearSearch(select);
});
</scrip>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formEvento");
    const modalError = document.getElementById("modalError");
    const errorMessage = document.getElementById("errorMessage");
    const closeBtn = document.getElementById("closeErrorModal");
    const modalLoading = document.getElementById("modalLoading");
    const modalExito = document.getElementById("modalExito");

    closeBtn.addEventListener("click", function () {
        modalError.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target === modalError) {
            modalError.style.display = "none";
        }
    });
    form.addEventListener("submit", function (e) {
    const startInput = document.getElementById("start_date");
    const endInput = document.getElementById("end_date");
    const claveInput = document.getElementById("clave");

    const startValue = startInput.value;
    const endValue = endInput.value;
    const clave = claveInput.value.trim();
    const claveCorrecta = 'eventosR3d4lyc24'; // Clave también en JS para validación previa

    // Validar fechas
    if (startValue && endValue) {
        const startDate = new Date(startValue);
        const endDate = new Date(endValue);

        if (startDate > endDate) {
            e.preventDefault();
            errorMessage.textContent = "La fecha de fin debe ser posterior a la fecha de inicio.";
            modalError.style.display = "block";
            return;
        }
    }

    // Validar clave
    if (clave !== claveCorrecta) {
        e.preventDefault();
        errorMessage.textContent = "Clave de seguridad incorrecta.";
        modalError.style.display = "block";
        return;
    }

    // Validar idioma principal en traducciones
    const idiomaPrincipal = document.getElementById('idioma').value;
    const traducciones = Array.from(document.querySelectorAll('select[name="idioma-traduccion[]"]')).map(select => select.value);
    if (traducciones.includes(idiomaPrincipal)) {
        e.preventDefault();
        alert("El idioma principal no puede estar también en las traducciones.");
        return;
    }

    // Si todo es válido, mostrar modal de carga
    modalLoading.style.display = "flex";

    // Simula proceso de creación
    setTimeout(() => {
        modalLoading.style.display = "none";
        modalExito.style.display = "flex";

        setTimeout(() => {
            modalExito.style.display = "none";
        }, 3000);
    }, 2000);
});

    });
</script>


<?php get_footer(); ?>
