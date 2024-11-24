<?php
 if (isset($_GET['city_saved']) && $_GET['city_saved'] === '1') {
    echo '<p>' . esc_html__('Sikeres mentés!', 'custom-city') . '</p>';
}

$user_id = get_current_user_id();
$saved_city = get_user_meta($user_id, 'custom_city', true);
$nonce = wp_nonce_field('custom_city_nonce_action', 'custom_city_nonce', true, false);

?>
<form method="POST">
    <?php echo $nonce; ?>
    <select name="city" id="city">
        <option value="debrecen" <?php echo (isset($saved_city) && $saved_city === 'debrecen')? 'selected' : '' ?>><?php esc_html_e('Debrecen', 'custom-city'); ?></option>
        <option value="budapest" <?php echo (isset($saved_city) && $saved_city === 'budapest')? 'selected' : '' ?>><?php esc_html_e('Budapest', 'custom-city'); ?></option>
        <option value="sopron" <?php echo (isset($saved_city) && $saved_city === 'sopron')? 'selected' : '' ?>><?php esc_html_e('Sopron', 'custom-city'); ?></option>
    </select>
    <button type="submit"><?php esc_html_e('Mentés', 'custom-city'); ?></button>
</form>
