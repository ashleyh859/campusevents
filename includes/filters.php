<aside class="filters">
  <h2>Filter</h2>
  <ul>
    <li>
      <a href="<?php echo $filter_base_url; ?>#events-section">All Events</a>
    </li>
    <?php foreach ($tags as $tag) { ?>
      <li>
        <a href="<?php echo $filter_base_url; ?>?<?php echo http_build_query(array('tag' => $tag['name'])); ?>#events-section">
          <?php echo htmlspecialchars($tag['name']); ?>
        </a>
      </li>
    <?php } ?>
  </ul>
</aside>
