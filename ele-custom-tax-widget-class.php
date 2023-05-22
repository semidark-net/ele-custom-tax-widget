<?php
use Elementor\Widget_Base;

class Ele_Custom_Tax_Widget extends Widget_Base {

    public function get_name() {
        return 'ele-custom-tax-widget';
    }

    public function get_title() {
        return __('Taxonomy List', 'ele-custom-tax-widget');
    }

    public function get_icon() {
        // Icons can be found here: 
        // https://elementor.github.io/elementor-icons/
        return 'eicon-posts-grid';
    }
    
    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'ele-custom-tax-widget'),
            ]
        );

        $this->add_control(
            'taxonomy',
            [
                'label' => __('Taxonomy', 'ele-custom-tax-widget'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_taxonomy_options(),
                'default' => '',
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icon Field', 'ele-custom-tax-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    protected function get_taxonomy_options()
    {
        $taxonomies = get_taxonomies();
        $options = [];
        foreach ($taxonomies as $taxonomy) {
            $options[$taxonomy] = $taxonomy;
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    
        if (!empty($settings['taxonomy'])) {
            $taxonomy = $settings['taxonomy'];
            $terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ));
    
            if (!empty($terms)) {
                echo '<ul class="custom-tax-widget-list">';
                foreach ($terms as $term) {
                    if (!empty($settings['icon'])) {
                        $icon = 'class="'.get_field($settings['icon'], $term).'"';
                    }

                    // Get the archive link for the term
                    $term_link = get_term_link($term); 
                    if (!is_wp_error($term_link)) {
                        echo '<a href="' . esc_url($term_link) . '"><li '.$icon.'><span>' . $term->name . '</span></li></a>';
                    } else {
                        echo '<li  '.$icon.'"><span>' . $term->name . '</span></li>';
                    }
                }
                echo '</ul>';
            } else {
                echo 'No taxonomy entries found.';
            }
        }
    }    
}