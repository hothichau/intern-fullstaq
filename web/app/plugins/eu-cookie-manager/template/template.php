<?php
global  $sb_eucookie;

$request_data = sanitize_text_field($_POST['lang']);
if(isset($request_data) && !empty($request_data)) {
    $lang = $request_data;
} else {
    $lang = 'en';
}

$extraClass = $backgroundcolor = $target ='';
if(wp_is_mobile()) {
    $extraClass = ' cc-mobile';
}
if ( !empty($sb_eucookie->sb_cookie_option('customurl', $lang))) {
    $link =  $sb_eucookie->sb_cookie_option('customurl', $lang);
    if ( $sb_eucookie->sb_cookie_option('boxlinkblank', $lang) ) { $target = 'target="_blank" '; }
}  else {
    $link = '#';
} 



if(!empty($sb_eucookie->sb_cookie_option('barbutton', $lang))) {
    $button_accept = $sb_eucookie->sb_cookie_option('barbutton', $lang);
} else {
    $button_accept = 'Accept';
}

if(!empty($sb_eucookie->sb_cookie_option('fontcolor', $lang))) {
    $color = 'color:'.$sb_eucookie->sb_cookie_option('fontcolor', $lang);
} else {
    $color = '';
}

$outCss = $this->sb_cookie_option('outcss');
if(empty($outCss)) {
    if(!empty($sb_eucookie->sb_cookie_option('backgroundcolor', $lang))) {
        $backgroundcolor = 'style="background-color: '.$sb_eucookie->sb_cookie_option('backgroundcolor', $lang).'"';
    }
    
    if(!empty($sb_eucookie->sb_cookie_option('position', $lang))) {
        if($sb_eucookie->sb_cookie_option('position', $lang) == 'sb_cookie_top') {    
            if(!empty($backgroundcolor)) {
                $backgroundcolor= 'style="background-color: '.$sb_eucookie->sb_cookie_option('backgroundcolor', $lang).'; top:0px; bottom:auto"';
            } else {
                $backgroundcolor = 'style="top:0px; bottom:auto"';
            }
        }
        
    }
}
?>
<div class="cc-window<?php echo esc_attr($extraClass); ?>" <?php echo $backgroundcolor; ?>>
    <div class="cc-wrapper">
        <div class="cc-message" style="<?php echo esc_attr($color); ?>">           
            <?php echo $sb_eucookie->sb_cookie_option('barmessage', $lang); ?>
        </div>
        <div class="cc-compliance">
            <?php if(!empty($sb_eucookie->sb_cookie_option('barlink', $lang))): ?>
                <a class="cc-btn more-btn" <?php echo esc_attr($target); ?> href="<?php echo esc_url($link); ?>"><?php echo esc_attr($sb_eucookie->sb_cookie_option('barlink', $lang)); ?></a>
            <?php endif; ?>
            <?php if(!empty($sb_eucookie->sb_cookie_option('denybutton', $lang))): ?>
                <a class="cc-btn btn-deny" id="sb_cook_deny"><?php echo esc_attr($sb_eucookie->sb_cookie_option('denybutton', $lang)); ?></a>
            <?php endif; ?>
            <a class="cc-btn" id="sb_cook_accept"><?php echo esc_attr($button_accept); ?></a>
        </div>
    </div>
</div>