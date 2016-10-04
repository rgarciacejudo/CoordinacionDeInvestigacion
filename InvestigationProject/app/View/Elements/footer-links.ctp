<div class="small-12 medium-6 large-3 columns">
    <ul class="footer-nav">
        <li><label>UAEM</label></li>
        <li><a href="#">Aviso de Privacidad</a></li>
        <li><a href="#">Directorio Telefónico</a></li>
        <li><a href="#">Gaceta Universitaria</a></li>
        <li><a href="#">Mapa CU</a></li>
        <li><a href="#">Sistemas Institucionales de Información Universitaria</a></li>
        <li><a href="#">Sitios Relacionados</a></li>
    </ul>
</div>
<div class="small-12 medium-12 large-6 columns">
    <ul class="footer-nav">
        <li><label>Enlaces</label></li>
        <?php foreach ($footer_links as $key => $link) { ?>            
            <li><?php echo $this->Html->Link($link['Link']['display_name'], $link['Link']['url']); ?></li>
        <?php } ?>
    </ul>
</div>