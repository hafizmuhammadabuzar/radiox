<?php if(count($sch) > 0){ ?>
<ul class="SchduleList">
    <?php foreach ($sch as $row): ?>
        <li>        	
            <div>
                <h2><?php echo $row['title']; ?></h2>
                &ldquo;<?php echo $row['description']; ?>&rdquo;
            </div>
            <?php 
                $time = date('h:i A', strtotime($row['time']) - 4 * 60 * 60);
            ?>
            <span class="time"><?php echo date('h:i A', strtotime($time) + $dst * 60 * 60); ?></span>
        </li>
    <?php endforeach; ?>
</ul>
<?php }else{ ?> 
<ul class="SchduleList">
    Free Day ;)    
</ul>
<?php } ?> 