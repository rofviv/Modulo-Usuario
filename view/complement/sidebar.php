<?php
	$privilegios = new Privilegio();
	$menu = $privilegios->listar();
	$count = count($menu);
?>
<aside class="main-sidebar">
	<section class="sidebar">
    <div class="user-panel">
     <span>Menu</span>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
			<?php for ($i=0; $i < $count; $i++) { ?>
					<li><a href="?view=<?php echo $menu[$i]['enlace']; ?>" ><i class="<?php echo $menu[$i]['icon']; ?>" ></i> <span><?php echo $menu[$i]['opcion']; ?></span></a></li>
			<?php } ?>
    </ul>
  </section>
</aside>
