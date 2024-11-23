<?php
$eventDate = new DateTime(get_field('event_date'));
?>

<div class="row shadow-sm py-2 mb-3 rounded">
                <div class="col-md-3">
                    <div class="event-date">

                        <span class="month">
                            <?php echo $eventDate->format('M'); ?>
                        </span>
                        <span class="day">
                            <?php echo $eventDate->format('d'); ?>
                        </span>
                        <!-- <span><?php echo $eventDate->format('y'); ?></span> -->
                    </div>

                </div>
                <div class="col-md-9">
                    <h5><a href="<?php the_permalink(  ); ?>">
                            <?php the_title(); ?>
                        </a></h5>
                    <p>
                        <?php 
                        
                         
                        
                        if(has_excerpt()){
                            echo get_the_excerpt();

                        } else {
                            echo wp_trim_words( get_the_content (), 18  );
                        }
                        
                        
                         ?>
                        <a href="<?php the_permalink(  ); ?>" class="nu gray">Learn more</a>
                    </p>
                </div>
            </div>