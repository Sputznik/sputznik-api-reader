<ul class="articles-three-grid orbit-three-grid orbit-list-db">
  <?php foreach( $posts as $post ):
    $permalink = $post->link;
    $date = date('F j, Y', strtotime( $post->date ) );
    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->id ), 'full' )[0];
    $background_img = !empty( $thumbnail ) ? 'style="background-image:url('.$thumbnail.');"' : "";
  ?>
    <li class="orbit-article-db">
  		<div class="orbit-thumbnail-bg" <?php _e( $background_img ); ?>>
        <a href="<?php _e( $permalink );?>"></a>
      </div>
      <div class="post-desc">
        <h3 class="post-title"><a href="<?php _e( $permalink );?>"><?php _e( $post->title->rendered );?></a></h3>
        <span class="meta text-capitalize"><?php _e( $date )?></span>
        <div class="post-excerpt"><?php _e( $post->excerpt->rendered );?><a class="read-more" href="<?php _e( $permalink );?>">continue reading</a></div>
      </div>
    </li>
	<?php endforeach;?>
</ul>
