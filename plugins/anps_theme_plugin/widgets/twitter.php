<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;


class Anps_Twitter extends Widget_Base{

  public function get_name(){
    return 'twitter';
  }

  public function get_title(){
    return 'Anps Twitter';
  }

  public function get_icon(){
    return 'fab fa-twitter';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_twitter',
        [
            'label' => __( 'Twitter', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'slug',
        [
            'label' => __( 'Slug', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'description' => 'It should be unique value',
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'title',
        [
            'label' => __( 'Title', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter twitter title', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'tw_number',
        [
            'label' => __( 'Number of tweets', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '3', 'anps_theme_plugin' ),
            'description' => 'Enter number of tweets to display. (default 3)',
            'label_block' => true,
        ]
    );
    $this->add_control(
        'content',
        [
            'label' => __( 'Twitter username', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter twitter username', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'title_color',
        [
            'label' => __('Title color', 'anps_theme_plugin'),
            'type'  => Controls_Manager::COLOR,
            'scheme'=> [
                'type'  => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'color: {{VALUE}};',
            ],
            'default' => __( '#000000', 'anps_theme_plugin' ),
        ]
    );
    $this->add_control(
        'text_color',
        [
            'label' => __('Text color', 'anps_theme_plugin'),
            'type'  => Controls_Manager::COLOR,
            'scheme'=> [
                'type'  => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'color: {{VALUE}};',
            ],
            'default' => __( '#7f7f7f', 'anps_theme_plugin' ),
        ]
    );
    
    $this->end_controls_section();
}

/**
 * Render alert widget output on the frontend.
 *
 * Written in PHP and used to generate the final HTML.
 *
 * @since 1.0.0
 * @access protected
 */
protected function render() {
    $settings = $this->get_settings_for_display();
    
        //store value from controls
        $title = $settings['title'];
        $slug = $settings['slug'];
        $tw_number = $settings['tw_number'];
        $content = $settings['content'];
        $title_color = $settings['title_color'];
        $text_color = $settings['text_color'];

        //display on frontend
        
        $tw_number = intval($tw_number);
        if ( $tw_number <= 0 ) {
            $tw_number = 3;
        }
        if ( $tw_number > 20 ) {
            $tw_number = 20;
        }

       include_once WP_PLUGIN_DIR . '/anps_theme_plugin/twitter/TwitterAPIExchange.php';
        $settings_s = array(
            'oauth_access_token' => "1485322933-oo8YU1ZTz5E4Zt92hTTbCdJoZxIJIabghjnsPkX",
            'oauth_access_token_secret' => "RfXHN2OXMkBYp3IaEqrBmPhUYR2N61P8pyHf8QXqM",
            'consumer_key' => "Zr397FLlTFM4RVBsoLVgA",
            'consumer_secret' => "3Z2wNAG2vvunam2mfJATxnJcThnqw1qu02Xy8QlqFI"
        );
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=' . $content . '&count=' . $tw_number;
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings_s);
        $tweets = json_decode($twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest());
        echo '<section class="carousel anps-twitter text-center" >';
        if ($title != '') {
            echo '<h2 class="title" style="color:' . $title_color .'">'.$title.'</h2>';
        }
        echo '<div class="owl-carousel owl-loaded">';
        
        $j=0;
        
        foreach( $tweets as $tweet ) {
            
            if($j=="0") {
                $class_active = ' active';
            } else {
                $class_active = '';
            }
            $tweet_text = $tweet->text;
            // print_r($tweet_text);
            $tweet_text = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i','<a href="http://$1" target="_blank">http://$1</a>', $tweet_text); //replace links
            $tweet_text = preg_replace('/https:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="https://$1" target="_blank">https://$1</a>', $tweet_text); //replace links
            $tweet_text = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet_text); //replace users
            echo '<div class="owl-item" style="width: 300px;">';
            echo '<div class="owl-item text-center" style="color:' . $text_color . '">' . $tweet_text . '</div>';
            echo "</div>";
            $j++;
        }
        echo "</div>";
        echo '<div class="twitter-owl-nav owl-nav-pull-right">';
        echo '<button class="owlprev"><i class="fa fa-angle-left"></i></button>';
        echo '<button class="owlnext"><i class="fa fa-angle-right"></i></button>';
        echo '</div>';
        echo '</section>';       
        
        
    }
}