<?php $count = count($footer_links); ?>
<?php $offset = (int)($count / 3); ?>
<div class="small-12 medium-6 large-3 columns">
  <ul class="footer-nav">
      <?php for ($i = 0; $i < $offset - 1; $i++) { ?>
          <li>
            <?php if (!$footer_links[$i]['Link']['image']) : ?>
              <?php echo $this->Html->Link($footer_links[$i]['Link']['display_name'], $footer_links[$i]['Link']['url']); ?>
            <?php else : ?>
              <?php echo $this->Html->link(
                  $this->Html->image($footer_links[$i]['Link']['image'], array(
                      'alt' => $footer_links[$i]['Link']['name'])),
                  $footer_links[$i]['Link']['url'], array('escape' => false)); ?>
            <?php endif ?>
          </li>
      <?php } ?>
  </ul>
</div>
<div class="small-12 medium-6 large-3 columns">
  <ul class="footer-nav">
      <?php for ($i = $offset; $i < $offset * 2; $i++) { ?>
        <li>
          <?php if (!$footer_links[$i]['Link']['image']) : ?>
            <?php echo $this->Html->Link($footer_links[$i]['Link']['display_name'], $footer_links[$i]['Link']['url']); ?>
          <?php else : ?>
            <?php echo $this->Html->link(
                $this->Html->image($footer_links[$i]['Link']['image'], array(
                    'alt' => $footer_links[$i]['Link']['name'])),
                $footer_links[$i]['Link']['url'], array('escape' => false)); ?>
          <?php endif ?>
        </li>
      <?php } ?>
  </ul>
</div>
<div class="small-12 medium-12 large-3 columns">
    <ul class="footer-nav">
      <?php for ($i = $offset * 2; $i < $count; $i++) { ?>
        <li>
          <?php if (!$footer_links[$i]['Link']['image']) : ?>
            <?php echo $this->Html->Link($footer_links[$i]['Link']['display_name'], $footer_links[$i]['Link']['url']); ?>
          <?php else : ?>
            <?php echo $this->Html->link(
                $this->Html->image($footer_links[$i]['Link']['image'], array(
                    'alt' => $footer_links[$i]['Link']['name'])),
                $footer_links[$i]['Link']['url'], array('escape' => false)); ?>
          <?php endif ?>
        </li>
      <?php } ?>
    </ul>
</div>
