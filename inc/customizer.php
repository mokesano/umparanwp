<?php 

function addCustomize($wp_customize) {
	$wp_customize->add_panel( 'ThemesappPos', array(
	  'title' => 'Themesapp',
	  'priority' => 162,
	));


		// Warna =========================================================== 
		$wp_customize->add_section( 'color', array(
	    	'title' => 'Warna Situs',
		  	'description'=> 'Warna-warna yang ada dibawah ini adalah warna umum yang digunakan pada tema. Ubah warna-warna tersebut sesuai dengan selera dan keinginan anda.',
			'panel' => 'ThemesappPos',
	    ));
	    $wp_customize->add_setting( 'color1' , array(
	        'default'     => "#04a4a4",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color1', array(
	        'label'        => 'Warna 1',
	        'section'    => 'color',
	    )));
	    $wp_customize->add_setting( 'color2' , array(
	        'default'     => "#038383",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color2', array(
	        'label'        => 'Warna 2',
	        'section'    => 'color',
	    )));
	    $wp_customize->add_setting( 'color3' , array(
	        'default'     => "#dc1641",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color3', array(
	        'label'        => 'Warna 3',
	        'section'    => 'color',
	    )));
	    $wp_customize->add_setting( 'color4' , array(
	        'default'     => "#1f8dd6",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color4', array(
	        'label'        => 'Warna 4',
	        'section'    => 'color',
	    )));
	    $wp_customize->add_setting( 'color5' , array(
	        'default'     => "#1870ab",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color5', array(
	        'label'        => 'Warna 5',
	        'section'    => 'color',
	    )));
	    $wp_customize->add_setting( 'color6' , array(
	        'default'     => "#ef700d",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color6', array(
	        'label'        => 'Warna 6',
	        'section'    => 'color',
	    )));




		// Warna =========================================================== 
		$wp_customize->add_section( 'custommenu', array(
	    	'title' => 'Custom Menu',
		  	'description'=> 'Warna-warna yang ada dibawah ini adalah warna yang dipakai pada widget custom menu',
			'panel' => 'ThemesappPos',
	    ));
	    $wp_customize->add_setting( 'menu1' , array(
	        'default'     => "#dc1641",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu1', array(
	        'label'        => 'color1',
	        'section'    => 'custommenu',
	    )));
	    $wp_customize->add_setting( 'menu2' , array(
	        'default'     => "#f28c3d",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu2', array(
	        'label'        => 'color2',
	        'section'    => 'custommenu',
	    )));
	    $wp_customize->add_setting( 'menu3' , array(
	        'default'     => "#1870ab",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu3', array(
	        'label'        => 'color3',
	        'section'    => 'custommenu',
	    )));
	    $wp_customize->add_setting( 'menu4' , array(
	        'default'     => "#4ba3de",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu4', array(
	        'label'        => 'color4',
	        'section'    => 'custommenu',
	    )));
	    $wp_customize->add_setting( 'menu5' , array(
	        'default'     => "#36b6b6",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu5', array(
	        'label'        => 'color5',
	        'section'    => 'custommenu',
	    )));
	    $wp_customize->add_setting( 'menu6' , array(
	        'default'     => "#e34467",
	        'transport'   => 'refresh',
	    ));
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu6', array(
	        'label'        => 'color6',
	        'section'    => 'custommenu',
	    )));


		/* ARCHIVE */
		$wp_customize->add_section( 'stylearchive' , array(
		  'title'      => 'Style Archive', 
		  'panel' => 'ThemesappPos',
		  'description'=> 'Secara default template menggunakan style list. Berikut ini adalah pengaturan style custom di halaman archive',
		));
		$wp_customize->add_setting( 'stylearchivegrid' , array(
			'default'    => '',
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('stylearchivegrid' , array(
			'section' => 'stylearchive',
			'label' =>'Daftar kategori dengan style grid',
			'type'=>'text',
		));
		$wp_customize->add_setting( 'stylearchivecollection' , array(
			'default'    => '',
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('stylearchivecollection' , array(
			'section' => 'stylearchive',
			'label' =>'Daftar kategori dengan style collection',
			'type'=>'text',
		));
		$wp_customize->add_setting( 'stylearchivepoprecent' , array(
			'default'    => '',
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('stylearchivepoprecent' , array(
			'section' => 'stylearchive',
			'label' =>'Daftar kategori dengan style popular dan terbaru',
			'type'=>'text',
		));
		$wp_customize->add_setting( 'stylearchiverentang' , array(
		    'default'    => '10 years ago',
		    'type'       => 'theme_mod',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'stylearchiverentang', array(
			    'label'      => 'Rentang',
			    'description' => 'Pilih opsi rentang jika style popular dan terbaru diisi',
			    'priority'   => 10,
			    'section'    => 'stylearchive',
			    'type'    => 'select',
			    'choices' => array(
			        '10 years ago' => 'All',
			        '1 day ago' => '1 Hari',
			        '7 day ago' => '7 Hari',
			        '1 month ago' => '1 Bulan',
			        '1 years ago' => '1 Tahun',
			    )
			)
		));

		
		/* UNGGULAN */
		$wp_customize->add_section( 'featuredimage' , array(
		  'title'      => 'Gambar Unggulan', 
		  'panel' => 'ThemesappPos',
		  'description'=> 'Berikut ini adalah pengaturan gambar unggulan pada halaman pos dan page',
		));
		$wp_customize->add_setting( 'featuredimageactivepos' , array(
			'default'    => false,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('featuredimageactivepos' , array(
			'section' => 'featuredimage',
			'label' =>'Tampilkan gambar unggulan dihalaman pos',
			'type'=>'checkbox',
		));

		$wp_customize->add_setting( 'featuredimageactivepage' , array(
			'default'    => false,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('featuredimageactivepage' , array(
			'section' => 'featuredimage',
			'label' =>'Tampilkan gambar unggulan dihalaman laman',
			'type'=>'checkbox',
		));
		$wp_customize->add_setting( 'categoryfeaturedimagea' , array(
			'default'    => '',
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('categoryfeaturedimagea' , array(
			'section' => 'featuredimage',
			'label' =>'Daftar kategori tanpa gambar unggulan',
			'type'=>'text',
		));

		/* REDAKSI */
		$wp_customize->add_section( 'timredaksi' , array(
		  'title'      => 'Tim Redaksi',     
		  'panel' => 'ThemesappPos',
		  'description'=> 'Berikut ini adalah pengaturan tampilan untuk tim redaksi yang terdiri dari pengaturan penulis, editor, dan reporter',
		));

		$wp_customize->add_setting( 'timredaksiactive' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('timredaksiactive' , array(
			'label' => 'Tampilkan tim redaksi',
			'section' => 'timredaksi',
			'type'=>'checkbox',
		));
		$wp_customize->add_setting( 'tombolredaksititle' , array(
			'default'    => 'Tim Redaksi',
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('tombolredaksititle' , array(
			'section' => 'timredaksi',
			'label' =>'Judul Tombol',
			'type'=>'text',
		));
		$wp_customize->add_setting( 'timredaksipenulis' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('timredaksipenulis' , array(
			'label' => 'Tampilkan penulis',
			'section' => 'timredaksi',
			'type'=>'checkbox',
		));

		$wp_customize->add_setting( 'timredaksieditor' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('timredaksieditor' , array(
			'label' => 'Tampilkan editor',
			'section' => 'timredaksi',
			'type'=>'checkbox',
		));
		$wp_customize->add_setting( 'timredaksireporter' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('timredaksireporter' , array(
			'label' => 'Tampilkan reporter',
			'section' => 'timredaksi',
			'type'=>'checkbox',
		));

			
		/* SHARE */
		$wp_customize->add_section( 'tombolbagikan' , array(
		  'title'      => 'Tombol Bagikan',     
		  'panel' => 'ThemesappPos',
		  'description'=> 'Berikut ini adalah pengaturan tampilan untuk popup tombol share. Disini kamu bisa mengatur tombol mana yang ingin kamu aktifkan',
		));
		$wp_customize->add_setting( 'tombolsharetitle' , array(
			'default'    => 'Bagikan',
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('tombolsharetitle' , array(
			'section' => 'tombolbagikan',
			'label' =>'Judul Tombol',
			'type'=>'text',
		));
		$wp_customize->add_setting( 'tombolwhatsapp' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('tombolwhatsapp' , array(
			'label' => 'Whatsapp',
			'section' => 'tombolbagikan',
			'type'=>'checkbox',
		));
		$wp_customize->add_setting( 'tombolfacebook' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('tombolfacebook' , array(
			'label' => 'Facebook',
			'section' => 'tombolbagikan',
			'type'=>'checkbox',
		));
		$wp_customize->add_setting( 'tomboltwitter' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('tomboltwitter' , array(
			'label' => 'Twitter',
			'section' => 'tombolbagikan',
			'type'=>'checkbox',
		));

		$wp_customize->add_setting( 'tombolline' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('tombolline' , array(
			'label' => 'Line',
			'section' => 'tombolbagikan',
			'type'=>'checkbox',
		));

		$wp_customize->add_setting( 'tombolcopylink' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('tombolcopylink' , array(
			'label' => 'Copylink',
			'section' => 'tombolbagikan',
			'type'=>'checkbox',
		));
     


		/* TOMBOL BANTUAN */
		$wp_customize->add_section( 'tombolbantuan' , array(
		  'title'      => 'Tombol Bantuan', 
		  'panel' => 'ThemesappPos',
		  'description'=> 'Berikut ini adalah pengaturan tombol bantuan, seperti tombol darkmode, lightmode, dan homepage',
		));
		$wp_customize->add_setting( 'darkmode' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('darkmode' , array(
			'section' => 'tombolbantuan',
			'label' =>'Tampilkan tombol darkmode',
			'type'=>'checkbox',
		));

		$wp_customize->add_setting( 'homepage' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('homepage' , array(
			'section' => 'tombolbantuan',
			'label' =>'Tampilkan tombol beranda',
			'type'=>'checkbox',
		));


		/* BACAJUGA */
		$wp_customize->add_section( 'bacajuga' , array(
		  'title'      => 'Baca Juga',     
		  'panel' => 'ThemesappPos',
		  'description'=> 'Berikut ini adalah pengaturan tampilan untuk tim redaksi yang terdiri dari pengaturan penulis, editor, dan reporter',
		));

		$wp_customize->add_setting( 'bacajugaactive' , array(
			'default'    => true,
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('bacajugaactive' , array(
			'label' => 'Tampilkan baca juga',
			'section' => 'bacajuga',
			'type'=>'checkbox',
		));
		$wp_customize->add_setting( 'bacajugatitle' , array(
			'default'    => 'Baca Juga',
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('bacajugatitle' , array(
			'section' => 'bacajuga',
			'label' =>'Judul Tombol',
			'type'=>'text',
		));
		$wp_customize->add_setting( 'bacajugaafter' , array(
			'default'    => '3',
			'transport'  =>  'refresh'
		));
		$wp_customize->add_control('bacajugaafter' , array(
			'section' => 'bacajuga',
			'label' =>'Tampilkan setelah paragraf ke-',
			'type'=>'number',
			    'input_attrs' => array(
			        'min' => 1,
			        'max' => 10
			    )
		));




		$wp_customize->add_section( 'licPost' , array(
		  'title'      => 'Lisensi',     
		  'description'=> '',
		  'panel' => 'ThemesappPos',
		));

		$wp_customize->add_setting( 'lic' , array(
			'default'    => '',
			'transport'  =>  'postMessage'
		));
		$wp_customize->add_control('lic' , array(
			'section' => 'licPost',
			'label' =>'Lisensi Tema',
			'type'=>'text',
			'input_attrs' => array(
            'placeholder' => __( 'Masukan lisensi tema disini'),
        )
		));
			

}
add_action( 'customize_register', 'addCustomize' );

add_filter( 'color_utama', function() {
	if(!empty(get_theme_mod( 'color_utama' ))):
		return  get_theme_mod( 'color_utama' );
	else:
		return "#00a1b0";
	endif;
});
?>