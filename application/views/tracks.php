<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
        <link href="<?php echo base_url(); ?>assets/css/inner_style.css" rel="stylesheet" type="text/css" />	

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.fancybox-media')
                        .attr('rel', 'media-gallery')
                        .fancybox({
                            openEffect: 'none',
                            closeEffect: 'none',
                            prevEffect: 'none',
                            nextEffect: 'none',

                            arrows: false,
                            helpers: {
                                media: {},
                                buttons: {}
                            }
                        });
            });
        </script>
        <title>Radio X</title>
    </head>
    <body class="paddingNone">

        <div id="TopTwenty">        
            <ul>
                <?php foreach($tracks as $row): ?>
                <li>
                    <span class="OrderNum"><?php echo sprintf('%02d', $row['sort']); ?></span>
                    <a href="<?php echo $row['url']; ?>" class="fancybox-media BtnPlay"></a>	
                    <div class="LeftArea">

                        <h4><?php echo $row['title']; ?></h4>
                        <span><?php echo $row['movie']; ?></span>
                    </div>
                    <div class="RightArea">
                        <?php if(!empty($row['image'])): ?>
                            <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $row['image']; ?>" alt="image" />
                        <?php else: 
                            $image = substr($row['url'], -11, 11);
                        ?>
                            <img src="https://img.youtube.com/vi/<?php echo $image; ?>/hqdefault.jpg" alt="image" />
                        <?php endif; ?>
                    </div>
                    <div class="clear"></div>

                    <div class="BottomFull">
                        <div class="CountBox">
                            Last week's Position
                            <span><?php echo $row['last_week_position']; ?></span>
                        </div>
                        <div class="CountBox">
                            Weeks on Chart
                            <span><?php echo $row['weeks_on_chart']; ?></span>
                        </div>
                        <div class="CountBox">
                            Peak Position
                            <span><?php echo $row['peak_position']; ?></span>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </body>

</html>
