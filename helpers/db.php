<?php

    class FeedbackHelperDb
    {
        static public function save($data){

            // Find database prefix and pull all tables
            $app = JFactory::getApplication();
            $prefix = $app->getCfg('dbprefix');
            $tables = JFactory::getDbo()->getTableList();

            // Get database
            $db = JFactory::getDbo();

            // Build table if it does not exist
            if( ! in_array($prefix.'form_rantrave', $tables) ){
                $db->setQuery(
                    "CREATE TABLE `".$prefix."form_rantrave` (
                      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `name` varchar(70) NOT NULL DEFAULT '',
                      `number` varchar(10) NOT NULL DEFAULT '',
                      `email` varchar(70) NOT NULL DEFAULT '',
                      `province` varchar(70) DEFAULT NULL,
                      `suburb` varchar(70) NOT NULL DEFAULT '',
                      `message` text,
                      `ip_address` varchar(11) NOT NULL DEFAULT '',
                      `token` varchar(32) NOT NULL DEFAULT '',
                      `created_at` datetime NOT NULL,
                      `updated_at` datetime NOT NULL,
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `token` (`token`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;"
                );
                $db->execute();
            }

            // Check if the record was already entered
            $query = $db->getQuery(true);
            $query->select($db->quoteName(array('token')));
            $query->from($db->quoteName($prefix.'form_rantrave'));
            $query->where($db->quoteName('token') . ' = '. $db->quote($data['token']));
            $db->setQuery($query);
            $results = $db->loadObjectList();

            // Continue
            if(count($results) == 0){
                $db = JFactory::getDbo();
                $query = $db->getQuery(true);
                $columns = array('name', 'number', 'email', 'message', 'ip_address', 'token', 'created_at', 'updated_at');
                $values = array(
                    $db->quote($data['name']),
                    $db->quote($data['number']),
                    $db->quote($data['email']),
                    $db->quote($data['message']),
                    $db->quote($_SERVER['REMOTE_ADDR']),
                    $db->quote($data['token']),
                    $db->quote(date('Y-m-d H:i:s', time())),
                    $db->quote(date('Y-m-d H:i:s', time()))
                );
                $query
                    ->insert($db->quoteName('#__form_rantrave'))
                    ->columns($db->quoteName($columns))
                    ->values(implode(',', $values));
                $db->setQuery($query);
            }
        }
    }
?>