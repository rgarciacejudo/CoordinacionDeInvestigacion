<ul class="example-orbit" data-orbit>
  <?php foreach ($advertisements as $key => $ad) { ?>
  <li>
    <a target="_blank" href="<?php echo $ad['Advertisement']['url']; ?>">    
      <?php echo $this->Html->image($ad['Advertisement']['file_path'], array(
              'alt' => $ad['Advertisement']['name'])); ?>
      <div class="orbit-caption">      
        <a target="_blank" href="<?php echo $ad['Advertisement']['url']; ?>">
          <?php echo $ad['Advertisement']['name']; ?>. 
          <span><?php echo $ad['Advertisement']['description']; ?></span>
        </a>
      </div>
    </a>
  </li>  
  <?php } ?>  
</ul>
<script>
  $(document).ready(function(){
    $(document).foundation({
        orbit: {
            animation: 'fade',
            timer: true,
            timer_speed: 2000,
            timer_paused_class: 'slider-pause',
            slide_number: true,
            pause_on_hover: false,
            animation_speed: 1000,
            navigation_arrows: true,
            variable_height: false,
            bullets: false
        }
    });
  });
</script> 