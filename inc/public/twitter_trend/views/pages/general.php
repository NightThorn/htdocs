<?php if ($result) { ?>
    <div class="trend-result">
        <h3 class="text-info text-center text-uppercase m-b-30 fw-6"><?php _e(sprintf(__("Top Twitter trends for %s"), $result[0]->locations[0]->name)) ?></h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="color: black;" scope="col"><?php _e("#") ?></th>
                    <th style="color: black;" scope="col"><?php _e("Name") ?></th>
                    <th style="color: black;" scope="col"><?php _e("Volume") ?></th>
                </tr>
            </thead>
            <?php foreach ($result[0]->trends as $key => $value) : ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php _e($key + 1) ?></th>
                        <td><a href="<?php _e($value->url) ?>" target="_blank"><?php _e($value->name) ?></a></td>
                        <td><?php _e(number_format($value->tweet_volume)) ?></td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
<?php } else { ?>
    <div class="wrap-m h-100">
        <div class="empty">
            <div class="icon"></div>
        </div>
    </div>
<?php } ?>