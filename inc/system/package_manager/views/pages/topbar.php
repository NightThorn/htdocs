<?php
$team_id = _t("id");
$uid = _u("id");
$CI = &get_instance();
$theme = $CI->main_model->get("*", "sp_users", "id = '{$uid}'");
$team = $this->main_model->get("*", "sp_team", "id = '" . $team_id . "'");

if ($team->owner == $uid) {
    $expiration_date = _u("expiration_date");
} else {
    $user = $this->main_model->get("expiration_date", "sp_users", " id = '{$team->owner}' ");
    $expiration_date = $user->expiration_date;
}
?>

<div class="m-r-10 m-t-2 d-none d-sm-block">
    <i style="font-size: x-large; padding: 10px;" class="far fa-lightbulb"></i>

    <label class="switch">
        <input type="checkbox" <?php echo $theme->theme == 1 ? 'checked' : '' ?> id="onoffswitch">
        <span class="slider round"></span>
    </label>
    <i style="font-size: x-large; padding: 10px; color: #efef27;" class="fas fa-lightbulb"></i>

</div>

<?php if (!_u("role") && strtotime($expiration_date . "23:59:59") < time()) { ?>
    <span class="position-absolute w-100 text-white bg-danger l-1 t-65 p-t-16 p-b-16 p-l-25 p-r-25"><i class="far fa-bell"></i> <?php _e("Your subscription has expired. Renew your subscription so as not to interrupt your plan.") ?></span>
<?php } else { ?>
    <div class="m-t-10 d-none d-sm-block">
        <span class="m-r-10"><?php _e(sprintf(__("Subscription expires: %s"), date_show($expiration_date))) ?></span>
    </div>
<?php } ?>
<div class="m-r-10 m-t-2 d-none d-sm-block">
    <?php if (find_modules("payment")) { ?>
        <a href="<?php _e(get_url("pricing")) ?>" class="btn btn-info text-uppercase"><?php _e("Upgrade now") ?></a>
    <?php } ?>
</div>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        vertical-align: middle;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<script>
    $(document).ready(function() {
        $('#onoffswitch').click(function() {
            var mode = $(this).prop('checked');
            if (mode) {
                var value = 1;
                $("body").attr('id', 'sidebar-dark');

            } else {
                var value = 0;
                $("body").attr('id', 'full-dark');


            }
            $.ajax({
                url: "<?php echo base_url('dashboard/settheme'); ?>",
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                    "theme": value,
                },
                success: function(data) {
                    console.log(data);

                },
                cache: false,
                error: function(data) {
                    console.log("faillll");
                }
            });
        });
    });
</script>