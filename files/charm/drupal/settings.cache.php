<?php

// Checking if Redis is running, only locally.
// For remote servers comment the if() statement.
$redis_up = TRUE;

if (file_exists('sites/all/modules/contrib/entitycache/entitycache.info')) {
  $entity_cache = TRUE;
}

if (!empty($redis_up)) {

  // Required configurations.
  $conf['lock_inc'] = 'sites/all/modules/contrib/redis/redis.lock.inc';
  $conf['cache_backends'][] = 'sites/all/modules/contrib/redis/redis.autoload.inc';
  $conf['redis_client_interface'] = 'PhpRedis';
  $conf['redis_client_base'] = 1;
  $conf['redis_client_host'] = '${host}';
  $conf['redis_client_port'] = ${port};
  // Uncomment this line if Redis is locally running via socket.
  // $conf['redis_cache_socket'] = '/var/run/redis/redis.sock';
  // $conf['cache_prefix'] = 'mysite_';

  // Optional not redis specific.
  // $conf['cache_lifetime'] = 0;
  // $conf['page_cache_max_age'] = 0;
  // $conf['page_cache_maximum_age'] = 0;
  $conf['page_cache_invoke_hooks'] = TRUE;
  $conf['page_cache_without_database'] = FALSE;
  // $conf['redis_client_password'] = 'isfoobared';

  // Cache bins.
  $conf['cache_default_class'] = 'Redis_Cache';
  $conf['cache_bootstrap'] = 'Redis_Cache';
  $conf['cache_class_cache'] = 'Redis_Cache';
  $conf['cache_class_cache_menu'] = 'Redis_Cache';
  $conf['cache_class_cache_block'] = 'Redis_Cache';
  $conf['cache_class_cache_views'] = 'Redis_Cache';
  $conf['cache_class_cache_views_data'] = 'Redis_Cache';
  $conf['cache_field'] = 'Redis_Cache';
  $conf['cache_filter'] = 'Redis_Cache';
  $conf['cache_image'] = 'Redis_Cache';
  $conf['cache_libraries'] = 'Redis_Cache';
  $conf['cache_metatag'] = 'Redis_Cache';
  $conf['cache_search_api_solr'] = 'Redis_Cache';

  // Always Database Cache.
  $conf['cache_class_cache_form'] = 'DrupalDatabaseCache';

  // Entity Cache.
  if (!empty($entity_cache)) {
    $conf['cache_entity_node'] = 'Redis_Cache';
    $conf['cache_entity_fieldable_panels_pane'] = 'Redis_Cache';
    $conf['cache_entity_file'] = 'Redis_Cache';
    $conf['cache_entity_taxonomy_term'] = 'Redis_Cache';
    $conf['cache_entity_taxonomy_vocabulary'] = 'Redis_Cache';
    $conf['cache_entity_field_collection_item'] = 'Redis_Cache';
  }

}