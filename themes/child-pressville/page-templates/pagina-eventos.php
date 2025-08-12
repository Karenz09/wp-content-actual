<?php
/*
Template Name: Página de Eventos
*/

get_header(); // Incluye el encabezado
?>

<style>
/* Tu CSS, que está muy bien */
.contenedor-eventos {
    text-align: center;
    padding: 20px;
}
.lista-eventos {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}
.evento {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 250px;
    transition: transform 0.3s ease-in-out;
}
.evento:hover {
    transform: scale(1.05);
}
.evento-link {
    text-decoration: none;
    color: inherit;
    display: block;
}
.evento .imagen img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.info-evento {
    padding: 15px;
    text-align: left;
}
.info-evento h3 {
    font-size: 1.1rem;
    margin-bottom: 5px;
    color: #333;
}
.info-evento p {
    font-size: 0.9rem;
    color: #666;
    margin: 5px 0;
}
.ver-mas {
    display: inline-block;
    margin-top: 10px;
    font-weight: bold;
    color: #359e8e;
}
.ver-mas:hover {
    text-decoration: underline;
}
</style>
<?php
    $idioma = function_exists('pll_current_language') ? pll_current_language() : 'es'; // Idioma por defecto

    $titulo = [
        'es' => 'Eventos',
        'en' => 'Events',
        
    ];

    $inicio = [
        'es' => 'Inicio',
        'en' => 'Start',
        
    ];
    $fin = [
        'es' => 'Fin',
        'en' => 'End',
        
    ];
    $ver_mas = [
        'es' => 'Ver más',
        'en' => 'See more',
    ];
?>
<div class="contenedor-eventos">
    <h2><?php echo $titulo[$idioma];?></h2>
    <div class="lista-eventos">
        <?php
        // Obtener el idioma actual con Polylang
        $current_lang = pll_current_language(); // 'es' o 'en', etc.

        // Consulta de eventos en el idioma actual
        $args = array(
            'post_type'      => 'lsvr_event',
            'post_status'    => 'publish',
            'orderby'        => 'post_date',
            'order'          => 'DESC',
            'posts_per_page' => -1, // Trae todos
            'lang'           => $current_lang, // ← aquí filtramos por idioma
        );

        $eventos = new WP_Query($args);

        if (!$eventos->have_posts()) :
            ?>
            <p>No hay eventos disponibles.</p>
        <?php
        else :
            while ($eventos->have_posts()) : $eventos->the_post();
                $start_date = get_post_meta(get_the_ID(), 'lsvr_event_start_date_utc', true);
                $end_date = get_post_meta(get_the_ID(), 'lsvr_event_end_date_utc', true);

                // Formatear fechas
                $start_date_formatted = $start_date ? date("d/m/Y", strtotime($start_date)) : "No disponible";
                $end_date_formatted = $end_date ? date("d/m/Y", strtotime($end_date)) : "No disponible";

                $imagen_destacada = get_the_post_thumbnail(get_the_ID(), 'medium');
                $enlace_evento = get_permalink(get_the_ID());
                ?>
                <div class="evento">
                    <a href="<?php echo esc_url($enlace_evento); ?>" class="evento-link" target="_blank">
                        <?php if ($imagen_destacada): ?>
                            <div class="imagen">
                                <?php echo $imagen_destacada; ?>
                            </div>
                        <?php endif; ?>
                        <div class="info-evento">
                            <h3><?php the_title(); ?></h3>
                            <p><strong><?php echo $inicio[$idioma]; ?>:</strong> <?php echo esc_html($start_date_formatted); ?></p>
                            <p><strong><?php echo $fin[$idioma]; ?>:</strong> <?php echo esc_html($end_date_formatted); ?></p>
                            <span class="ver-mas"><?php echo $ver_mas[$idioma];  ?> →</span>
                        </div>
                    </a>
                </div>
            <?php
            endwhile;
            wp_reset_postdata(); // Siempre después del loop con WP_Query
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
