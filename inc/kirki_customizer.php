<?php
if(!class_exists('Kirki')){
    return;
}

/* new \Kirki\Panel(
	'land_panel_id',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'My Panel', 'kirki' ),
		'description' => esc_html__( 'My Panel Description.', 'kirki' ),
	]
); */

new \Kirki\Section(
	'land_section_id',
	[
		'title'       => esc_html__( 'My Section', 'kirki' ),
		'description' => esc_html__( 'My Section Description.', 'kirki' ),
		/* 'panel'       => 'land_panel_id', */
		'priority'    => 10,
	]
);

new \Kirki\Field\Image(
	[
		'settings'    => 'logo_mobile_url',
		'label'       => esc_html__( 'logo Mobile', 'kirki' ),
		'section'     => 'land_section_id',
		'default'     => '',
	]
);

new \Kirki\Field\Text(
	[
		'settings' => 'affiliate_text',
		'label'    => esc_html__( 'Affiliate Title', 'kirki' ),
		'section'  => 'land_section_id',
		'default'  => esc_html__( 'Existing Affiliate?', 'kirki' ),
		'priority' => 10,
	]
);

new \Kirki\Field\URL(
	[
		'settings' => 'affiliate_url',
		'label'    => esc_html__( 'Existing Affiliate URL', 'kirki' ),
		'section'  => 'land_section_id',
		'priority' => 10,
	]
);

new \Kirki\Field\Text(
	[
		'settings' => 'login_text',
		'label'    => esc_html__( 'Login Title', 'kirki' ),
		'section'  => 'land_section_id',
		'default'  => esc_html__( 'LOGIN', 'kirki' ),
		'priority' => 10,
	]
);

new \Kirki\Field\URL(
	[
		'settings' => 'login_url',
		'label'    => esc_html__( 'Login URL', 'kirki' ),
		'section'  => 'land_section_id',
		'priority' => 10,
	]
);

new \Kirki\Field\Editor(
	[
		'settings'    => 'footer_copyright',
		'label'       => esc_html__( 'Copyright Text', 'kirki' ),
		'section'     => 'land_section_id',
		'default'     => esc_html__( 'Copyright Affiliates.Land 2024', 'kirki' ),
	]
);