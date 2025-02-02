<?php
/*------------------------------------------------------------------------------
  $Id$

  For Abante Cart, E-commerce Solution
  http://www.AbanteCart.com

  Copyright (c) 2011, 2012 AlgoZone, Inc

------------------------------------------------------------------------------*/
if (! defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}
$this->db->query("INSERT INTO ".DB_PREFIX."languages (`name`,`code`,`locale`,`image`,`directory`,`filename`,`sort_order`, `status`)
				  VALUES ('Türkçe', 'tr', 'tr_TR.UTF-8,tr_TR,turkish', 'extensions/turkish_language/storefront/language/turkish/flag.png','turkish','turkish','3',0);");
$new_language_id = $this->db->getLastId();
$xml = simplexml_load_file(DIR_EXT.'german_language/menu.xml');

$routes = array(
			'text_index_home_menu'=>'index/home',
			'text_account_login_menu'=>'account/login',
			'text_account_logout_menu'=>'account/logout',
			'text_account_account_menu'=>'account/account',
			'text_checkout_cart_menu'=>'checkout/cart',
			'text_checkout_shipping_menu'=>'checkout/shipping'
);

if($xml){
	foreach($xml->definition as $item){
		$translates[$routes[(string)$item->key]] = (string)$item->value;
	}

	$storefront_menu = new AMenu_Storefront();
	$storefront_menu->addLanguage($new_language_id,$translates);
}
$this->cache->delete('language');
$this->cache->delete('lang.tr');
